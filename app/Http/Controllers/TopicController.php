<?php

namespace App\Http\Controllers;

use App\Models\Flashcard;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Inertia\Inertia;


class TopicController extends Controller
{
    public function index($topicId = null)
    {

        $topic = Topic::find($topicId);

        $openTree = $topic ? $this->_getAncestors($topic) : [];

        return Inertia::render('Topic/Index',[
            //'topics' => Auth::check() ? Topic::mine()->orderBy('name')->with('children.children.children.children.children.children')->withCount('flashcards')->get() : null,
            // 'topics' => Auth::check() ? Topic::mine()->orderBy('name')->with('children')->withCount('flashcards')->get() : null,
            'topics' => Auth::check() ? Topic::mine()->orderBy('name')->with('descendants')->withCount('flashcards')->get() : null,
            'openTree' => $openTree

        ]);

    }

    public function show(Topic $topic)
    {

        // return view('topics.show', [
        return Inertia::render('Topic/Show',[
            'topic' => $topic
        ]);
    }

    public function create(Request $request)
    {

        $topic= Topic::find($request->topic);

        return view('topics.create')->with(['topic' => $topic]);
    }

    public function store()
    {
        $attributes = request()->validate([
            'name' => [
                'required',
                'max:50',
                'min:1',
                // new SpecialCharacters,
                Rule::unique('topics')->where(fn ($query) => $query->where('user_id', Auth::id()))
            ],
            'description' => ['max:150'],
            'topic_id' => ['exists:topics,id','nullable'],
            'background' => ['required']
        ]);

        $attributes['user_id'] = Auth::id();

        $slug = Str::slug($attributes['name'] . Auth::id());
        $uniqueSlug = $slug;
        $counter = 1;

        while (Topic::where('slug', $uniqueSlug)->exists()) {
            $uniqueSlug = $slug . '-' . $counter++;
        }

        $attributes['slug'] = $uniqueSlug;

        // $slug = Str::lower($attributes['name']) . "_" . Auth::id();
        // $slug = preg_replace("/[^a-z0-9-_]/", '', $slug);
        // $attributes['slug'] = $slug;

        $topic = Topic::create($attributes);

        return redirect()->back()->with('success', $topic->name . ' has been created');

    }

    public function update(Topic $topic)
    {

        $attributes = request()->validate([
            'name' => [
                'required',
                'max:50',
                'min:1',
                new SpecialCharacters,
                Rule::unique('topics')->ignore($topic->id), //->where(fn ($query) => $query->where('user_id', Auth::id()))
            ],
            'description' => ['max:150'],
            'topic_id' => ['exists:topics,id','nullable'],
            'background' => ['required']
        ]);

        $slug = Str::lower($attributes['name']) . "_" . Auth::id();
        $slug = preg_replace("/[^a-z0-9-_]/", '', $slug);
        $attributes['slug'] = $slug;


        $topic->update($attributes);

        cache()->forget('ancestors.' . $topic->id);

        return redirect('/topics/' . $topic->slug)->with('success', 'Topic has been updated');

    }

    public function changeParent(Topic $topic)
    {

        if ($topic->topic_id === request()->input('topic_id')){
            return;
        }

        $attributes = request()->validate([
            'topic_id' => ['exists:topics,id','nullable','different:id'],
        ]);

        $topic->update($attributes);

        cache()->forget('ancestors.' . $topic->id);

        return redirect()->back()->with(['success' => $topic->name . ' moved']);


    }

    public function edit(Topic $topic)
    {

        $topics = $this->_getHeirarchy($topic);

        return view('topics.edit')->with(['topic' => $topic, 'topics' => $topics]);
    }

    public function destroy(Topic $topic)
    {

        $name = $topic->name;

        if ($topic->children->count() || $topic->flashcards->count()){
            return redirect(route('topics.home'))->with('error', 'Please delete or reassign flashcards and subtopics first');
        }

        $topic->delete();

        return redirect(route('topics.home'))->with(['success' => $name . ' has been deleted']);

    }

    private function _getHeirarchy($thisTopic, $topicname =null, $topic = null)
    {

        $topics = Topic::mine($topic->id ?? null)->orderBy('name')->get();

        $collect = collect([]);

        foreach ($topics as $topic){

            if ($topic->id === $thisTopic->id || $topic->flashcards->count()){
                continue;
            }

            $name = $topicname ? $topicname . " // " . $topic->name : $topic->name;
            $collect[$name] = $topic->id;
            $collect = $collect->merge($this->_getHeirarchy($thisTopic, $name, $topic));
        }

        return $collect;
    }

    private function _getAncestors($topic)
    {

        $ancestors = [$topic->id];

        if ($topic->parent){
            $ancestors = array_merge($ancestors,$this->_getAncestors($topic->parent));
        }

        return $ancestors;
    }
}

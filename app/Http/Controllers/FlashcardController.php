<?php

namespace App\Http\Controllers;

use App\Models\Flashcard;
use App\Models\Topic;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class FlashcardController extends Controller
{

    use SoftDeletes;

    public function store(Request $request)
    {

        $attributes = request()->validate([
            'question' => ['required','max:255'],
            'answer' => ['required','max:255'],
            'max_score' => ['numeric','min:1','max:5','required'],
            'topic_id' => ['exists:topics,id','nullable'],
        ]);

        $attributes['user_id'] = Auth::id();

        if(!isSet($attributes['max_score'])){
            $attributes['max_score'] = 1;
        }

        $flashcard = Flashcard::create($attributes);

        return redirect()->back()->with('success', 'Flashcard created in ' . $flashcard->topic->name);

    }

    public function create(Request $request)
    {

        $topic= Topic::find($request->topic);

        return view('flashcards.create')->with('topic', $topic);
    }


    public function destroy(Flashcard $flashcard)
    {

        $topic = $flashcard->topic;

        $flashcard->delete();

        return redirect()->back()->with('success', 'Flashcard deleted');

        //return redirect('/topics/' . $topic->slug)->with('success', 'Flashcard has been deleted');


    }

    public function destroyGroup(String $ids)
    {
        $ids = explode(',', $ids);

        Flashcard::whereIn('id',$ids)->delete();

        return redirect()->back()->with('success', 'Flashcards deleted');

    }

    public function moveGroup()
    {

        $attributes = request()->validate([
            'topic_id' => ['exists:topics,id','nullable'],
            'flashcards' => ['array']
        ]);

        $flashcards = Flashcard::whereIn('id',$attributes['flashcards'])->get();

        foreach ($flashcards as $flashcard){
            $flashcard->topic_id = $attributes['topic_id'];
            $flashcard->save();
        }


        return redirect()->back()->with('success', 'Flashcards moved');

    }


    public function edit(Flashcard $flashcard)
    {

        $topics = $this->_getAllTopics($flashcard->topic);

        return view('flashcards.edit')->with(['flashcard' => $flashcard,'topics' => $topics]);

    }


    public function update(Flashcard $flashcard)
    {

        $attributes = request()->validate([
            'question' => ['required','max:255'],
            'answer' => ['required','max:255'],
            'max_score' => ['numeric','min:1','max:5','nullable'],
            'topic_id' => ['exists:topics,id','nullable'],
        ]);


        if(!isSet($attributes['max_score'])){
            $attributes['max_score'] = 1;
        }



        $flashcard->update($attributes);

        return redirect('/topics/' . $flashcard->topic->slug)->with('success', 'Flashcard has been updated');

    }


    private function _getAllTopics($thisTopic, $topicname =null, $topic = null)
    {

        $topics = Topic::mine($topic->id ?? null)->orderBy('name')->get();

        $collect = collect([]);

        foreach ($topics as $topic){

            $name = $topicname ? $topicname . " // " . $topic->name : $topic->name;

            if (!$topic->children->count()){
                $collect[$name] = $topic->id;
            }


            $collect = $collect->merge($this->_getAllTopics($thisTopic, $name, $topic));
        }

        return $collect;
    }



}

<?php

namespace App\Http\Controllers;

use App\Models\Flashcard;
use App\Models\Topic;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class TopicController extends Controller
{
    public function index()
    {

        return view('topics.index', [
            'topics' => Topic::mine()->orderBy('name')->get()
        ]);

    }

    public function show(Topic $topic)
    {

        return view('topics.show', [
            'topic' => $topic
        ]);
    }

    public function store()
    {
        $attributes = request()->validateWithBag('topicCreate',[
            'name' => ['required','max:50','min:1','regex:/^[a-zA-Z0-9\s\-\_\,\(\)]+$/'],
            'description' => ['max:150'],
            'topic_id' => ['exists:topics,id','nullable'],
            'background' => ['required']
        ]);

        $attributes['user_id'] = Auth::id();

        $slug = Str::lower($attributes['name']) . "_" . Auth::id();
        $slug = preg_replace("/[^a-z0-9-_]/", '', $slug);
        $attributes['slug'] = $slug;

        $topic = Topic::create($attributes);

        return redirect('/topics/' . $topic->slug)->with('success', $topic->name . ' has been created');

    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Flashcard;
use App\Models\Test;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
    public function store(Topic $topic)
    {

        $attributes['user_id'] = Auth::id();
        $attributes['topic_id'] = $topic->id;

        $test = Test::create($attributes);

        $topics = $topic->getDescendants();

        $flashcards = Flashcard::fromTopics($topics)->inRandomOrder(time())->get();

        foreach($flashcards as $flashcard)
        {
            $test->flashcards()->attach($flashcard->id);
        }

        return redirect('/runtest/' . $test->id);

    }

    public function run(Test $test)
    {
        return view('tests.show', [
            'test' => $test
        ]);
    }

    public function close(Test $test)
    {

        return redirect('/topics/' . $test->topic->slug);
    }
}

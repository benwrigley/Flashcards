<?php

namespace App\Http\Controllers;

use App\Models\Flashcard;
use App\Models\Test;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
    public function store(Topic $topic)
    {

        $attributes['user_id'] = Auth::id();
        $attributes['topic_id'] = $topic->id;

        $test = Test::create($attributes);

        $topics = $topic->getDescendants();
        array_push($topics,$topic->id);

        $flashcards = Flashcard::fromTopics($topics)->inRandomOrder(time())->get();

        if($flashcards->count() < 1){
            return redirect('/topics/' . $topic->slug)->with('error', 'An error occurred');
        }

        foreach($flashcards as $flashcard)
        {
            $test->flashcards()->attach($flashcard->id);
        }

        return redirect('/starttest/' . $test->id);

    }


    public function start(Test $test){

        // $flashcards =  cache()->remember("flashcards." . $test->id, 600, function() use($test){
        //     return $test->flashcards();
        // });

        return view('tests.show', [
            'test' => $test,
            'flashcards' => $test->flashcards,
            'count' => 0,
        ]);

    }


    public function answer(Request $request){

        $input = $request->all();

        $test = Test::find($input['test']);
        $count = $input['count'];

        $flashcards = $test->flashcards;

        //update test score
        $test->increment('score',$input['score']);
        $test->increment('max_score',$flashcards[$count]->max_score);


        //update flashcard score

        // $percentage = ($input['score'] / $flashcards[$count]->max_score) * 100;
        // $flashcards[$count]->avg_score = ($flashcards[$count]->avg_score + $percentage) / 2;
        // $flashcards[$count]->save();

        $flashcards[$count]->pivot->score = ($input['score'] / $flashcards[$count]->max_score) * 100;
        $flashcards[$count]->pivot->save();

        $count++;

        if ($flashcards->count() === $count){
            return redirect('/closetest/' . $test->id);
        }

        return view('tests.show', [
            'test' => $test,
            'flashcards' => $test->flashcards,
            'count' => $count,
        ]);

    }

    // public function run(Test $test, Request $request)
    // {

    //     if (!is_null($request->input('correct'))){

    //         $flashcard = Flashcard::find($request->input('flashcard'));

    //         if($request->input('correct')){
    //             $flashcard->increment('correct',1);
    //             $test->increment('totalCorrect',1);
    //         }
    //         else
    //         {
    //             $flashcard->increment('incorrect',1);
    //             $test->increment('totalIncorrect',1);
    //         }

    //     }

    //     if ($request->input('test-over')){
    //         return redirect('/test/close/' . $test->id);
    //     }

    //     $flashcards = $test->flashcards()->paginate(1);

    //     //build the next url
    //     $href = '';

    //     if ($flashcards->currentPage() === $flashcards->lastPage()){
    //         $href = request()->url() . '?' .  http_build_query(['test-over' => true, 'flashcard' => $flashcards[0]->id ]);
    //     }
    //     else {
    //         $href = $flashcards->appends(['flashcard' => $flashcards[0]->id])->nextPageUrl();
    //     }

    //     return view('tests.show', [
    //         'test' => $test,
    //         'flashcards' => $flashcards,
    //         'href' => $href
    //     ]);
    // }

    public function close(Test $test)
    {

        $test->completed_at = now();
        $test->save();

        return view('tests.results', [
            'test' => $test
        ]);

    }
}

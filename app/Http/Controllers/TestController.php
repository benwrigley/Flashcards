<?php

namespace App\Http\Controllers;

use App\Models\Flashcard;
use App\Models\Test;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function store(Topic $topic, $type)
    {

        //limit on questions
        $limit = $type === '*' ? 100 : $type;

        $attributes['user_id'] = Auth::id();
        $attributes['topic_id'] = $topic->id;

        $test = Test::create($attributes);

        $topics = $topic->getDescendants();
        array_push($topics,$topic->id);

        $flashcards = Flashcard::fromTopics($topics)
                        ->orderBy('avg_score','asc')
                        ->limit($limit)
                        ->get();

        if($flashcards->count() < 1){
            return redirect('/topics/' . $topic->slug)->with('error', 'Add flashcards to subtopics first');
        }

        //randomise
        $flashcards = $flashcards->shuffle();

        //link the cards to the test
        foreach($flashcards as $flashcard)
        {
            $test->flashcards()->attach($flashcard->id);
        }

        return redirect('/starttest/' . $test->id);

    }


    public function start(Test $test){

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
        $test->increment('final_score',$input['score']);
        $test->increment('max_score',$flashcards[$count]->max_score);


        //update flashcard score

        $flashcards[$count]->pivot->score = ($input['score'] / $flashcards[$count]->max_score) * 100;
        $flashcards[$count]->pivot->save();

        $flashcards[$count]->avg_score = DB::table('flashcard_test')->where('flashcard_id',$flashcards[$count]->id)->avg('score');

        $flashcards[$count]->save();

        $count++;

        //is the test completed
        if ($flashcards->count() === $count){

            $success = "Test Completed!";
            if (($test->user->mostRecentTest()->completed_at === null) || !Carbon::parse($test->user->mostRecentTest()->completed_at)->isToday() ){
                $test->user->increment('streak',1);
                $success = "Streak updated, keep it up!";
            }

            $test->completed_at = now();
            $test->save();

            cache()->forget('average_score.' . $test->user_id);
            cache()->forget('test_completed.' . $test->user_id);
            cache()->forget('least_tested.' . $test->user_id);

            return redirect(route('test.close',$test->id))->with('success', $success);
        }

        return view('tests.show', [
            'test' => $test,
            'flashcards' => $test->flashcards,
            'count' => $count,
        ]);

    }


    public function close(Test $test)
    {

        return view('tests.results', [
            'test' => $test
        ]);

    }
}

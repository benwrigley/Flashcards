<?php

namespace App\Http\Controllers;

use App\Models\Flashcard;
use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class TestController extends Controller
{
    public function store(Request $request)
    {

        $attributes = $request->validate([
            'type' => ['required'],
            'quantity' => ['numeric'],
            'topics' => ['array','min:1']
        ],
        [
            'topics.min' => 'Please select at least one topic/subtopic'
        ]);


        $flashcards = (function() use ($attributes) {
            switch ($attributes['type']) {
                case 2: //worst performing
                    return Flashcard::fromTopics($attributes['topics'])->worstPerforming($attributes['quantity'])->get();
                case 3: //least tested
                    return Flashcard::fromTopics($attributes['topics'])->leastTested($attributes['quantity'])->get();
                default: //random
                    return Flashcard::fromTopics($attributes['topics'])->randomSelection($attributes['quantity'])->get();
            }
        })();


        $attributes['user_id'] = Auth::id();
        $attributes['topic_id'] = 1;  //just to remove need to update DB

        $test = Test::create($attributes);

        //randomise
        $flashcards = $flashcards->shuffle();

        $test->flashcards()->attach($flashcards->pluck('id'));

        // return redirect('/starttest/' . $test->id);

        return redirect(route('test.show',[$test]));

    }

    public function show(Test $test){

        $position = $test->getNextFlashcardPosition();

        return Inertia::render('Test/Show',[
            'test' => $test,
            'currentFlashcard' => $position !== null ? $test->flashcards[$position] : $position,
            'position' => $position,
            'total' => $test->flashcards->count()
        ]);
    }



    public function answer(Request $request){

        $input = $request->all();

        $test = Test::find($input['test']);
        $flashcard = Flashcard::find($input['flashcard']);

        //update test score
        $test->increment('final_score',$input['score']);
        $test->increment('max_score',$flashcard->max_score);


        //update flashcard score

        $flashcard->tests()->updateExistingPivot($test->id, [
            'score' => ($input['score'] / $flashcard->max_score) * 100,
        ]);

        $flashcard->avg_score = DB::table('flashcard_test')->where('flashcard_id',$flashcard->id)->avg('score');

        $flashcard->save();

        //is the test completed
        if ($test->getNextFlashcardPosition() === null){


            //update streak
            if (($test->user->mostRecentTest()->completed_at === null) || !Carbon::parse($test->user->mostRecentTest()->completed_at)->isToday() ){
                $test->user->increment('streak',1);
            }


            $test->completed_at = now();
            $test->save();

            cache()->forget('average_score.' . $test->user_id);
            cache()->forget('test_completed.' . $test->user_id);
            cache()->forget('least_tested.' . $test->user_id);

        }

        return redirect()->back();

    }

}

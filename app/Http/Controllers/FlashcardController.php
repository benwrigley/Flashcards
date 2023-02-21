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

        $attributes = request()->validateWithBag('flashcardCreate',[
            'question' => ['required','max:255'],
            'answer' => ['required','max:255'],
            'max_score' => ['numeric','min:1','max:5','nullable'],
            'topic_id' => ['exists:topics,id','nullable'],
        ]);

        $attributes['user_id'] = Auth::id();

        if(!isSet($attributes['max_score'])){
            $attributes['max_score'] = 1;
        }

        $flashcard = Flashcard::create($attributes);

        return redirect('/topics/' . $flashcard->topic->slug)->with('success', 'Flashcard has been created');

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

        return redirect('/topics/' . $topic->slug)->with('success', 'Flashcard has been deleted');


    }


    public function edit(Flashcard $flashcard)
    {

        return view('flashcards.edit')->with('flashcard', $flashcard);
    }


    public function update(Flashcard $flashcard)
    {

        $attributes = request()->validate([
            'question' => ['required','max:255'],
            'answer' => ['required','max:255'],
            'max_score' => ['numeric','min:1','max:5','nullable'],
        ]);


        if(!isSet($attributes['max_score'])){
            $attributes['max_score'] = 1;
        }



        $flashcard->update($attributes);

        return redirect('/topics/' . $flashcard->topic->slug)->with('success', 'Flashcard has been updated');

    }



}

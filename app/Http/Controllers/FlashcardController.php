<?php

namespace App\Http\Controllers;

use App\Models\Flashcard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class FlashcardController extends Controller
{
    public function store()
    {
        $attributes = request()->validate([
            'question' => ['required','max:255'],
            'answer' => ['required','max:255'],
            'points' => ['numeric','min:1','max:5','nullable'],
            'topic_id' => ['exists:topics,id','nullable'],
        ]);

        $attributes['user_id'] = Auth::id();

        $flashcard = Flashcard::create($attributes);

        return redirect('/topics/' . $flashcard->topic->slug)->with('success', 'Flashcard has been created');

    }



}

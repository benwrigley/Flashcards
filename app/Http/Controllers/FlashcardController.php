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
            'topic_id' => ['exists:topics,id','nullable'],
        ]);

        $attributes['user_id'] = Auth::id();

        // $slug = Str::lower($attributes['name']) . "_" . Auth::id();
        // $slug = preg_replace("/[^a-z0-9-_]/", '', $slug);
        // $attributes['slug'] = $slug;

        $flashcard = Flashcard::create($attributes);

        return redirect('/topics/' . $flashcard->topic->slug)->with('success', 'Flashcard has been created');

    }
}

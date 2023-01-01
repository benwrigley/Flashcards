<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionsController extends Controller
{

    public function create()
    {
        return view('session.create');

    }

    public function store()
    {

        $attributes = request()->validate([
            'email' => ['required','email'],
            'password' => ['required']
        ]);

        if (auth()->attempt($attributes)){
            return redirect('/')->with('success','Welcome back ' . Auth::user()->name);
        }

        throw ValidationException::withMessages(['email' => 'Your provided credentials cannot be verified. Please try again.']);

    }


    public function destroy()
    {
        auth()->logout();

        return redirect('/')->with('success', 'Goodbye!');

    }


}

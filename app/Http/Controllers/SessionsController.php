<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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

            $user = auth()->user();

            if ($user->mostRecentTest()  && ! (Carbon::parse($user->mostRecentTest()->completed_at)->isToday() ||  Carbon::parse($user->mostRecentTest()->completed_at)->isYesterday())){
                $user->streak = 0;
                $user->save();
            }

            return redirect('/')->with('success','Welcome back ' . $user->name);
        }

        throw ValidationException::withMessages(['email' => 'Your provided credentials cannot be verified. Please try again.']);

    }


    public function destroy()
    {

        auth()->logout();

        return redirect('/')->with('success', 'Goodbye!');

    }


}

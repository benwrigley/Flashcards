<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;

class SessionsController extends Controller
{

    public function create(Request $request)
    {

        return Inertia::render('Session/Create');

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

            return redirect(route('topics.home'))->with('notify', 'Welcome back ' . $user->name);

        }

        return back()->withErrors(['email' => 'Your provided credentials cannot be verified.']);

    }


    public function destroy()
    {

        auth()->logout();

        return Redirect::route('login')->with('notify', 'Goodbye!');

    }


}

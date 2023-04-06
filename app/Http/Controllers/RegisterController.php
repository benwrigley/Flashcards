<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class RegisterController extends Controller
{
    public function create()
    {

        return Inertia::render('Register/Create');
        // return view('register.create');
    }

    public function store()
    {
        $attributes = request()->validate([
            'name' => ['required','max:30','min:5'],
            'email' => ['required','email','max:255',Rule::unique('users','email')],
            'password' => ['required','min:7']
        ]);

        $user = User::create($attributes);

        event(new Registered($user));

        //auth()->login($user);

        return redirect(route('login'))->with('success',$user->name . '. Your account has been created. Please check your email');;

    }
}

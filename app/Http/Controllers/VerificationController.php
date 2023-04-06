<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class VerificationController extends Controller
{


    public function notice(){

        return Inertia::render('Auth/VerifyEmail');

        // return view('auth.verify-email');
    }

    public function verify(EmailVerificationRequest $request){

        $request->fulfill();

        return Redirect::route('login')->with('success','Thank you, your account has been account verified. Please login.');
    }

    public function resend(Request $request){

        $this->validate($request, [
            'email' => 'required|string|email|max:45',
        ]);

        $user = User::where('email', $request->input('email'))->first();

        $user->sendEmailVerificationNotification();

        return redirect(route('verification.sendconfirm'));


    }

    public function sendConfirm(Request $request){
        return view('auth.verify-email-sent');
    }
}

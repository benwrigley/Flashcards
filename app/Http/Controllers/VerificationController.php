<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class VerificationController extends Controller
{


    public function notice(){

        return view('auth.verify-email');
    }

    public function verify(EmailVerificationRequest $request){

        $request->fulfill();
        return redirect('/')->with('success','Thank you, account verified');
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

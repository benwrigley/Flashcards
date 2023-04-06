<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Inertia\Inertia;

class ResetPasswordController
{

    public function requestForm(){
        return Inertia::render('Auth/ForgotPassword');
    }

    public function send(Request $request){

        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
                ? redirect(route('login'))->with(['success' => __($status)])
                : back()->withErrors(['email' => __($status)]);

    }

    public function resetForm($token){

        return Inertia::render('Auth/ResetPassword', ['token' => $token]);
    }

    public function update(Request $request){

        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => $password
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect(route('login'))->with(['success' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

}

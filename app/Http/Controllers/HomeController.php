<?php

namespace App\Http\Controllers;

use App\Http\Controllers\TopicController;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function show(){
        if (auth()->check()) {

            return redirect(route('topics.home'));
        }

        return view('session.create');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\TopicController;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{

    public function show(){
        if (auth()->check()) {

            return redirect(route('topics.home'));
        }

        return redirect(route('login'));

    }
}

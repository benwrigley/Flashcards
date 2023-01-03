<?php

use App\Http\Controllers\PostContoller;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\TopicController;
use Illuminate\Support\Facades\Route;

//Route::view('/','dashboard')->name('home');
Route::get('/', [TopicController::class, 'index']);
Route::get('topics/{topic:slug}', [TopicController::class, 'show'])->middleware('auth');
//Route::get('posts/{post:slug}', [PostContoller::class, 'show']);

Route::get('register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('register', [RegisterController::class, 'store'])->middleware('guest');

Route::get('login', [SessionsController::class, 'create'])->middleware('guest');
Route::post('login', [SessionsController::class, 'store'])->middleware('guest');
Route::post('logout', [SessionsController::class, 'destroy'])->middleware('auth');

Route::post('/topic/create', [TopicController::class, 'store'])->middleware('auth');



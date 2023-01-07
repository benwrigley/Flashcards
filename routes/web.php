<?php

use App\Http\Controllers\FlashcardController;
use App\Http\Controllers\PostContoller;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\TopicController;
use Illuminate\Support\Facades\Route;

//Route::view('/','dashboard')->name('home');
Route::get('/', [TopicController::class, 'index']);
Route::get('topics/{topic:slug}', [TopicController::class, 'show'])->middleware('auth');
//Route::get('posts/{post:slug}', [PostContoller::class, 'show']);

Route::get('register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('register', [RegisterController::class, 'store'])->middleware('guest');

Route::get('login', [SessionsController::class, 'create'])->name('login')->middleware('guest');
Route::post('login', [SessionsController::class, 'store'])->middleware('guest');
Route::post('logout', [SessionsController::class, 'destroy'])->middleware('auth');

Route::post('/topic/create', [TopicController::class, 'store'])->middleware('auth');

Route::post('/flashcard/create', [FlashcardController::class, 'store'])->middleware('auth');

Route::get('/test/{topic}', [TestController::class, 'store'])->middleware('auth');
Route::get('/runtest/{test}', [TestController::class, 'run'])->middleware('auth');
Route::get('/test/close/{test}', [TestController::class, 'close'])->middleware('auth');




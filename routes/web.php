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
Route::get('logout', [SessionsController::class, 'destroy']);

Route::post('/topic/store', [TopicController::class, 'store'])->middleware('auth');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('flashcard', FlashcardController::class)->only(['store','edit','update','destroy']);
});

Route::get('/test/{topic}/{type}', [TestController::class, 'store'])->middleware('auth')->name('test.store');
Route::get('/starttest/{test}', [TestController::class, 'start'])->middleware('auth');
Route::post('/answertest', [TestController::class, 'answer'])->middleware('auth');
Route::get('/closetest/{test}', [TestController::class, 'close'])->middleware('auth');




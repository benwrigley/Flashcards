<?php

use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\FlashcardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostContoller;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\VerificationController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'show'])->name('home');
Route::get('/email/verify/sendconfirm',[VerificationController::class, 'sendconfirm'])->name('verification.sendconfirm');


Route::group(['middleware' => ['guest']], function () {

    Route::resource('register', RegisterController::class)->only(['store','create']);

    Route::get('login', [SessionsController::class, 'create'])->name('login')->middleware('guest');
    Route::post('login', [SessionsController::class, 'store'])->middleware('guest');

    Route::get('/forgot-password', [ResetPasswordController::class, 'requestForm'])->name('password.request');
    Route::post('/forgot-password', [ResetPasswordController::class, 'send'])->name('password.email');
    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'resetForm'])->name('password.reset');
    Route::post('/reset-password', [ResetPasswordController::class, 'update'])->name('password.update');

});

Route::group(['middleware' => ['auth']], function () {

    Route::get('/email/verify',[VerificationController::class, 'notice'])->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->middleware(['signed'])->name('verification.verify');
    Route::post('/email/verify/resend',[VerificationController::class, 'resend'])->middleware(['throttle:6,1'])->name('verification.resend');

    Route::get('logout', [SessionsController::class, 'destroy']);
});


Route::group(['middleware' => ['auth','verified']], function () {
    Route::get('topics/{id?}', [TopicController::class, 'index'])->name('topics.home');
    Route::get('topics/{topic:slug}', [TopicController::class, 'show']);
    //Route::get('flashcard/{topic:slug}', [FlashcardController::class, 'create']);
    Route::resource('flashcard', FlashcardController::class)->only(['store','edit','update','destroy','create']);
    Route::resource('topic', TopicController::class)->only(['store','edit','update','destroy','show','create']);
    Route::put('topic/{topic}/changeparent', [TopicController::class, 'changeParent'])->name('topic.change.parent');


    Route::get('/test/{topic}/{type}', [TestController::class, 'store'])->name('test.store');
    Route::get('/starttest/{test}', [TestController::class, 'start']);
    Route::post('/answertest', [TestController::class, 'answer']);
    Route::get('/tests/{test}/close', [TestController::class, 'close'])->name('test.close');
});








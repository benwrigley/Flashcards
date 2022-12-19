<?php

use App\Http\Controllers\PostContoller;
use Illuminate\Support\Facades\Route;

Route::get('/', [PostContoller::class, 'index'])->name('home');
Route::get('posts/{post:slug}', [PostContoller::class, 'show']);


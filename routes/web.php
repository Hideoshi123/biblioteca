<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

Route::get('/', [BookController::class, 'home'])->name('home');

Route::resource('books', BookController::class);

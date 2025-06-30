<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;

// === LANDING ROUTE ===
Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::get('/{slug}', [NewsController::class, 'category'])->name('news.category');
Route::get('/news/{slug}', [NewsController::class, 'show'])->name('news.show');
Route::get('/author/{username}', [AuthorController::class, 'show'])->name('author.show');

// === SEARCH ROUTE ===
Route::get('/search', [NewsController::class, 'search'])->name('news.search');

// === COMMENT ROUTE ===
Route::post('/news/{news}/comment', [NewsController::class, 'comment'])->name('news.comment');
Route::post('/comment/{comment}/reply', [NewsController::class, 'reply'])->name('news.reply');


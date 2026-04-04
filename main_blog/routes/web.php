<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', [ArticleController::class, 'home'])->name('articles.home');
Route::get('/article/{article}', [ArticleController::class, 'show'])->name('articles.show');
Route::post('/comment', [CommentController::class, 'store'])->name('comments.store')->middleware('auth');

Route::prefix('admin')->middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/', function () { return redirect()->route('admin.articles.index'); });
    Route::get('/dashboard', function () { return view('admin.dashboard'); })->name('admin.dashboard');
    Route::resource('articles', ArticleController::class, ['as' => 'admin']);
    Route::resource('categories', CategoryController::class, ['as' => 'admin']);
    Route::resource('tags', TagController::class, ['as' => 'admin']);
    Route::resource('comments', CommentController::class, ['as' => 'admin'])->only(['index', 'destroy']);
});

Route::get('/articles', function () {
    return redirect()->route('admin.articles.index');
});

<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\CommentController as AdminCommentController;
use App\Http\Controllers\Admin\TagController as AdminTagController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\SettingController as AdminSettingController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

// Visitor Routes
Route::get('/', [ArticleController::class, 'home'])->name('home');
Route::get('/article/{slug}', [ArticleController::class, 'show'])->name('articles.show');
Route::post('/comment', [ArticleController::class, 'storeComment'])->name('comments.store');
Route::get('/category/{slug}', [ArticleController::class, 'category'])
    ->name('articles.category');
// Admin Routes
// Admin Routes
Route::prefix('admin')->middleware(['auth', 'is_admin'])->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('articles', AdminArticleController::class);
    Route::resource('categories', AdminCategoryController::class);
    
    // REMOVE THE // FROM THESE LINES BELOW:
    Route::resource('tags', AdminTagController::class);
    Route::resource('comments', AdminCommentController::class);
    Route::resource('pages', AdminPageController::class);
    Route::resource('users', AdminUserController::class);
    Route::resource('settings', AdminSettingController::class);

    
}); 
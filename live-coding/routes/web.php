<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();
  Route::resource('articles', ArticleController::class);
  Route::resource('categorys', CategoryController::class);
  Route::resource('tags', TagsController::class);
  Route::resource('comments', CommentController::class);


    Route::get('/', function () {
        return view('home');
    });
    

    Route::get('/adminlte', function () {
        return view('adminlte::page');
    });
    
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['middleware' => ['role:admin']], function () {

   
    Route::get('/testRole', function () {
        return 'You have the admin role!';
    })->middleware('role:admin');


    // Route::get('/admin', [ArticleController::class, 'index']);
    // Route::get('/admin/dashboard', [ArticleController::class, 'index']);
    // Route::get('/admin/users', [ArticleController::class, 'users']);
    // Route::get('/admin/articles', [ArticleController::class, 'articles']);
    // Route::get('/admin/comments', [ArticleController::class, 'comments']);
    // Route::get('/admin/categories', [ArticleController::class, 'categories']);
    // Route::get('/admin/tags', [ArticleController::class, 'tags']);
    // Route::get('/admin/roles', [ArticleController::class, 'roles']);
    // Route::get('/admin/permissions', [ArticleController::class, 'permissions']);
    // Route::get('/admin/settings', [ArticleController::class, 'settings']);
    // Route::get('/admin/backup', [ArticleController::class, 'backup']);
    // Route::get('/admin/logs', [ArticleController::class, 'logs']);
    // Route::get('/admin/notifications', [ArticleController::class, 'notifications']);
    // Route::get('/admin/activities', [ArticleController::class, 'activities']);
});

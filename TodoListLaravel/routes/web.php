<?php

use Illuminate\Support\Facades\Route; 
use App\Http\Controllers\TodoListController;
 
Route::get('/',[TodoListController::class, 'index']); 
Route::resource('todolist', TodoListController::class);
Route::put('/todolist/{id}', [TodoListController::class, 'update'])->name('todolist.update');
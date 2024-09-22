<?php

use App\Http\Controllers\ListController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware'=>'auth'],function(){

    Route::get('/', function () {
        return view('welcome');
    });
    Route::get('lists',[ListController::class,'index'])->name('lists.index');
    Route::get('list/{toDoList}',[ListController::class,'show'])->name('lists.show');
    Route::get('create-list',[ListController::class,'create'])->name('lists.create');
    Route::post('lists',[ListController::class,'store'])->name('lists.store');
    Route::delete('list/{toDoList}',[ListController::class,'delete'])->name('lists.destroy');
    Route::resource('tasks',TaskController::class);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

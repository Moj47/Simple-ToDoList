<?php

use App\Http\Controllers\ListController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware'=>'auth'],function(){

    Route::get('/', function () {
        return view('welcome');
    });
    Route::get('lists',[ListController::class,'index'])->name('lists.index');
    Route::get('list/{toDoList}',[ListController::class,'show'])->name('lists.show');
    Route::get('create-list',[ListController::class,'create'])->name('lists.create');
    Route::post('lists',[ListController::class,'store'])->name('lists.store');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

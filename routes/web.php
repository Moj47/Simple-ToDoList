<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware'=>'auth'],function(){

    Route::get('/', function () {
        return view('welcome');
    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
   return view('index');
});

Route::get('app',function(){
    return view('formularioview');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

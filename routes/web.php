<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('app', function(){
    return view('formularioview');
});

Auth::routes();

// La ruta para /home solo debe definirse una vez
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
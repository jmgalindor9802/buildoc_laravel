
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;


Route::get('/', function () {
   return view('index');
});

Route::get('formulario',function(){
    return view('formularioview');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

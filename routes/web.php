
<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
   return view('index');
});

Route::get('formulario',function(){
    return view('formularioview');
});

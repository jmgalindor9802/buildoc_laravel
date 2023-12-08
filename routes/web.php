
<?php

use Illuminate\Support\Facades\Route;



Route::get('/', function () {
   return view('index');
});

Route::get('cursos',function(){
    return 'Bienvenido a la pagina cursos';
});

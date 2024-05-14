<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('inicio');
});

//Ruta Alumnos opcion 1
Route::view('/Alumnos', 'Alumnos');

//Ruta Maestros opcion 1
Route::view('/Maestros', 'Maestros');

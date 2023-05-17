<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () { return redirect("/home"); });

Auth::routes(['register' => false, 'reset' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/consulta_certificados', [App\Http\Controllers\CertificadosController::class, 'consultaPublica']);


Route::group(['middleware' => 'auth'], function () {
    Route::resource('/terceros', App\Http\Controllers\TercerosController::class);
    Route::resource('/equipos', App\Http\Controllers\EquiposController::class);
    Route::resource('/competencias', App\Http\Controllers\CompetenciasController::class);
    Route::resource('/certificados', App\Http\Controllers\CertificadosController::class);
    Route::resource('/media_files', App\Http\Controllers\MediaFileController::class);

    Route::get('/generar_carne/{certificadoID}', [App\Http\Controllers\CertificadosController::class, 'generarCarne']);
    
    
});

/* No need Auth */
Route::get('/generar_diploma/{certificadoID}', [App\Http\Controllers\CertificadosController::class, 'generarDiploma']);
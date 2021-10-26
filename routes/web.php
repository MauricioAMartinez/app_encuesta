<?php

use App\Http\Controllers\CorreoController;
use App\Http\Controllers\EncuestaController;
use App\Http\Controllers\EncuestasController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\InformacionController;
use App\Http\Controllers\PreguntaController;
use App\Http\Controllers\RespuestaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/hola', function () {
    return 'hello';
});
Route::get('/encuesta/{correo}/{token}', [EncuestaController::class, 'show'])->name('encuesta');


Route::resource('correo', CorreoController::class);
Route::resource('encuesta', EncuestaController::class);
Route::resource('pregunta', PreguntaController::class);
Route::resource('respuesta', RespuestaController::class);
Route::resource('informacion', InformacionController::class);



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

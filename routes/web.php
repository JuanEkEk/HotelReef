<?php

use Illuminate\Support\Facades\Route;
use App\Empleado;
use App\Http\Controllers\AgendaController;
use App\Perfil;

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

Route::get('/', function () {
    return view('login.index');
});

// Enrutamiento para acceso a usuario
Route::post('validar', 'AccesoController@validar');
Route::get('logout', 'AccesoController@logout');

//Perfil
Route::get('perfil', function () {
    return view('areas.perfil.perfil');
});

//Zona de áreas
Route::get('empleados', function () {
    return view('areas.empleados.empleados');
});

Route::get('mantenimiento', function () {
    return view('areas.empleados_mantenimiento.mantenimiento');
});

Route::get('contraloria', function () {
    return view('areas.empleados_contraloria.contraloria');
});

Route::get('alimentos', function () {
    return view('areas.empleados_alimentos.alimentos');
});

// Vsta de asistencias
// Route::get('asistencia', function () {
//     return view('control.asistencia');
// });
// Ruta del calendario
Route::apiResource('calendario', 'AgendaController');



Route::apiResource('apiDivision', 'EmpleadoController');
Route::apiResource('apiDivisionDes', 'EmpleadoDesactivadoController');
Route::apiResource('apiEmpleadoAlimento', 'AlimentoController');
Route::apiResource('apiEmpleadoAlimentoDes', 'AlimentoDesactivadoController');
Route::apiResource('apiEmpleadoContraloria', 'ContraloriaController');
Route::apiResource('apiEmpleadoContraloriaDes', 'ContraloriaDesactivadoController');
Route::apiResource('apiEmpleadoMantenimiento', 'MantenimientoController');
Route::apiResource('apiEmpleadoMantenimientoDes', 'MantenimientoDesactivadoController');
Route::apiResource('apiPerfil', 'PerfilController');

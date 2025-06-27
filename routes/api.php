<?php

use App\Http\Controllers\ConsumoEstimadoController;
use App\Http\Controllers\GpsUbicacionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/buses/{id}', [ConsumoEstimadoController::class, 'calcularConsumoDesdeUltimaRecarga']);

Route::get('/gps', [GpsUbicacionController::class, 'index']);
Route::post('/gps-data', [GpsUbicacionController::class, 'store']);


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

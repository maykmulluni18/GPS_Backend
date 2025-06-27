<?php

use App\Http\Controllers\ConsumoEstimadoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/buses/{id}', [ConsumoEstimadoController::class, 'calcularConsumoDesdeUltimaRecarga']);
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

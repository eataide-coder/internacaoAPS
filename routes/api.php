<?php

use App\Http\Controllers\AnexosController;
use App\Http\Controllers\ApsController;
use App\Http\Controllers\FinalizarController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MensagensController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/insertMensagens/', [MensagensController::class, 'insertMensagens']);
Route::post('/update_aps/', [ApsController::class, 'update_aps']);
Route::post('/finaliza_aps/', [ApsController::class, 'finaliza_aps']);
Route::post('/insert_aps/', [ApsController::class, 'insert_aps']);
Route::post('/upload_files', [AnexosController::class, 'upload_files']);

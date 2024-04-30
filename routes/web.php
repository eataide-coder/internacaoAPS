<?php

use App\Http\Controllers\ApsController;
use App\Http\Controllers\MensagensController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/mensagens', [MensagensController::class, 'getMensagens']);
Route::get('/listar_aps', [ApsController::class, 'listar_aps']);

Route::get('/getDadosId', [ApsController::class, 'getDadosId']);

// Route::post('/insertMensagens/', [MensagensController::class, 'insertMensagens']);
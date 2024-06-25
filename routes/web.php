<?php

use App\Http\Controllers\AnexosController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApsController;
use App\Http\Controllers\CidController;
use App\Http\Controllers\FinalizarController;
use App\Http\Controllers\MensagensController;
use App\Http\Controllers\ProcedimentoController;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/mensagens', [MensagensController::class, 'getMensagens']);
Route::get('/listar_aps', [ApsController::class, 'listar_aps']);
Route::get('/listar_aps_id', [ApsController::class, 'getDadosId']);
Route::get('/listar_cid_procedimento', [CidController::class, 'getCidProcedimento']);
Route::get('/listar_cid', [CidController::class, 'listar_cid']);
Route::get('/opcoes_finalizar', [FinalizarController::class, 'opcoes_finalizar']);
Route::get('/listar_proc', [ProcedimentoController::class, 'getProcedimentos']);


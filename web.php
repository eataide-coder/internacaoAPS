<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TesteController;
use \App\Http\Controllers\EquipamentoController;
use \App\Http\Controllers\EmpresaController;
use \App\Http\Controllers\InoperanciaController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Equipamento

Route::get('/getEquipamento', [EquipamentoController::class,'getEquipamento']);
Route::get('/getOneEquipamento/{id}', [EquipamentoController::class, 'getOneEquipamento']);
Route::post('/insertEquipamento', [EquipamentoController::class, 'insertEquipamento']);
Route::post('/updateEquipamento', [EquipamentoController::class, 'updateEquipamento']);

// Empresa

Route::get('/getEmpresaManutencao', [EmpresaController::class,'getEmpresaManutencao']);
Route::get('/getOneEmpresaManutencao', [EmpresaController::class,'getOneEmpresaManutencao']);
Route::post('/insertEmpresaManutencao', [EmpresaController::class,'insertEmpresaManutencao']);
Route::post('/updatetEmpresaManutencao', [EmpresaController::class,'updatetEmpresaManutencao']);

// Inoperancia

Route::get('/getInoperancia', [InoperanciaController::class,'getInoperancia']);
Route::get('/getOneInoperancia/{id}', [InoperanciaController::class,'getOneInoperancia']);


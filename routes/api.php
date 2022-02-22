<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiAuthController;
use App\Http\Controllers\Blade\ApiUserController;
use App\Http\Controllers\Gestao\PlanoController;
use App\Http\Controllers\Gestao\TaxaController;
use App\Http\Controllers\Cadastro\ContratoController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/


# Api Clients
Route::post('/login',[ApiAuthController::class,'login']);

Route::group(['middleware' => 'api-auth'],function (){
    Route::post('/me',[ApiAuthController::class,'me']);
    Route::post('/tokens',[ApiAuthController::class,'getAllTokens']);
    Route::post('/logout',[ApiAuthController::class,'logout']);
});

Route::group(['middleware' => 'ajax.check'],function (){
    Route::post('/api-user/toggle-status/{user_id}',[ApiUserController::class,'toggleUserActivation']);
    Route::post('/api-token/toggle-status/{token_id}',[ApiUserController::class,'toggleTokenActivation']);
    Route::post('/api-plano/toggle-status/{plano_id}',[PlanoController::class,'togglePlanoActivation']);
    Route::post('/api-taxa/toggle-status/{taxa_id}',[TaxaController::class,'toggleTaxaActivation']);
    Route::post('/api-spc/consulta/{cpf}',[ContratoController::class,'salvaSpc']);
});


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

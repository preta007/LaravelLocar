<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Blade\UserController;
use App\Http\Controllers\Blade\RoleController;
use App\Http\Controllers\Blade\PermissionController;
use App\Http\Controllers\Blade\HomeController;
use App\Http\Controllers\Blade\ApiUserController;
use App\Http\Controllers\Blade\UploadController;
use App\Http\Controllers\Gestao\PlanoController;
use App\Http\Controllers\Gestao\TaxaController;
use App\Http\Controllers\Cadastro\ContratoController;
use App\Http\Controllers\PDFController;

/*
|--------------------------------------------------------------------------
| Blade (front-end) Routes
|--------------------------------------------------------------------------
|
| Here is we write all routes which are related to web pages
| like UserManagement interfaces, Diagrams and others
|
*/

// Default laravel auth routes
Auth::routes();


// Welcome page
Route::get('/', function (){
    return redirect()->route('home');
})->name('welcome');

session([
    'locale' => 'pt-BR'
]);

// Web pages
Route::group(['middleware' => 'auth'],function (){

    // there should be graphics, diagrams about total conditions
    Route::get('/home', [HomeController::class,'index'])->name('home');

    // Users
    Route::get('/users',[UserController::class,'index'])->name('userIndex');
    Route::get('/user/add',[UserController::class,'add'])->name('userAdd');
    Route::post('/user/create',[UserController::class,'create'])->name('userCreate');
    Route::get('/user/{id}/edit',[UserController::class,'edit'])->name('userEdit');
    Route::post('/user/update/{id}',[UserController::class,'update'])->name('userUpdate');
    Route::delete('/user/delete/{id}',[UserController::class,'destroy'])->name('userDestroy');
    Route::get('/user/theme-set/{id}',[UserController::class,'setTheme'])->name('userSetTheme');

    // Permissions
    Route::get('/permissions',[PermissionController::class,'index'])->name('permissionIndex');
    Route::get('/permission/add',[PermissionController::class,'add'])->name('permissionAdd');
    Route::post('/permission/create',[PermissionController::class,'create'])->name('permissionCreate');
    Route::get('/permission/{id}/edit',[PermissionController::class,'edit'])->name('permissionEdit');
    Route::post('/permission/update/{id}',[PermissionController::class,'update'])->name('permissionUpdate');
    Route::delete('/permission/delete/{id}',[PermissionController::class,'destroy'])->name('permissionDestroy');

    // Roles
    Route::get('/roles',[RoleController::class,'index'])->name('roleIndex');
    Route::get('/role/add',[RoleController::class,'add'])->name('roleAdd');
    Route::post('/role/create',[RoleController::class,'create'])->name('roleCreate');
    Route::get('/role/{role_id}/edit',[RoleController::class,'edit'])->name('roleEdit');
    Route::post('/role/update/{role_id}',[RoleController::class,'update'])->name('roleUpdate');
    Route::delete('/role/delete/{id}',[RoleController::class,'destroy'])->name('roleDestroy');

    // ApiUsers
    Route::get('/api-users',[ApiUserController::class,'index'])->name('api-userIndex');
    Route::get('/api-user/add',[ApiUserController::class,'add'])->name('api-userAdd');
    Route::post('/api-user/create',[ApiUserController::class,'create'])->name('api-userCreate');
    Route::get('/api-user/show/{id}',[ApiUserController::class,'show'])->name('api-userShow');
    Route::get('/api-user/{id}/edit',[ApiUserController::class,'edit'])->name('api-userEdit');
    Route::post('/api-user/update/{id}',[ApiUserController::class,'update'])->name('api-userUpdate');
    Route::delete('/api-user/delete/{id}',[ApiUserController::class,'destroy'])->name('api-userDestroy');
    Route::delete('/api-user-token/delete/{id}',[ApiUserController::class,'destroyToken'])->name('api-tokenDestroy');

    // Planos
    Route::get('/planos',[PlanoController::class,'index'])->name('planoIndex');
    Route::get('/planos/add',[PlanoController::class,'add'])->name('planoAdd');
    Route::post('/planos/create',[PlanoController::class,'create'])->name('planoCreate');
    Route::get('/planos/{plano_id}/edit',[PlanoController::class,'edit'])->name('planoEdit');
    Route::post('/planos/update/{plano_id}',[PlanoController::class,'update'])->name('planoUpdate');
    Route::delete('/planos/delete/{id}',[PlanoController::class,'destroy'])->name('planoDestroy');

    // Taxas
    Route::get('/taxas',[TaxaController::class,'index'])->name('taxaIndex');
    Route::get('/taxas/add',[TaxaController::class,'add'])->name('taxaAdd');
    Route::post('/taxas/create',[TaxaController::class,'create'])->name('taxaCreate');
    Route::get('/taxas/{taxa_id}/edit',[TaxaController::class,'edit'])->name('taxaEdit');
    Route::post('/taxas/update/{taxa_id}',[TaxaController::class,'update'])->name('taxaUpdate');
    Route::delete('/taxas/delete/{id}',[TaxaController::class,'destroy'])->name('taxaDestroy');

    // Cadastro Contratos
    Route::get('/contrato/cliente',[ContratoController::class,'cliente'])->name('contratoCliente');
    Route::post('/contrato/create',[ContratoController::class,'create'])->name('contratoCreate');
    Route::get('/contrato/imovel/{cliente_id}',[ContratoController::class,'imovel'])->name('contratoImovel');
    Route::post('/contrato/createImovel',[ContratoController::class,'createImovel'])->name('contratoCreateImovel');
    Route::get('/contrato/contratoShow/{id}',[ContratoController::class,'contratoShow'])->name('contratoShow');
    Route::get('/contrato/gestaoContratoShow',[ContratoController::class,'gestaoContratoShow'])->name('gestaoContratoShow');
    Route::get('/contrato/coinquilino/{id}',[ContratoController::class,'contratoCoinquilino'])->name('contratoCoinquilino');

    //upload de arquivos
    Route::post('/upload',[UploadController::class,'uploadContrato'])->name('uploadContrato');

});


Route::get('dossie/{result}', [PDFController::class, 'dossie'])->name('dossie');

// Change language session condition
/*Route::get('/language/{lang}',function ($lang){
    $lang = strtolower($lang);
    if ($lang == 'ru' || $lang == 'uz')
    {
        session([
            'locale' => $lang
        ]);
    }
    return redirect()->back();
});*/

/*
|--------------------------------------------------------------------------
| This is the end of Blade (front-end) Routes
|-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\
*/

<?php

use Illuminate\Support\Facades\Route;

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::get('dashboard',function (){
        $userClientes = \App\Models\UserCliente::all();
        $parceiras = \App\Models\Parceira::all();
        $presentes = \App\Models\Presente::all();

        return view('dashboard',compact('userClientes','parceiras','presentes'));

    });
    Route::crud('user', 'UserCrudController');
    Route::crud('categoria', 'CategoriaCrudController');
    Route::crud('pergunta', 'PerguntaCrudController');
    Route::crud('cartao', 'CartaoCrudController');
    Route::crud('sobre', 'SobreCrudController');
    Route::crud('centro', 'CentroCrudController');
    Route::crud('parceira', 'ParceiraCrudController');
    Route::crud('topo', 'TopoCrudController');
    Route::crud('termo', 'TermoCrudController');
    Route::crud('user-loja', 'UserLojaCrudController');
    Route::crud('user-cliente', 'UserClienteCrudController');
    Route::crud('responsavel', 'ResponsavelCrudController');
    Route::crud('presente', 'PresenteCrudController');
    Route::crud('plano', 'PlanoCrudController');
    Route::get('parceira/{id}/planoloja', [\App\Http\Controllers\Admin\ParceiraCrudController::class,'planoloja']);

    Route::post('cadastraTaxa',[\App\Http\Controllers\Admin\ParceiraCrudController::class,'cadPlano']);

}); // this should be the absolute last line of this file

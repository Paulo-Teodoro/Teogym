<?php

use App\Http\Controllers\Admin\ExercicioController;
use App\Http\Controllers\Admin\PessoaController;
use App\Http\Controllers\Admin\RotinaController;
use App\Http\Controllers\Admin\TreinoController;
use App\Http\Controllers\Admin\TreinoExercicioController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('app')->group(function () {
    Route::get('/', function () {
        return view('app.home');
    })->name('app.home');

    Route::resource('/alunos', PessoaController::class);

    Route::resource('/exercicios', ExercicioController::class);

    Route::prefix('rotinas')->group(function () {
        Route::get('/', [RotinaController::class, 'index'])->name('rotinas.index');
        Route::get('/create', [RotinaController::class, 'create'])->name('rotinas.create');
        Route::post('/store', [RotinaController::class, 'store'])->name('rotinas.store');
        Route::delete('/destroy/{id}', [RotinaController::class, 'destroy'])->name('rotinas.destroy');
    
        Route::get('/{id}/treinos', [TreinoController::class, 'index'])->name('treinos.index');
        Route::get('/{id}/treinos/create', [TreinoController::class, 'create'])->name('treinos.create');
        Route::post('/treinos/store', [TreinoController::class, 'store'])->name('treinos.store');
        Route::delete('{idRotina}/treinos/destroy/{idTreino}', [TreinoController::class, 'destroy'])->name('treinos.destroy');


        Route::prefix('{idRotina}/treinos')->group(function () {
            Route::get('/{idTreino}/treino-exercicios', [TreinoExercicioController::class, 'index'])->name('treino-exercicios.index');
            Route::get('/{idTreino}/treino-exercicios/create', [TreinoExercicioController::class, 'create'])->name('treino-exercicios.create');
            Route::delete('/{idTreino}/treino-exercicios/destroy/{idExercicio}', [TreinoExercicioController::class, 'destroy'])->name('treino-exercicios.destroy');
        });
        Route::post('/treino-exercicios/store', [TreinoExercicioController::class, 'store'])->name('treino-exercicios.store');
    });
});


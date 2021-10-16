<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ExercicioController;
use App\Http\Controllers\Admin\AlunoController;
use App\Http\Controllers\Admin\PersonalController;
use App\Http\Controllers\Admin\RelatorioController;
use App\Http\Controllers\Admin\RotinaController;
use App\Http\Controllers\Admin\TreinoController;
use App\Http\Controllers\Admin\TreinoExercicioController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/s', function () {
    dd(Hash::make('12345678'));
});

Route::middleware(['auth'])->prefix('app')->group(function () {
    Route::get('/', function () {
        return view('app.home');
    })->name('app.home');

    Route::resource('/alunos', AlunoController::class);

    Route::resource('/personais', PersonalController::class);

    Route::resource('/admins', AdminController::class);

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

    Route::get('/relatorios', [RelatorioController::class, 'index'])->name('relatorios.index');
    Route::get('/relatorios/rotina/{id}', [RelatorioController::class, 'rotina'])->name('relatorios.rotina');
    Route::get('/relatorios/ultimos-alunos', [RelatorioController::class, 'lastAlunos'])->name('relatorios.alunos');
    Route::get('/relatorios/rotinas-quantidade', [RelatorioController::class, 'rotinaPessoa'])->name('relatorios.rotinaPessoa');
    Route::get('/relatorios/historico-aluno/{id}', [RelatorioController::class, 'historicoAluno'])->name('relatorios.historicoAluno');
});


require __DIR__.'/auth.php';

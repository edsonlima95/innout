<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\WorkHoursController;
use App\Http\Controllers\Web\USerController;
use App\Http\Controllers\TestController;

Route::get('/test', [TestController::class, 'test']);

Route::group(['prefix' => 'app', 'as' => 'app.'], function () {

    /**
     * Routas do login
     */
    Route::get('/login', [AuthController::class, 'formLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('dologin');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware(['auth'])->group(function () {

        /*
         * Rota Dashboard página de início
         */
        Route::get('/', [WorkHoursController::class, 'home'])->name('home');

        /**
         *Rota bater o ponto
         */
        Route::get('/lunch', [WorkHoursController::class, 'lunch'])->name('lunch');

        /**
         * Rotas relacionadas ao usaurio
         */
        Route::resource('/users', UserController::class);

    });


});

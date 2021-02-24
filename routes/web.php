<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\WorkHoursController;
use App\Http\Controllers\Web\UserController;
use App\Http\Controllers\Web\ReportController;
use App\Http\Controllers\TestController;


Route::get('/',[AuthController::class, 'formLogin']);


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


        Route::match(['post','get'],'/month-report',[ReportController::class, 'monthReport'])->name('month-report');
        Route::get('/general-report',[ReportController::class, 'generalReport'])->name('general-report')->middleware(['userAccess']);

    });

});

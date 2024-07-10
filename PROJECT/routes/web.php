<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\TransactionDetailsController;

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

Route::get('/', [IndexController::class, 'Index']);
Route::get('/cetak', [IndexController::class, 'Cetak']);

Route::group(['prefix'=>'api','as'=>'api'], function() {

    Route::get('/indexdata', [IndexController::class, 'IndexData']);
    Route::group(['prefix'=>'trans','as'=>'trans'], function() {
        Route::post('/', [TransactionsController::class, 'PostData']);
        Route::post('create', [TransactionsController::class, 'Create']);
        Route::post('update', [TransactionsController::class, 'Update']);
        Route::post('updatedata', [TransactionsController::class, 'EditData']);
        Route::delete('delete', [TransactionsController::class, 'Delete']);

    });
});

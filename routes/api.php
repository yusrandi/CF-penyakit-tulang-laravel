<?php

use App\Http\Controllers\api\BasisPengetahuanController;
use App\Http\Controllers\api\GejalaController;
use App\Http\Controllers\api\LaporanController;
use App\Http\Controllers\api\PenyakitController;
use App\Http\Controllers\api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/penyakit', [PenyakitController::class, 'index']);
Route::get('/gejala', [GejalaController::class, 'index']);
Route::get('/basis', [BasisPengetahuanController::class, 'index']);
Route::get('/laporan', [LaporanController::class, 'index']);
Route::post('/laporan', [LaporanController::class, 'store']);
Route::post('/user/login', [UserController::class, 'login']);
Route::get('/user/{userId}', [UserController::class, 'index']);

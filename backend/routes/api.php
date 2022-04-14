<?php

use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\ReportController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::prefix('user')->group(function () {
    Route::get('/', [UserController::class,'index']);
    Route::get('/show/{id}', [UserController::class,'show']);
    Route::post('/create', [UserController::class,'store']);
    Route::put('/edit', [UserController::class,'update']);
    Route::delete('/delete', [UserController::class,'destroy']);
});

Route::prefix('report')->group(function () {
    Route::get('/', [ReportController::class,'index']);
    Route::get('/show/{id}', [ReportController::class,'show']);
    Route::post('/create', [ReportController::class,'store']);
    Route::put('/edit', [ReportController::class,'update']);
    Route::delete('/delete', [ReportController::class,'destroy']);
});


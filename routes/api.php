<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Menu\MenuController;
use App\Http\Controllers\Office\OfficeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware' => 'api'], function(){
    Route::prefix('auth')->group(function () {
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/profile', [AuthController::class, 'profile']);
    });


    Route::prefix('menu')->group(function () {
        Route::get('/fetch/{param}', [MenuController::class, 'getMenu']);
    });

    Route::prefix('office')->group(function () {
        Route::get('/fetch', [OfficeController::class, 'fetch']);
        Route::post('/store', [OfficeController::class, 'store']);
        Route::get('/edit/{param}', [OfficeController::class, 'edit']);
        Route::put('/update',[OfficeController::class, 'update']);
        Route::get('/detail/{param}', [OfficeController::class, 'detail']);
        Route::delete('/delete/{param}', [OfficeController::class, 'destroy']);
    });
});

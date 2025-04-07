<?php

use App\Http\Controllers\AccessRole\AccessRoleController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Department\DepartmentController;
use App\Http\Controllers\DepartmentPerPosition\DepartmentPerPositionController;
use App\Http\Controllers\Grade\GradeController;
use App\Http\Controllers\Menu\MenuController;
use App\Http\Controllers\Office\OfficeController;
use App\Http\Controllers\Pos\PosContorller;
use App\Http\Controllers\Position\PositionController;
use App\Http\Controllers\ProdcutPerOffice\ProductPerOfficeController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Type\TypeController;
use App\Http\Controllers\UserMaster\UserMasterController;
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

Route::group(['middleware' => 'api'], function () {
    Route::prefix('auth')->group(function () {
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/profile', [AuthController::class, 'profile']);
    });


    Route::prefix('menu')->group(function () {
        Route::get('/fetch', [MenuController::class, 'getMenu']);
        Route::get('/getAll', [MenuController::class, 'getAll']);
        Route::put('/update', [MenuController::class, 'update']);
    });

    Route::prefix('office')->group(function () {
        Route::get('/fetch', [OfficeController::class, 'fetch']);
        Route::get('/getAll', [OfficeController::class, 'getAll']);
        Route::post('/store', [OfficeController::class, 'store']);
        Route::get('/edit/{param}', [OfficeController::class, 'edit']);
        Route::put('/update', [OfficeController::class, 'update']);
        Route::get('/detail/{param}', [OfficeController::class, 'detail']);
        Route::delete('/delete/{param}', [OfficeController::class, 'destroy']);
    });

    Route::prefix('access_role')->group(function () {
        Route::get('/permission_per_menu/{param}', [AccessRoleController::class, 'permission_per_menu']);
        Route::get('/fetch', [AccessRoleController::class, 'fetch']);
        Route::post('/store', [AccessRoleController::class, 'store']);
        Route::get('/edit/{param}', [AccessRoleController::class, 'edit']);
        Route::put('/update', [AccessRoleController::class, 'update']);
        Route::delete('/delete/{param}', [AccessRoleController::class, 'destroy']);
    });

    Route::prefix('department')->group(function () {
        Route::get('/fetch', [DepartmentController::class, 'fetch']);
        Route::get('/getAll', [DepartmentController::class, 'getAll']);
        Route::post('/store', [DepartmentController::class, 'store']);
        Route::get('/edit/{param}', [DepartmentController::class, 'edit']);
        Route::put('/update', [DepartmentController::class, 'update']);
        Route::delete('/delete/{param}', [DepartmentController::class, 'destroy']);
    });

    Route::prefix('position')->group(function () {
        Route::get('/fetch', [PositionController::class, 'fetch']);
        Route::get('/getAll', [PositionController::class, 'getAll']);
        Route::post('/store', [PositionController::class, 'store']);
        Route::get('/edit/{param}', [PositionController::class, 'edit']);
        Route::put('/update', [PositionController::class, 'update']);
        Route::delete('/delete/{param}', [PositionController::class, 'destroy']);
    });

    Route::prefix('grade')->group(function () {
        Route::get('/getAll', [GradeController::class, 'getAll']);
    });

    Route::prefix('department_per_position')->group(function () {
        Route::get('/fetch', [DepartmentPerPositionController::class, 'fetch']);
        Route::get('/getAll', [DepartmentPerPositionController::class, 'getAll']);
        Route::post('/store', [DepartmentPerPositionController::class, 'store']);
        Route::get('/edit/{param}', [DepartmentPerPositionController::class, 'edit']);
        Route::put('/update', [DepartmentPerPositionController::class, 'update']);
        Route::delete('/delete/{param}', [DepartmentPerPositionController::class, 'destroy']);
    });

    Route::prefix('product')->group(function () {
        Route::get('/getAll', [ProductController::class, 'getAll']);
        Route::get('/fetch', [ProductController::class, 'fetch']);
        Route::post('/store', [ProductController::class, 'store']);
        Route::get('/edit/{param}', [ProductController::class, 'edit']);
        Route::post('/update', [ProductController::class, 'update']);
        Route::delete('/delete/{param}', [ProductController::class, 'destroy']);
        Route::get('/getImage/{param}', [ProductController::class, 'getImage']);
    });

    Route::prefix('category')->group(function () {
        Route::get('/getAll', [CategoryController::class, 'getAll']);
        Route::get('/fetch', [CategoryController::class, 'fetch']);
        Route::post('/store', [CategoryController::class, 'store']);
        Route::get('/edit/{param}', [CategoryController::class, 'edit']);
        Route::put('/update', [CategoryController::class, 'update']);
        Route::delete('/delete/{param}', [CategoryController::class, 'destroy']);
    });

    Route::prefix('type')->group(function () {
        Route::get('/getAll', [TypeController::class, 'getAll']);
        Route::get('/fetch', [TypeController::class, 'fetch']);
        Route::post('/store', [TypeController::class, 'store']);
        Route::get('/edit/{param}', [TypeController::class, 'edit']);
        Route::put('/update', [TypeController::class, 'update']);
        Route::delete('/delete/{param}', [TypeController::class, 'destroy']);
    });

    Route::prefix('product_per_office')->group(function () {
        Route::get('/getAll', [ProductPerOfficeController::class, 'getAll']);
        Route::get('/fetch', [ProductPerOfficeController::class, 'fetch']);
        Route::post('/store', [ProductPerOfficeController::class, 'store']);
        Route::get('/edit/{param}', [ProductPerOfficeController::class, 'edit']);
        Route::put('/update', [ProductPerOfficeController::class, 'update']);
        Route::delete('/delete/{param}', [ProductPerOfficeController::class, 'destroy']);
    });

    Route::prefix('pos')->group(function () {
        Route::post('/getFood', [PosContorller::class, 'getFood']);
        Route::get('/getFood/{param}', [PosContorller::class, 'getDetailFood']);
    });

    Route::prefix('user_master')->group(function () {
        Route::get('/getAll', [UserMasterController::class, 'getAll']);
        Route::get('/fetch', [UserMasterController::class, 'fetch']);
        Route::post('/store', [UserMasterController::class, 'store']);
        Route::get('/edit/{param}', [UserMasterController::class, 'edit']);
        Route::put('/update', [UserMasterController::class, 'update']);
        Route::delete('/delete/{param}', [UserMasterController::class, 'destroy']);
    });
});

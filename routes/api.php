<?php

use App\Http\Controllers\Dashboard\Permission\PermissionController;
use App\Http\Controllers\Dashboard\Position\PositionController;
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




Route::group(
    [
        "prefix" => "dashboard",
    ],
    function () {

        //POSITION
        Route::controller(PositionController::class)->group(function () {
            Route::post('store_position', 'store');
            Route::get('position', 'index');
            Route::get('show_position/{position}', 'show');
            Route::delete('delete_position/{position}', 'delete');
        });

        //PERMISSION
        Route::controller(PermissionController::class)->group(function () {
            Route::post('store_permission', 'store');
            Route::get('permissions', 'index');
            Route::put('update_permission/{permission}', 'update');
            Route::get('show_permission/{permission}', 'show');
            Route::delete('delete_permission/{permission}', 'delete');
        });
    }
);


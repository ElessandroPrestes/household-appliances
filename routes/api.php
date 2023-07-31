<?php

use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\ProductController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::put('v1/brands/{brand}', [BrandController::class, 'update']);
Route::delete('v1/brands/{uuid}', [BrandController::class, 'destroy']);
Route::get('v1/brands/{uuid}', [BrandController::class, 'show']);
Route::post('v1/brands', [BrandController::class, 'store']);
Route::get('v1/brands', [BrandController::class, 'index']);

Route::apiResource('v1/brands/{brand}/products', ProductController::class);
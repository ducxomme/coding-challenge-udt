<?php

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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});


// Customer APIs
Route::get('/v1/customers', [\App\Http\Controllers\Api\V1\CustomerController::class, 'list']);
Route::get('/v1/customers/{id}', [\App\Http\Controllers\Api\V1\CustomerController::class, 'get']);
Route::post('/v1/customers', [\App\Http\Controllers\Api\V1\CustomerController::class, 'create']);
Route::put('/v1/customers/{id}', [\App\Http\Controllers\Api\V1\CustomerController::class, 'update']);
Route::delete('/v1/customers/{id}', [\App\Http\Controllers\Api\V1\CustomerController::class, 'delete']);

// Agency APIs
Route::get('/v1/agencies', [\App\Http\Controllers\Api\V1\AgencyController::class, 'list']);
Route::get('/v1/agencies/{id}', [\App\Http\Controllers\Api\V1\AgencyController::class, 'get']);
Route::post('/v1/agencies', [\App\Http\Controllers\Api\V1\AgencyController::class, 'create']);
Route::put('/v1/agencies/{id}', [\App\Http\Controllers\Api\V1\AgencyController::class, 'update']);
Route::delete('/v1/agencies/{id}', [\App\Http\Controllers\Api\V1\AgencyController::class, 'delete']);

// Product APIs
// Product Category
Route::get('/v1/categories', [\App\Http\Controllers\Api\V1\CategoryController::class, 'list']);
Route::get('/v1/categories/{id}', [\App\Http\Controllers\Api\V1\CategoryController::class, 'get']);
Route::post('/v1/categories', [\App\Http\Controllers\Api\V1\CategoryController::class, 'create']);
Route::put('/v1/categories/{id}', [\App\Http\Controllers\Api\V1\CategoryController::class, 'update']);
Route::delete('/v1/categories/{id}', [\App\Http\Controllers\Api\V1\CategoryController::class, 'delete']);

// Product
Route::get('/v1/products', [\App\Http\Controllers\Api\V1\ProductController::class, 'list']);
Route::get('/v1/products/{id}', [\App\Http\Controllers\Api\V1\ProductController::class, 'get']);
Route::post('/v1/products', [\App\Http\Controllers\Api\V1\ProductController::class, 'create']);
Route::put('/v1/products/{id}', [\App\Http\Controllers\Api\V1\ProductController::class, 'update']);
Route::delete('/v1/products/{id}', [\App\Http\Controllers\Api\V1\ProductController::class, 'delete']);

// Order
Route::get('/v1/orders', [\App\Http\Controllers\Api\V1\OrderController::class, 'list']);
Route::get('/v1/orders/{id}', [\App\Http\Controllers\Api\V1\OrderController::class, 'get']);
Route::post('/v1/orders', [\App\Http\Controllers\Api\V1\OrderController::class, 'create']);
Route::put('/v1/orders/{id}', [\App\Http\Controllers\Api\V1\OrderController::class, 'update']);
Route::delete('/v1/orders/{id}', [\App\Http\Controllers\Api\V1\OrderController::class, 'delete']);

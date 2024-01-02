<?php

use App\Http\Controllers\Api\CategoryController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::group(['prefix'=>'admin'],function(){
    Route::post('/add/category',[CategoryController::class,'store']);
    Route::get('/get/category',[CategoryController::class,'index']);

    Route::get('/products',[ProductController::class,'index']);
    Route::post('/add/products',[ProductController::class,'store']);
    Route::get('/products/list',[ProductController::class,'show']);
});

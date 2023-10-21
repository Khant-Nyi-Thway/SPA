<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;


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

// URI
// Route::get('product',[ProductController::class,'index']);
// Route::post('product',[ProductController::class,'store']);

// Route::get('product/{id}',[ProductController::class,'show']);
// Route::put('product/{id}',[ProductController::class,'update']);
// Route::delete('product/{id}',[ProductController::class,'destroy']);


                /* OR */

    Route::apiResource('product', ProductController::class);

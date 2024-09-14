<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StaffApiController;
use App\Http\Controllers\Api\CategoryApiController;
use App\Http\Controllers\Api\SurveyApiController;

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

Route::get('/testing', function() {
    return response()->json([
        "message" => "message",
    ]);
});


Route::post('/login',[StaffApiController::class,'login']);

Route::post('/forget-password',[StaffApiController::class, 'forgetPass']);
Route::post('/update-password',[StaffApiController::class, 'updatePassword']);

Route::middleware(['auth:staff-api','staff-is-online'])->group(function(){
    Route::get('/logout',[StaffApiController::class, 'logout']);

    Route::get('/profile',[StaffApiController::class, 'profile']);
    Route::get('/color',[StaffApiController::class, 'color']);
    Route::post('/photo',[StaffApiController::class, 'updatePhoto']);

    // category
    Route::post('/categories',[CategoryApiController::class, 'store']);
    Route::get('/categories',[CategoryApiController::class, 'index']);
    Route::get('/categories/{id}/delete',[CategoryApiController::class, 'delete']);
    
});

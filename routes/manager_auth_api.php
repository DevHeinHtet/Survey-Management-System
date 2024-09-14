<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ManagerApi\AuthApiController;

Route::middleware('auth:manager-api')->get("active-account", function() {
    return auth()->user();
});

Route::post('/login',[AuthApiController::class,'login']);


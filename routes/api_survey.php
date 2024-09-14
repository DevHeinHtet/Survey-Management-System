<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SurveyApiController;

Route::middleware(['auth:staff-api','staff-is-online'])->group(function(){
    // survey
    Route::get('/',[SurveyApiController::class, 'index']);
    Route::get('/locations',[SurveyApiController::class, 'getLocations']);
    Route::post('/',[SurveyApiController::class, 'create']);
    Route::post('/{id}/update',[SurveyApiController::class, 'update']);
    Route::get('/{id}/detail',[SurveyApiController::class, 'detail']);
});
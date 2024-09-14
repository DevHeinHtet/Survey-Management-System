<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\NoteApiController;

Route::middleware(['auth:staff-api','staff-is-online'])->group(function(){

    Route::get('/',[NoteApiController::class, 'index'])->name('index');
    Route::post('/',[NoteApiController::class, 'store'])->name('store');
    Route::get('/{id}',[NoteApiController::class, 'show'])->name('show');
    Route::post('/{id}/update',[NoteApiController::class, 'update'])->name('edit');
    Route::get('/{id}/delete',[NoteApiController::class, 'delete'])->name('delete');
});
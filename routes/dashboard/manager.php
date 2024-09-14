<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Manager\ManagerController;

Route::prefix('manager')->name('manager.')->controller(ManagerController::class)->group(function(){
    Route::middleware(['guest:manager', 'PreventBackHistory'])->group(function () {
        
    });
    Route::middleware(['auth:manager', 'recent-route'])->group(function () {
        // Profile
        Route::get('/index','index')->name('index');

        // change auth user profile picture
        Route::post('/change-profile','changeProfile')->name('changeProfile');
        // change aut user data
        Route::post('/change-data','changeData')->name('changeData');
        // change auth user password
        Route::post('/change-password','changePassword')->name('changePassword');

        // manager data to list view
        Route::get('/list' ,'list')->name('list')->middleware('head-manager');
        // update manager detail
        Route::get('/edit/{id}','edit')->name('edit')->middleware('head-manager');
        // update user photo
        Route::post('/update-photo/{id}','updatePhoto')->name('updatePhoto');
        // update user information
        Route::post('/update-information/{id}','updateInfo')->name('updateInfo');
        // reset user password = "password"
        Route::get('/reset-password/{id}','reset')->name('resetPassword')->middleware('head-manager');

        // create manager account page
        Route::view('/create-account','manager.profile.create_account')->name('createAccount')->middleware('head-manager');
        // create manager account
        Route::post('/create-account','accountCreate')->name('accountCreate')->middleware('head-manager');


    });
});
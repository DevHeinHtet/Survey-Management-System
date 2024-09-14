<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Manager\ManagerController;
use App\Http\Controllers\Manager\Staff\StaffController;
use App\Http\Controllers\Manager\Survey\SurveyController;
use App\Http\Controllers\Manager\Report\ReportController;
use App\Http\Resources\SurveyResource;

Route::get("dashboard", function(){
    dd(App\Models\Dashboard::all());
});

Route::get("autocount", function() {
    $dashboard = App\Models\Dashboard::all();
    foreach($dashboard as $e){
        $e->delete();
    }
    $surveys = App\Models\Survey::all();
    foreach($surveys as $survey){
        $dashboard = App\Models\Dashboard::where('status', $survey->status)
        ->where('type', Str::snake(class_basename($survey)))
        ->whereDate('date',$survey->created_at)->first();
        if($dashboard){
            $dashboard->update([
                'count' => $dashboard->count+1,
            ]);
        }else{
            App\Models\Dashboard::create([
                'count' => 1,
                'status' => $survey->status,
                'type' => Str::snake(class_basename($survey)),
                'date' => $survey->created_at
            ]);
        }
    }
    return App\Models\Dashboard::all();
});

Route::view('/hein', 'template.dashboard');
Route::get('/',function(){
    return redirect()->route('manager.login');
});

Route::prefix('manager')->name('manager.')->group( function(){
    Route::middleware(['guest:manager','PreventBackHistory'])->group(function(){
        Route::view('/login','manager.login')->name('login');
        Route::post('/check',[ManagerController::class,'login'])->name('check');
    });
    Route::middleware(['auth:manager','recent-route'])->group(function(){
        Route::get('/home',[ManagerController::class,'home'])->name('home');
        Route::get('/testing',[ManagerController::class,'testing']);
        Route::get('/logout',[ManagerController::class,'logout'])->name('logout');

        // survey
        Route::get('/survey/{status}',[SurveyController::class,'list'])->name('survey.list');
        Route::get('/survey/search',[SurveyController::class,'search'])->name('survey.search');
        Route::post('/survey/update/{id}',[SurveyController::class,'update'])->name('survey.update')->middleware('head-manager');
        Route::post('/survey/update/{id}/manager-remark',[SurveyController::class,'updateManagerRemark']);

        Route::get('/survey/detail/{id}',[SurveyController::class,'detail']);
        Route::get('/survey/accept/{id}',[SurveyController::class,'accepted']);
        Route::get('/survey/reject/{id}',[SurveyController::class,'rejected']);
        Route::get('/survey/restore/{id}',[SurveyController::class,'restore']);
        Route::get('/survey/update-form/{id}',[SurveyController::class,'updateForm'])->middleware('head-manager');


        // staff 
        Route::view('/staff/add','manager.staff.add_staff')->name('staff.add');
        Route::get('/staff/{status}',[StaffController::class,'list'])->name('staff');
        Route::get('/staff/detail/{id}',[StaffController::class,'detail']);
        Route::get('/staff/edit/{id}',[StaffController::class,'edit'])->name('staff.edit');
        Route::post('/staff/update/{id}',[StaffController::class,'update'])->name('staff.update');
        Route::post('/staff/create',[StaffController::class,'create'])->name('staff.create');

        Route::get('/staff/reset-password/{id}',[StaffController::class,'reset'])->name('staff.pass.reset');

        Route::get('/staff/suspend/{id}',function($id){
            $staff = App\Models\Staff::find($id);
            $staff->update([
                'is_active' => false,
            ]);
            return back();
        })->name('staff.suspend');

        Route::get('/staff/reactive/{id}',function($id){
            $staff = App\Models\Staff::byHash($id);
            $staff->update([
                'is_active' => true,
            ]);
            return back();
        });

        // Report
        Route::get('/report/{type}',[ReportController::class,'show'])->name('report');
        Route::post('/report/business/export',[ReportController::class,'bexport'])->name('report.business.export');
        Route::post('/report/surveyor/export',[ReportController::class,'sexport'])->name('report.surveyor.export');

    });
});

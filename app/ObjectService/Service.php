<?php

namespace App\ObjectService;

use App\Models\Manager;
use App\Models\Survey;
use App\Models\Staff;

class Service
{
    public function updateSurveyStatus($status, $id){
        $survey = Survey::byHash($id);
        if(is_null($survey)){
            return view('erros.404');
        }
        $survey->update([
            'status' => $status,
        ]);
        return true;
    }
}
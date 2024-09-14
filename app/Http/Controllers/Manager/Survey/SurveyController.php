<?php

namespace App\Http\Controllers\Manager\Survey;

use App\Http\Controllers\Controller;
use App\ObjectService\Service;
use Illuminate\Http\Request;
use App\Models\Survey;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;

class SurveyController extends Controller
{
    protected $service;

    public function __construct(){
        $this->service = new Service();
    }

    public function list(Request $request, $status){

        $surveys = Survey::query()
                    ->when($request->search, function($query, $search){
                        return $query->where('business_name','LIKE','%'.$search.'%')
                                    ->orWhere('business_type','LIKE','%'.$search.'%')
                                    ->orWhere('owner_name','LIKE','%'.$search.'%');
                    })
                    ->when($request->orderby, function($query, $orderby){
                        return $query->orderby($orderby,'ASC');
                    })
                    ->where('status', $status)
                    ->orderBy('created_at', 'desc')
                    ->paginate(15)
                    ->appends(['search' => $request->query('search')]);

        return view('manager.survey.pending',compact('surveys', 'status'));
    }

    public function update(Request $request,$id){

        $request->validate([
            'owner_name' => 'required',
            'business_name' => 'required',
            'business_type' => 'required',
            'address' => 'required',
            'phone_no' => 'required|min:7|numeric',
            'latitude_logitude' => 'required',
        ]);

        $survey = Survey::byHash($id);

        if($survey){
            
            $survey->update([
                'owner_name' => $request->owner_name,
                'business_name' => $request->business_name,
                'business_type' => $request->business_type,
                'address' => $request->address,
                'phone_no' => $request->phone_no,
                'latitude_logitude' => $request->latitude_logitude,
            ]);

            if($request->photo){
                $name = $request->file('photo')->getClientOriginalName();
                $file = $request->photo->storeAs('public/images',$name);
                $file = Storage::delete('images/'.$survey->photo);
                if($file){
                        $survey->update([
                            'photo' => $name,
                        ]);
                }
            }
            return redirect('manager/survey/detail/'.$survey->hash)->with('success','Survey Data updated successfully ...');
        }

        return redirect('manager/survey/detail/'.$survey->hash)->with('fail','Failed to update data, Try Again ...');
    }

    public function updateForm($id){
        $survey = Survey::byHash($id);
        if($survey){
            return view('manager.survey.survey_update',[
                'survey' => $survey,
            ]);
        }
        return view('erros.404');
    }

    public function updateManagerRemark(Request $request, $id){
        $survey = Survey::byHash($id);
        if($survey){
            $survey->update([
                'manager_remark' =>  Request()->manager_remark
            ]);
            return redirect()->back();
        }
        return view('erros.404');
    }

    public function detail($id){
        $survey = Survey::byHash($id);
        if($survey){
            return view('manager.survey.survey_detail',[
                'survey' => $survey,
            ]);
        }
        return view('erros.404');
    }

    public function accepted($id){
        $this->service->updateSurveyStatus('accepted', $id);
        return redirect()->back();
    }

    public function rejected($id){
        $this->service->updateSurveyStatus('rejected', $id);
        return redirect()->back();
    }

    public function restore($id){
        $this->service->updateSurveyStatus('pending', $id);
        return redirect()->back();
    }
}

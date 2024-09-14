<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController as BaseController;
use App\Http\Resources\SurveyResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Staff;
use App\Models\Survey;

class SurveyApiController extends BaseController
{
    public function index(Request $request){
        $survey = Auth::user()->surveys()
                    ->when($request->search, function($query, $search){
                        $query->where(function($group) use ($search){
                            $group->where('business_name','LIKE', '%'.$search.'%')
                                ->orWhere('business_type','LIKE', '%'.$search.'%')
                                ->orWhere('owner_name','LIKE', '%'.$search.'%');
                        });
                    })
                    ->orderBy('id','DESC')->get();
        if($survey){
            return $this->sendResponse('Survey Data ...',SurveyResource::collection($survey));
        }
        return $this->sendError('No Data Found ...');
    }

    // Location Api
    public function getLocations(Request $request){
        $locations = Survey::select("latitude_logitude")->get();
        if($locations){
            return $this->sendResponse('Locations ...',$locations);
        }
        return $this->sendError('No Data Found ...',"",404);
    }

    // create survey
    public function create(Request $request){

        // validate all input
        $request->validate([
            'companyName' => 'required',
            'businessType' => 'required',
            'ownerName' => 'required',
            'phNo' => 'required|min:7|numeric',
            'address' => 'required',
            'location' => 'required',
            'file' => 'required|image|file|mimes:jpg,jpeg,png|max:5120',
            'remark' => 'required',
        ]);

        $name = $request->file('file')->getClientOriginalName();
        $file = $request->file->storeAs('public/images',$name);
        if(!$file){
            return $this->sendError('No file found ...',"", 500);
        }

        // store survey form
        $survey = Survey::create([
            'business_name' => $request->companyName,
            'business_type' => $request->businessType,
            'owner_name' => $request->ownerName,
            'staff_id' => Auth::user()->id,
            'phone_no' => $request->phNo,
            'address' => $request->address,
            'latitude_logitude' => $request->location,
            'photo' => $name,
            'staff_remark' => $request->remark,
        ]);

        if($survey){
            return $this->sendResponse('Data created successful ...',new SurveyResource($survey));
        }
        return $this->sendError('Failed to create ...',"", 500);
    }

    // update survey
    public function update(Request $request, $id){
        $survey = Auth::user()->surveys()->byHash($id)->first();
        if($survey){
            $survey->update([
                'staff_remark' => $request->remark,
            ]);
            return $this->sendResponse('Data updated successful ...',new SurveyResource($survey));
        }
        return $this->sendError('No Data Found ...',"", 404);
    }

    // show survey detail
    public function detail(Request $request, $id){
        $survey = Auth::user()->surveys()->byHash($id)->first();
        if($survey){
            return $this->sendResponse('Survey Data ...',new SurveyResource($survey));
        }
        return $this->sendError('No Data Found ...',"", 404);
    }
}

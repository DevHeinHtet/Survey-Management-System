<?php

namespace App\Http\Controllers\Manager\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Survey;
use App\Models\Staff;
use App\Exports\BusinessReport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function show(Request $request, $type){
        $staffs = Staff::select('id','name')->get()->toArray();
        $types = Survey::select('business_type')->distinct()->get()->toArray();
        $years = ['2022','2023','2024','2025','2026'];
        return view('manager.report.report',[
            'types' => $types,
            'staffs' => $staffs,
            'type' => $type,
            'years' => $years
        ]);
    }

    public function bexport(Request $request){
        $type = "Business Report";
        $status = $request->status;
        $business_type = $request->business_type;
        $date = $request->first_date;
        $second = $request->second_date;
        $year = $request->choose_year;
        $titleDate = $year;
        if ($request->period == "range") {
            $titleDate = "From ".date('d-m-Y',strtotime($date))." To ".date('d-m-Y',strtotime($second));
        }elseif($request->period == "month"){
            $titleDate = date('F',strtotime($date))." ". date('Y',strtotime($date));
        }elseif($request->period == "date"){
            $titleDate = date('d F Y',strtotime($date));
        }else{
            $titleDate == $year;
        }

        $data = Survey::select('business_name','business_type','owner_name','staff_id','phone_no','address','status')
                ->when($request->business_type != 'all', function($query) use ($business_type){
                    return $query->whereBusinessType($business_type);
                })
                ->when($request->status != 'all', function($query) use ($status){
                    return $query->whereStatus($status);
                })
                ->when($request->period == 'range', function($query) use ($date,$second){
                    return $query->whereBetween('created_at',[$date,$second]);
                })
                ->when($request->period == 'month', function($query) use ($date){
                    return $query->whereMonth('created_at',date('m',strtotime($date)));
                })
                ->when($request->period == 'day', function($query) use ($date){
                    return $query->whereDate('created_at',$date);
                })
                ->when($request->period == 'year', function($query) use ($year){
                    return $query->whereYear('created_at',$year);
                })
                ->orderby('business_name','ASC')
                ->get();

                if($request->report_type == 'excel'){
                    return Excel::download(new BusinessReport($data),'business_report_'.now()->format('d-m-Y h:i:s').'.xlsx');
                }
        return view('manager.report.print',compact('data','type','titleDate'));
    }

    public function sexport(Request $request){
        $type = "Surveyor Report";
        $status = $request->status;
        $business_type = $request->business_type;
        $date = $request->first_date;
        $second = $request->second_date;
        $year = $request->choose_year;
        $titleDate = $year;
        if ($request->period == "range") {
            $titleDate = "From ".date('d-m-Y',strtotime($date))." To ".date('d-m-Y',strtotime($second));
        }elseif($request->period == "month"){
            $titleDate = date('F',strtotime($date))." ". date('Y',strtotime($date));
        }elseif($request->period == "date"){
            $titleDate = date('d F Y',strtotime($date));
        }else{
            $titleDate == $year;
        }
        $staff = Staff::select('name')->whereId($request->staff_id)->first();

        $data = Survey::select('business_name','business_type','owner_name','staff_id','phone_no','address','status')
                ->when($request->business_type != 'all', function($query) use ($business_type){
                    return $query->whereBusinessType($business_type);
                })
                ->when($request->status != 'all', function($query) use ($status){
                    return $query->whereStatus($status);
                })
                ->when($request->period == 'range', function($query) use ($date,$second){
                    return $query->whereBetween('created_at',[$date,$second]);
                })
                ->when($request->period == 'month', function($query) use ($date){
                    return $query->whereMonth('created_at',date('m',strtotime($date)));
                })
                ->when($request->period == 'day', function($query) use ($date){
                    return $query->whereDate('created_at',$date);
                })
                ->when($request->period == 'year', function($query) use ($year){
                    return $query->whereYear('created_at',$year);
                })
                ->whereStaffId($request->staff_id)
                ->orderby('business_name','ASC')
                ->get();

                if($request->report_type == 'excel'){
                    return Excel::download(new BusinessReport($data),'suveyor_report'.now()->format('d-m-Y_h:i:s').'.xlsx');
                }
        return view('manager.report.print',compact('data','type','titleDate','staff'));
     }
}

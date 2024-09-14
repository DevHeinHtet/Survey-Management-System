<?php

namespace App\Http\Controllers\Manager\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Staff;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class StaffController extends Controller
{
    function create(Request $request){

        $request->validate([
            'name' => 'required',
            'gender' => 'required',
            'email' => 'required|unique:staff|email',
            'phone_no' => 'required|min:7|numeric',
            'profile' => 'required|image|file|mimes:jpg,jpeg,png|max:5120',
        ]);

        $pass = explode(' ',$request->name);
        $pass = sizeof($pass) > 1 ? $pass[0].$pass[1] : $pass[0];
        $pass = strtolower($pass);

        //save the image file in storage with original name
        $name = $request->file('profile')->getClientOriginalName();
        $file = $request->profile->storeAs('public/images',$name);
        if(!$file){
            return redirect()->back()->with('fail','Incorrect Image Path ...');
        }

        $staff = Staff::create([
            'name' => $request->name,
            'gender' => $request->gender,
            'position' => $request->position,
            'phone_no' => $request->phone_no,
            'email' => $request->email,
            'password' => \Hash::make($pass),
            'profile_name' => $name,
        ]);

        if($staff){
            return redirect()->back()->with('success','New Staff created successfully ...');
        }
        return redirect()->back()->with('fail','Failed ...');
    }

    public function list(Request $request, $status){
        $staff = Staff::query()
                        ->when($status == 'suspended', function($susp){
                            return $susp->whereIsActive(false);
                        })
                        ->when($status == 'list', function($lis){
                            return $lis->whereIsActive(true);
                        })
                        ->when($request->orderby, function($query, $orderby){
                            return $query->orderby($orderby,'ASC');
                        })
                        ->when($request->search, function($query, $search){
                            return $query->where('name','LIKE','%'.$search.'%')
                                        ->orWhere('position','LIKE','%'.$search.'%')
                                        ->orWhere('phone_no','LIKE','%'.$search.'%');
                        })
                        ->latest()
                        ->paginate(12)
                        ->appends(['search' => $request->query('search')]);
        
        return view('manager.staff.staff_list',[
            'staffs' => $staff,
            'status' => $status
        ]);
    }

    public function detail(Request $request, $id){
        $staff = Staff::byHash($id);
        $surveys = $staff->surveys()->paginate(4);
        if($staff){
            return view('manager.staff.detail_staff',[
                'staff' => $staff,
                'surveys' => $surveys
            ]);
        }
        return view('erros.404');
    }

    public function edit(Request $request, $id){
        $staff = Staff::byHash($id);
        if($staff){
            return view('manager.staff.update',compact('staff'));
        }
        return view('erros.404');
    }

    function update(Request $request, $id){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone_no' => 'required|max:20|min:8',
            'position' => 'required',
            'gender' => 'required',
        ]);

        $staff = Staff::byHash($id);

        if($staff){

            $staff->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone_no' => $request->phone_no,
                'position' => $request->position,
                'gender' => $request->gender,
            ]);

            if($request->profile){
                $name = $request->file('profile')->hashName();
                $file = $request->profile->storeAs('public/images',$name);
                $file = Storage::delete('images/'.$staff->photo);
                if($file){
                        $staff->update([
                            'profile_name' => $name,
                        ]);
                }else{
                    return redirect()->back()->with('fails','Incorrect Image ...');
                }

            }
            return redirect('/manager/staff/detail/'.$staff->hash)->with('success','Staff Updated successfully ...');
        }
        return view('erros.404');
    }

    public function suspended(Request $request){
        $staffs = Staff::whereIsActive(false)->paginate(5);
        return view('manager.staff.suspended',[
            'staffs' => $staffs,
        ]);
    }

    // password reset for staff
    public function reset(Request $request, $id){
        $staff = Staff::byHash($id);

        if($staff){
            $pass = explode(' ',$staff->name);
            $pass = sizeof($pass) > 2 ? $pass[0].$pass[1] : $pass[0];
            $pass = strtolower($pass);
            $staff->update([
                'password' => \Hash::make($pass)
            ]);
            return redirect()->back()->with('success','Password has been changed successfully ...');
        }
        return redirect()->back()->with('fail','errror occur, please retry again ...');
    }
}

<?php

namespace App\Http\Controllers\Manager;

use App\Rules\CheckPassword;
use Carbon\Carbon;
use App\Models\Staff;
use App\Models\Detail;
use App\Models\Survey;
use App\Models\Manager;
use App\Models\Dashboard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class ManagerController extends Controller
{
    protected $service;

    public function __construct(){

    }
    

    function login(Request $request){
        $request -> validate([
            'email' => 'required|email|exists:managers',
            'password' => 'required|max:30|min:5'
        ]);
        $creds = $request->only('email','password');
        if(Auth::guard('manager')->attempt($creds)){
        
            if(session('recent_route')){
                return redirect(session()->get('recent_route'));
            }
            return redirect()->route('manager.home');
        }
        return redirect()->route('manager.login')->with('fail','Incorrect Credentials ...');
    }

    function logout(){
        Auth::guard('manager')->logout();
        return redirect()->route('manager.login');
    }

    public function home(Request $request){

        // dd($request->all());
        $now = now();
        $month = $now->month;
        $year = $now->year;
        
        if($request->has('format')){
            $month = date('m',strtotime($request->format));
            $year = date('Y',strtotime($request->format));
        }

        $staffs = Staff::where('is_active',true)->orderBy('position',"desc")->get();
        
        $common = [];
        $common[0] = Survey::all()->count();
        $common[1] = Survey::whereDate('created_at',$now)->count();
        $common[2] = Survey::distinct('staff_id')->whereDate('created_at',$now)->count();
        $common[3] = Survey::all()->where('status', 'rejected')->count();

        $dashboard = new Dashboard();

        $montlyData = [];

        for($j=1; $j<13; $j++){
            $montlyData[1][$j] = $dashboard->whereMonth('date',$j)->whereYear('date',$year)->whereStatus('accepted')->sum('count');
        }

        for($j=1; $j<13; $j++){
            $montlyData[2][$j] = $dashboard->whereMonth('date',$j)->whereYear('date',$year)->whereStatus('rejected')->sum('count');
        }

        $pieData = [];

        $pieData[0] = $dashboard->whereMonth('date',$month)->whereYear('date',$year)->whereStatus('pending')->sum('count');;

        $pieData[1] = $dashboard->whereMonth('date',$month)->whereYear('date',$year)->whereStatus('accepted')->sum('count');;

        $pieData[2] = $dashboard->whereMonth('date',$month)->whereYear('date',$year)->whereStatus('rejected')->sum('count');;

        $locations = Survey::select('latitude_logitude')->get();

        return view('manager.home',[
            'common' => $common,
            'pieData' => $pieData,
            'staffs' => $staffs,
            'montlyData' => $montlyData,
            'monthNo' => $month,
            'year' => $year,
            'dashboard' => $dashboard,
            'locations' => $locations,
        ]);
    }

    public function index(){
        $manager = Manager::find(Auth::user()->id);
        return view('manager.profile.profile',compact('manager'));
    }

    // director list
    public function list(){
        return view('manager.profile.managerList',[
            'list' =>Manager::latest()->where('position','director')->paginate(10),
        ]);
    }

    // auth user profile change
    public function changeProfile(Request $request){
        if($request->has('profile')){
            $manager = Manager::find(Auth::user()->id);
            if($manager){
                $name = $request->file('profile')->hashName();
                $upload = $request->profile->storeAs(
                    'public/images/manager',
                    $name
                );
                if(Storage::exists('public/images/manager/'.$manager->file)){
                    $delete = Storage::delete('public/images/manager/'.$manager->file);
                }
                $manager->update([
                    'file' => $name,
                ]);
                return redirect()->back()->with('success','Profile uploaded successfully ...');
            } 
            return redirect()->back()->with('fail','You are cheater');
        }
        return redirect()->back()->with('fail','Choose an image, first');
    }

    // auth user data change
    public function changeData(Request $request){
        $manager = Manager::find(Auth::user()->id);
        $detail = $manager->detail;
        if($detail){
            $update = $manager->detail()->update([
                'phone_no' => $request->phone_no,
                'address' => $request->address,
                'url' => $request->url,
                'city' => $request->city,
                'country' => $request->country,
            ]);
            return redirect()->back()->with('success','Detail updated successfully ...');
        }
        $update = $manager->detail()->create([
            'phone_no' => $request->phone_no,
            'address' => $request->address,
            'url' => $request->url,
            'city' => $request->city,
            'country' => $request->country,
        ]);
        return redirect()->back()->with('success','Detail added successfully ...');
    }

    // user profile change
    public function updatePhoto(Request $request, $id){
        if($request->has('profile')){
            $manager = Manager::byHash($id);
            if($manager){
                $name = $request->file('profile')->hashName();
                $upload = $request->profile->storeAs(
                    'public/images/manager',
                    $name
                );
                if(Storage::exists('public/images/manager/'.$manager->file)){
                    $delete = Storage::delete('public/images/manager/'.$manager->file);
                }
                $manager->update([
                    'file' => $name,
                ]);
                return redirect()->back()->with('success','Profile uploaded successfully ...');
            } 
            return redirect()->back()->with('fail','You are cheater');
        }
        return redirect()->back()->with('fail','Choose an image, first');
    }

    // user information change
    public function updateInfo(Request $request, $id){
        $manager = Manager::byHash($id);
        $detail = $manager->detail;
        if($detail){
            $update = $manager->detail()->update([
                'phone_no' => $request->phone_no,
                'address' => $request->address,
                'url' => $request->url,
                'city' => $request->city,
                'country' => $request->country,
            ]);
            return redirect()->back()->with('success','Detail updated successfully ...');
        }
        $update = $manager->detail()->create([
            'phone_no' => $request->phone_no,
            'address' => $request->address,
            'url' => $request->url,
            'city' => $request->city,
            'country' => $request->country,
        ]);
        return redirect()->back()->with('success','Detail added successfully ...');
    }

    // change auth user password
    public function changePassword(Request $request){
        $request->validate([
            'current_pass' => ['required','min:5',new CheckPassword],
            'new_pass' => ['required','min:5'],
            'c_new_pass' => 'required|min:5|same:new_pass',
        ],[
            'c_new_pass.same' => 'Password much be same'
        ]);
        Manager::whereId(Auth::user()->id)->update([
            'password' => Hash::make($request->new_pass)
        ]);
        return back()->with("success", "Password changed successfully!");
    }

    // create director account
    public function accountCreate(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:managers|email',
            'phone_no' => 'required|numeric|min:7',
            'address' => 'required',
            'city' => 'required',
            'country' => 'required',
            'file' => 'required|image|file|mimes:jpg,jpeg,png|max:5120'
        ]);

        $name = $request->file('file')->hashName();
        $upload = $request->file->storeAs(
            'public/images/manager',
            $name
        );

        $manager = Manager::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => \Hash::make('password'),
            'file' => $name,
        ])->detail()->create([
            'phone_no' => $request->phone_no,
            'address' => $request->address,
            'city' => $request->city,
            'country' => $request->country,
        ]);

        if($manager){
            return redirect()->back()->with('success','Manager account created successfully ...');
        }
        return redirect()->back()->with('fail','Failed ...');
    }

    // update manager from head manager 
    public function edit($id){
        $manager = Manager::byHash($id);
        if($manager){
            return view('manager.profile.update',compact('manager'));
        }
    }

    // reset director password
    public function reset($id){
        $manager = Manager::byHash($id);
        if($manager){
            $manager->update([
                'password' => Hash::make('password')
            ]);
            return redirect()->back()->with('success','Password reset successfully ...');
        }
        return view('erros.404');
    }
}
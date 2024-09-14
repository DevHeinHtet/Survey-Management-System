<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController as BaseController;
use App\Http\Controllers\Controller;
use App\Http\Resources\StaffResource;
use Illuminate\Http\Request;
use Validator;
use App\Models\Note;
use App\Models\Staff;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Mail\ForgetPassword;
use Illuminate\Support\Str;
use Jenssegers\Agent\Facades\Agent;


class StaffApiController extends BaseController
{
    // Staff Login Api
    public function login(Request $request){
        $request->validate([
            'login_id' => 'required|email|exists:staff,email',
            'password' => 'required|min:5',
        ],[
            'login_id.exists' => 'The email is not registered',
        ]);

        $creds = array('email' => $request->login_id, 'password' => $request->password);

        // check attempt staff email and password 
        if(Auth::guard('staff')->attempt($creds)){
             $user = Auth::guard('staff')->user();
            //  check attempted staff is active or not
            if($user->is_active){
                $user->tokens()->delete();
                if(Agent::device()){
                    $token= $user->createToken($agent->device()." ".$agent->browser())->plainTextToken;
                }else{
                    $token= $user->createToken("Unknown")->plainTextToken;
                }
                $data = [
                    'auth' => new StaffResource($user),
                    'token' => $token,
                ];
                return $this->sendResponse('Login successful ...', $data);
            }
            Auth::guard('staff')->logout();
            return $this->sendError('Your account has been blocked',"",404);
        }
        return $this->sendError('Incorrect Password ...',"",404);
     }

     public function logout(){
        $user = Auth::user();
        Cache::forget('user-is-online-'.$user->id);
        $user->currentAccessToken()->delete();
        Auth::guard('staff')->logout();
        return $this->sendResponse('Logout successful ...', "");
     }

     // get staff profile photo theme
    public function profile(Request $request){
        $staff = Auth::user();
        $data = [
            'profile' => new StaffResource($staff)
        ];
        return $this->sendResponse('', $data);
    }

    //  store staff profile color theme
    public function color(Request $request){
        $staff = Auth::user();
        if($request->has('color_name')){
            $result = $staff->update([
                'color_name' => $request->color_name,
            ]);
            if($result){
                return $this->sendResponse('Color updated successful ...', ['color_name' => $staff->color_name]);
            }
        }
        return $this->sendResponse('', ['color_name' => $staff->color_name]); 
    }

    // store staff profile photo
    public function updatePhoto(Request $request){
        // validate file requirements
        $request->validate([
            'file' => 'required|image|file|mimes:jpg,jpeg,png|max:5120',
        ]);

        $staff = Auth::user();

        // file store and delete in storage
        $name = $request->file('file')->getClientOriginalName();
        $file = $request->file->storeAs('public/images',$name);
        $file = Storage::delete('images/'.$staff->profile_name);
        if($file){
            $staff->update([
                'profile_name' => $name,
            ]);
            return $this->sendResponse('Profile updated successfully', [ 'profile_name' => $staff->profile_name ]); 
        }
        return $this->sendResponse('', $data); 
    }


    public function forgetPass(Request $request){

        $request->validate([
            'email' => 'required|exists:staff|email',
            'url' => 'required'
        ]);

        $token = \base64_encode(Str::random(64));

        DB::table('password_resets')->whereEmail($request->email)->delete();

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
        ]);

        $surveyor = Staff::where('email',$request->email)->first();

        $link = $request->url."?token=".$token."&email=".$request->email;

        Mail::to($request->email)->send(new ForgetPassword($link, $surveyor));

        return $this->sendResponse('Check your email', $link); 

    }

    function updatePassword(Request $request){
        $validator = Validator::make($request->all(),[
            'email' => ['required', 'email'],
            'token' => 'required',
            'new_password' => 'required|max:20|min:5'
        ]);

        if($validator->fails()){
            return $this->sendError('', $validator->errors()); 
        }

        $check_token = DB::table('password_resets')->where([
            'email' => $request->email,
            'token' => $request->token
        ])->first();

        if(!$check_token){
            return $this->sendError('Incorrect User Token ...',"",404); 
        }

        Staff::where('email',$request->email)->update([
            'password' => \Hash::make($request->new_password)
        ]);

        DB::table('password_resets')->where([
            'email' => $request->email,
        ])->delete();

        return $this->sendResponse('Password updated successfully ...', ""); 
    }
}

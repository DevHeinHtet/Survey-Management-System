<?php

namespace App\Http\Controllers\ManagerApi;

use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthApiController extends BaseController
{
    function login(Request $request){
        $request -> validate([
            'email' => 'required|email|exists:managers',
            'password' => 'required|max:30|min:5'
        ]);
        $creds = $request->only('email','password');
        if(Auth::guard('manager')->attempt($creds)){
            $manager = Auth::guard('manager')->user();
            $token= $manager->createToken("AuthToken")->plainTextToken;
            $data = [
                'token' => $token,
                'manager' => $manager
            ];
            return $this->sendResponse('Login successful ...', $data);
        }
        return $this->sendError('Incorrect Password ...');
    }
}

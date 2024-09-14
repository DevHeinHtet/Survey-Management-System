<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function sendResponse($message, $result){
        $response = [
            'success' => true,
            'message' => $message,
            'data' => $result,
        ];

        return response()->json($response,200);
    }

    public function sendError($errorMessage, $error = [] , $code = 500 ){
        $response = [
            'success' => false,
            'message' => $errorMessage
        ];

        if(!empty($error)){
            $response['data'] = $error;
        }

        return response()->json($response, $code);
    }
}

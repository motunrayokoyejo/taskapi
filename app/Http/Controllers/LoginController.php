<?php

namespace App\Http\Controllers;

use App\Exceptions\LoginException;
use Illuminate\Http\Request;
use App\Services\LoginService;
use Illuminate\Http\JsonResponse;

class LoginController extends Controller
{
    public function login(Request $request) : JsonResponse
    {
        $validateUserInput = $this->validate($request, [
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if ($validateUserInput){
            
            try {

                $validatedUser = LoginService::signin($validateUserInput, $request);

                return response()->json([

                    'user' => $validatedUser

                ], 200);

            } catch (LoginException $exception){

                return response()->json([

                    'message' => $exception->getMessage(),

                    'status' => $exception->getCode()

                ], 500);

            }
        }else{

                $response = ['message' => 'User does not exist'];
    
                return response($response, 401);
            }


    }
}
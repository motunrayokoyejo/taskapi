<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Services\RegisterService;
use App\Exceptions\FailedRegistrationException;


class RegisterController extends Controller
{   
    /**
     * @param Illuminate\Http\Request $request
     * 
     * @return Illuminate\Http\JsonResponse
     * 
     * @throws Throwable
     */
    public function register(Request $request) :JsonResponse 
    {
    
        $validated = $this->validate($request, [
            'name' => ['required', 'max:80'],
            'email' => ['required', 'email:80'],
            'password' => ['required']
        ]);

        try { 
            $newUser = RegisterService::signup(

                name: $validated['name'],

                email : $validated['email'],

                password: $validated['password'],

                connectingIp: $request->getClientIp()
            );

            return response()->json([

                "message" => "User created successfully",

                "user" => $newUser

            ], 201);

        } catch(FailedRegistrationException $exception){

            return response()->json([

                'message' => $exception->getMessage(),

                'status code' => $exception->getCode()
            ]);
        }    
        

    }

    
}

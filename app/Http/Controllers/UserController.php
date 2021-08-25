<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Carbon\Carbon;

class UserController extends Controller
{
    public function register(Request $request){

        $validated = $this->validate($request,[

            'name' => 'required',
    
            'email' => ['required', 'unique:users', 'email'],
    
            'password' => ['required']
        ]);
        
        if ($validated) {
    
            $user = new User;
    
            $user->name = $validated['name'];
    
            $user->email = $validated['email'];
    
            $user->password = Hash::make($validated['password']);

            $user->last_login_at = Carbon::now()->toDateTimeString();

            $user->last_login_ip = $request->getClientIp();

            $user->save();
       
            return response()->json([
    
                "message" => "User created successfully"
                
            ], 201);
        }
        else {
    
             return response()->json([
    
                "message" => "Data Validation failed"
    
            ], 400);
        }

    }

    public function login(Request $request){

        $user = User::where('email', $request->email)->first();

        if ($user){

            if (Hash::check($request->password, $user->password)){

                $token = $user->createToken('token') ->accessToken;

                $response = ['token' => $token];

                $user->update([
                    'last_login_at' => Carbon::now()->toDateTimeString(),
                    'last_login_ip' => $request->getClientIp()
                ]);

                

                return response($response, 200);
            } 
            
            else {

                $response = ['message' => 'Password mismatch'];

                return response($response, 401);
            }
        }
        
        else{

            $response = ['message' => 'User does not exist'];

            return response($response, 401);
        }

    }
    



    public function history(){

        $retrieveLoginHistory = User::all();

        return response()->json([

            'message' => 'Transaction retrieves successfully',

            'data' => $retrieveLoginHistory
            
        ], 200);

    }
}

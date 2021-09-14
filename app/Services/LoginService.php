<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Carbon\Carbon;
use App\Exceptions\LoginException;

class LoginService 
{
    public static function signin(Array $input, Request $request): array
    {
        $savedUser = User::where('email', $input['email'])->first();

        if ($savedUser){

            if (Hash::check($request->password, $savedUser->password)){

                $token = $savedUser->createToken('token') ->accessToken;

                $savedUser->update([

                    'last_login_at' => Carbon::now()->toDateTimeString(),

                    'last_login_ip' => $request->getClientIp()
                ]);
            }
            else {

                    $response = ['message' => 'Password mismatch'];
            
                        return response($response, 401);
                    }    
        }

        else{

            throw LoginException::userNotFoundException ('User not found');
        }
        
        return [
            
            'token' => $token
        ];
}
}
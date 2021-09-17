<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Carbon\Carbon;
use App\Exceptions\LoginException;
use RuntimeException;

class LoginService 
{
    protected static function checkUserIsSaved(string $email): User
    {
        return User::where('email', $email)->first();
    }

    public static function signin(Array $input, Request $request): array
    {
        $savedUser = static::checkUserIsSaved($input['email']);

        if(!$savedUser && Hash::check($input['password'], $savedUser->password)) {

            throw LoginException::userNotFoundException('No user with this credential found');

        }

        $token = $savedUser->createToken('token') ->accessToken;

        $savedUser->update([

            'last_login_at' => Carbon::now()->toDateTimeString(),

            'last_login_ip' => $request->getClientIp()
            ]);

        return [
            
            'token' => $token
        ];
    }
}
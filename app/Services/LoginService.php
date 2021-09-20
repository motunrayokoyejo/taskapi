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

    public static function signin(array $input, $ipAddress): array
    {
        $savedUser = User::where('email', $input['email'])->first();;

        if(!$savedUser && Hash::check($input['password'], $savedUser->password)) {

            throw LoginException::userNotFoundException('No account with this credential found');

        }

        $token = $savedUser->createToken('token') ->accessToken;

        $savedUser->update([
            'last_login_at' => Carbon::now()->toDateTimeString(),
            'last_login_ip' => $ipAddress
        ]);

        return ['token' => $token];
    }
}
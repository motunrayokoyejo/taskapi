<?php

namespace App\Services;

use App\Events\RegistrationEvent;
use App\Exceptions\UserExistException;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use RuntimeException;

class RegisterService{

    public static function signup(
        string $name,
        string $email,
        string $password,
        ?string $connectingIp = null
    ) : User{

        $checkIfUserExist = User::where('email', $email)->first();

        if ($checkIfUserExist){

            throw new RuntimeException('User already exist with the provided email', 407);
        }
       
            $user = new User();
    
            $user->name = $name;
    
            $user->email = $email;
    
            $user->password = Hash::make($password);

            $user->last_login_at = Carbon::now()->toDateTimeString();

            $user->last_login_ip = $connectingIp ?? 'Not set';

            if (! $user->save()) {

                throw new RuntimeException('Failed to save new user');
            }

            $newUser = User::where('email', $email)->first();

            if ($newUser === null){

                throw new RuntimeException('Oops, I have troubles loading users details');
            }

            event(new RegistrationEvent(user: $user));

           return $newUser;   
                
        }

    }


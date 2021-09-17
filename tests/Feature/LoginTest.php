<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginTest extends TestCase

{
    use WithFaker;

    public function testUserLogin(){

        $newUser = User::factory()->create([
            'email' => 'mo@mo.com',
            'password' => Hash::make('123456')
        ]);

        $loginUser = [
            'email' => 'mo@mo.com',
            'password' => '123456'
        ];
        
        $this->json('post', 'api/login', $loginUser)
             ->assertStatus(200)
             ->assertJson(
                 [
                    'token' => 'token'
                 ]
                 );
    }

}
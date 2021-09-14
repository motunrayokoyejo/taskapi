<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class UserTest extends TestCase

{
    use WithFaker;

    public function testUserRegistration()
    {
        $newUser = [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'password' => $this->faker->password

        ];
        $this->json('post', 'api/register', $newUser)
             ->assertStatus(201)
             ->assertJson(
                 [
                     'message' => 'User created successfully'
                 ]
             );
       
    }

    public function testUserLogin(){
        $loginUser = [
            'email' => $this->faker->email,
            'password' => $this->faker->password
        ];
        $this->json('post', 'api/login', $loginUser)
             ->assertStatus(201)
             ->assertJson(
                 [
                    'token' => 'token'
                 ]
                 );
    }

    public function testUserHistory(){
        $this->json('get', 'api/history')
             ->assertStatus(200)
             ->assertJson([
                "message"=> "Transaction retrieves successfully",
                "data" => []        
                ]);

    }
}

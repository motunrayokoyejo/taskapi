<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserHistoryTest extends TestCase
{
    public function testUserHistory(){
        $this->json('get', 'api/history')
             ->assertStatus(200)
             ->assertJson([
                "message"=> "Transaction retrieves successfully",
                "data" => []        
                ]);

    }
    
}

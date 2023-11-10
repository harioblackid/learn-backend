<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function testRegisterSuccess(){
        $this->post('/api/users', [
            'username' => 'harioblackid',
            'password' => '123',
            'name' => 'Hario saloko'
        ])->assertStatus(201)
        ->assertJson([
            'data' => [
                'username' => 'harioblackid',
                'password' => '123',
                'name' => 'Hario saloko'
            ]
        ]);
    }

    public function testRegisterFailed(){

    }

    public function testRegisterExists(){

    }
}

<?php

namespace Tests\Feature\Api\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use UtilsTrait;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_fail_auth()
    {
        $response = $this->postJson('/auth', []);

        $response->assertStatus(422);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_auth()
    {
        $user = User::factory()->create();

        $response = $this->postJson('/auth', [
            'email' => $user->email,
            'password' => 'password',
            'device_name' => 'test'
        ]);

        $response->assertStatus(200);
    }


    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_error_logout()
    {
        $user = User::factory()->create();

        $response = $this->postJson('/logout');

        $response->assertStatus(401);
    }


    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_logout()
    {
        $token = $this->createTokenUser();

        $response = $this->postJson('/logout', [], [
            'Authorization' => "Bearer {$token}"
        ]);

        $response->assertStatus(200);
    }

    public function test_get_me()
    {
        $token = $this->createTokenUser();



        $response = $this->postJson('/me', [], [
            'Authorization' => "Bearer {$token}"
        ]);

        $response->assertStatus(200);
    }
}

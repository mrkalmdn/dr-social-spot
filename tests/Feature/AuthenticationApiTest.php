<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthenticationApiTest extends TestCase
{
    /** @test */
    public function it_can_authenticate()
    {
        $user = factory(User::class)->create();

        $payload = [
            'username' => $user->username,
            'password' => 'password'
        ];

        $this->postJson(route('login'), $payload)
            ->assertOk()
            ->assertJsonStructure([
                'access_token',
                'token_type',
                'expires_in'
            ]);
    }

    /** @test */
    public function it_can_show_ther_authenticated_user_information()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user, 'api')
            ->getJson(route('me'))
            ->assertOk()
            ->assertJsonStructure([
                'name',
                'username',
                'email'
            ]);
    }
}

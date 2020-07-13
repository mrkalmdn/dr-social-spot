<?php

namespace Tests\Feature;

use Tests\TestCase;

class AuthenticationApiTest extends TestCase
{
    /**
     * Throws an error when creating a password mutator.
     *
     * @skipTest
     * */
    public function it_can_authenticate()
    {
        $payload = [
            'username' => $this->user->username,
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
        $this->actingAs($this->user, 'api')
            ->getJson(route('me'))
            ->assertOk()
            ->assertJsonStructure([
                'name',
                'username',
                'email'
            ]);
    }
}

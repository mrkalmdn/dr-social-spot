<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;

class UserRegistrationApiTest extends TestCase
{
    /** @test */
    public function it_can_register_a_user()
    {
        $user = [
            'name' => $this->faker->name,
            'username' => $this->faker->unique()->userName,
            'email' => $this->faker->unique()->safeEmail,
            'password' => 'secret'
        ];

        $this->postJson(route('register'), $user)
            ->assertCreated()
            ->assertJsonStructure([
                'name',
                'username',
                'email'
            ]);
    }

    /** @test */
    public function it_throws_an_error_when_registering_a_user_with_an_empty_fields()
    {
        $this->postJson(route('register'), [])
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'name',
                'username',
                'email',
                'password'
            ]);
    }

    /** @test */
    public function it_throws_an_error_when_registering_a_user_with_an_existing_username_or_email()
    {
        $user1 = factory(User::class)->create();
        $user2 = factory(User::class)->create();

        $user = [
            'name' => $this->faker->name,
            'username' => $user1->username,
            'email' => $user2->email,
            'password' => 'secret'
        ];

        $this->postJson(route('register'), $user)
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'username',
                'email',
            ]);
    }

    /** @test */
    public function it_should_follow_all_the_existing_users_when_creating_a_new_user()
    {
        $users = factory(User::class, 5)->create();

        $user = [
            'name' => $this->faker->name,
            'username' => $this->faker->unique()->userName,
            'email' => $this->faker->unique()->safeEmail,
            'password' => 'secret'
        ];

        $response = $this->postJson(route('register'), $user)
            ->assertCreated();

        $newUser = $response->getOriginalContent();

        $users->each(function ($user) use ($newUser) {
            $this->assertTrue($user->isFollowing($newUser));
            $this->assertTrue($newUser->isFollowing($user));
        });
    }
}

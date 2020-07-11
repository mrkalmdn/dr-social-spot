<?php

namespace Tests\Feature;

use App\Post;
use Tests\TestCase;

class PostApiTest extends TestCase
{
    /** @test */
    public function it_can_create_a_post()
    {
        $post = factory(Post::class)->make([
            'user_id' => $this->user->id
        ]);

        $this->actingAs($this->user, 'api')
            ->postJson(route('posts.store'), $post->toArray())
            ->assertCreated()
            ->assertJsonStructure(['body', 'user_id', 'created_at']);
    }

    /** @test */
    public function it_can_update_a_post()
    {
        $post = factory(Post::class)->create([
            'user_id' => $this->user->id
        ]);

        $payload = [
            'body' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste, molestias.',
            'user_id' => $this->user->id
        ];

        $this->actingAs($this->user, 'api')
            ->putJson(route('posts.update', $post->id), $payload)
            ->assertStatus(202)
            ->assertJsonStructure(['body', 'user_id', 'created_at']);
    }

    /** @test */
    public function it_can_delete_a_post()
    {
        $post = factory(Post::class)->create([
            'user_id' => $this->user->id
        ]);

        $this->actingAs($this->user, 'api')
            ->deleteJson(route('posts.destroy', $post->id))
            ->assertNoContent();
    }

    /** @test */
    public function it_can_be_liked()
    {
        $post = factory(Post::class)->create();

        $this->actingAs($this->user, 'api')
            ->postJson(route('posts.like', $post->id))
            ->assertOk();

        $this->assertTrue($this->user->likes($post));
    }

    /** @test */
    public function it_can_be_unliked()
    {
        $post = factory(Post::class)->create();

        $this->actingAs($this->user, 'api')
            ->postJson(route('posts.unlike', $post->id))
            ->assertOk();

        $this->assertFalse($this->user->likes($post));
    }
}

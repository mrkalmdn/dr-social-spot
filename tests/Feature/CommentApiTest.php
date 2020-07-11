<?php

namespace Tests\Feature;

use App\Post;
use Tests\TestCase;

class CommentApiTest extends TestCase
{
    /** @test */
    public function it_can_comment_to_a_post()
    {
        $post = factory(Post::class)->create();

        $comment = [
            'commentableKey' => $post->commentableKey,
            'body' => 'Lorem ipsum dolor sit amet.'
        ];

        $this->actingAs($this->user, 'api')
            ->postJson(route('comments.store'), $comment)
            ->assertCreated();
    }

    /** @test */
    public function it_can_reply_to_a_comment()
    {
        $post = factory(Post::class)->create();

        $comment = [
            'commentableKey' => $post->commentableKey,
            'body' => 'Lorem ipsum dolor sit amet.'
        ];

        $response = $this->actingAs($this->user, 'api')
            ->postJson(route('comments.store'), $comment)
            ->assertCreated();

        $comment = $response->getOriginalContent();

        $reply = [
            'body' => 'Lorem, ipsum.'
        ];

        $this->actingAs($this->user, 'api')
            ->postJson(route('comments.replies.store', $comment), $reply)
            ->assertCreated();
    }
}

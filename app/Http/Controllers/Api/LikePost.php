<?php

namespace App\Http\Controllers\Api;

use App\Post;
use App\Http\Controllers\Controller;

class LikePost extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  Post  $post
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Post $post)
    {
        auth()->user()->like($post);

        return response()->json(['message' => 'Liked post.']);
    }
}

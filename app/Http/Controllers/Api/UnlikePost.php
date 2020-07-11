<?php

namespace App\Http\Controllers\Api;

use App\Post;
use App\Http\Controllers\Controller;

class UnlikePost extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Post $post)
    {
        auth()->user()->unlike($post);

        return response()->json(['message' => 'Unliked post.']);
    }
}

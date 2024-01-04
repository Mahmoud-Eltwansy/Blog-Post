<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostCommentController extends Controller
{
    public function store(Post $post)
    {

        request()->validate([
            'body' => ['required']
        ]);

        $post->comments()->create([
            'body' => request('body'),
            'user_id' => auth()->id()
        ]);

        return back();

    }
}

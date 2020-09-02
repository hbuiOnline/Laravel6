<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Post;

class PostsController extends Controller
{
    public function show($slug) {

        // $post = DB::table('posts')->where('slug', $slug)->first();
        // $post = Post::where('slug', $slug)->firstOrFail();
        // dd($post);

        return view('post', [
            'post' => Post::where('slug', $slug)->firstOrFail()
        ]);

    }
}

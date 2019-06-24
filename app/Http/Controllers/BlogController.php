<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::all();

        return view('blog.index', compact('posts'));
    }

    public function view(String $slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();

        return view('blog.view', compact('post'));
    }
}

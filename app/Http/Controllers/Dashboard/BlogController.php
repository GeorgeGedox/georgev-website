<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.blog.index', [
            'posts' => Post::orderByDesc('id')->paginate(15)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:250',
            'body' => 'required|string'
        ]);

        $post = Post::create($request->all());

        // Draft handle
        if ($request->has('draft')){
            $post->update(['draft' => 1]);
        }else{
            $post->update(['draft' => 0]);
        }

        return redirect()->route('dashboard.blog.edit', $post)->with('status', 'Post changes saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('dashboard.blog.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string|max:250',
            'body' => 'required|string'
        ]);

        $post->update($request->all());

        // Draft handle
        if ($request->has('draft')){
            $post->update(['draft' => 1]);
        }else{
            $post->update(['draft' => 0]);
        }

        return redirect()->route('dashboard.blog.edit', $post)->with('status', 'Post changes saved!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Post $post
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Post $post)
    {
        if (!$post->delete()){
            return redirect()->route('dashboard.blog.index', $post)->with('error', 'Unable to delete post.');
        }

        return redirect()->route('dashboard.blog.index', $post)->with('status', 'Post deleted!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.manage.index', ['posts' => Post::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.manage.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'title' => 'required|max:255',
            'video' => 'required|mimes:mp4|file:max:40000'
        ]);
        
        if($request->file('video')) {
            $validateData['video'] = $request->file('video')->store('videos');
        }

        Post::create($validateData);

        return redirect('/dashboard/manage')->with('success', 'Video uploaded successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
       return view('dashboard.manage.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {   
        return view('dashboard.manage.edit', [
            'post' => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $validateData = $request->validate([
            'title' => 'required|max:255',
            'video' => 'required|mimes:mp4|file:max:40000'
        ]);
        
        if($request->file('video')) {
            if($request->oldVideo){
                Storage::delete($request->oldVideo);
            }
            $validateData['video'] = $request->file('video')->store('videos');
        }

        Post::where('id', $post->id)
            ->update($validateData);

        return redirect('/dashboard/manage')->with('success', 'Video edited successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if($post->video){
            Storage::delete($post->video);
        }
        Post::destroy($post->id);
        return redirect('/dashboard/manage')->with('success', 'Video deleted successfully');
    }
}

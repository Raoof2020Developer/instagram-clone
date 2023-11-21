<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct() {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $posts = Post::all();
        $suggestedUsers = auth()->user()->suggested_users();
        return view('posts.index', compact(['posts', 'suggestedUsers']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'description' => 'required',
            'image' => 'required|mimes:jpg,png,jpeg,gif'
        ]);

        $image = $request['image']->store('posts', 'public');
        $data['image'] = $image;

        $data['slug'] = Str::random(10);
        auth()->user()->posts()->create($data);

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'description' => 'required',
            'image' => 'nullable|mimes:jpg,png,jpeg,gif'
        ]);

        if (request()->has('image')) {
            $image = $request['image']->store('posts', 'public');
            $data['image'] = $image;
        }

        $post->update($data);

        return redirect()->route('posts.show', $post->slug);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        Storage::delete('public/' . $post->image);
        $post->delete();

        return redirect('/dashboard');
    }

    public function explore() {
        $posts = Post::whereRelation('owner', 'private_account', '=', 0)->whereNot('user_id', auth()->id())->paginate(9);
        return view('posts.explore', compact('posts'));
    }
}
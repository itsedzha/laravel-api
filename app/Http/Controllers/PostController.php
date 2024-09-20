<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the posts.
     */
    public function index()
    {
        $posts = Post::all();
        return response()->json($posts);
    }

    /**
     * Store a newly created post in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return response()->json($post, 201);
    }

    /**
     * Display the specified post.
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);

        return response()->json($post);
    }

    /**
     * Update the specified post in storage.
     */
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'content' => 'sometimes|required|string',
        ]);

        $post->update($request->all());

        return response()->json($post);
    }

    /**
     * Remove the specified post from storage.
     */
    public function destroy($id)
    {
    
        $post = Post::findOrFail($id);

        $post->delete();

        return response()->json(['message' => 'Post deleted successfully']);
    }

    public function __construct()
{
    $this->middleware('auth:sanctum')->only(['store', 'update', 'destroy']);
}

}

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
        // Retrieve all posts from the database
        $posts = Post::all();
        return response()->json($posts);
    }

    /**
     * Store a newly created post in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        // Create a new post
        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return response()->json($post, 201); // Return the created post with status 201
    }

    /**
     * Display the specified post.
     */
    public function show($id)
    {
        // Find the post by ID
        $post = Post::findOrFail($id);

        return response()->json($post);
    }

    /**
     * Update the specified post in storage.
     */
    public function update(Request $request, $id)
    {
        // Find the post by ID
        $post = Post::findOrFail($id);

        // Validate the request data
        $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'content' => 'sometimes|required|string',
        ]);

        // Update the post with new data
        $post->update($request->all());

        return response()->json($post);
    }

    /**
     * Remove the specified post from storage.
     */
    public function destroy($id)
    {
        // Find the post by ID
        $post = Post::findOrFail($id);

        // Delete the post
        $post->delete();

        return response()->json(['message' => 'Post deleted successfully']);
    }
}

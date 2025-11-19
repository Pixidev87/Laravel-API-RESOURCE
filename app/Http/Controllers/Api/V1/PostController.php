<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return  PostResource::collection(Post::with('author')->paginate(2));  // Eager load az author kapcsolatot, 2 elem per oldal
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {

        $data = $request->validated();
        //$data = $request->only(['title', 'body']);

        $data['author_id'] = 1;
        $post = Post::create($data); // létrehozás az engedélyezett mezőkkel

        return new PostResource($post); // válasz PostResource-ként

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): PostResource
    {
        $post = Post::findOrFail($id); // keresés ID alapján, ha nem található, 404 hibát dob

        return new PostResource($post);  // válasz PostResource-ként
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post): PostResource
    {
        $data = $request->validate([
            'title' => 'required|string|max:255|min:2',
            'body' => 'required|string|min:2',
        ]);

        $post->update($data);  // frissítés az engedélyezett mezőkkel

        return new PostResource($post);  // válasz PostResource-ként
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();  // törlés

        return response()->noContent(204); // 204 No Content válasz
    }
}

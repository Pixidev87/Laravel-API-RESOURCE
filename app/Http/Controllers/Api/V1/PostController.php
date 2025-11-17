<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return [
            [
                'id' => 1,
                'title' => 'First Post',
                'body' => 'This is the body of the first post.'
            ]
        ];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //$data = $request->all();
        $data = $request->only(['title', 'body']);

        return response()->json(
            [
                'id' => 1,
                'title' => $data['title'],
                'body' => $data['body']
            ],
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(
            [
                'id' => 1,
                'title' => 'First Post',
                'body' => 'This is the body of the first post.'
            ]
        )
            ->header('Test-Header', 'HeaderValue')
            ->setStatusCode(201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255|min:2',
            'body' => 'required|string|min:2',
        ]);

        return $data;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return response()->noContent(204);
    }
}

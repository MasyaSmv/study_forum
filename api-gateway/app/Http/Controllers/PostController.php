<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Показать список ресурса.
     */
    public function index(): JsonResponse
    {
        return response()->json(Post::all(), 200);
    }

    /**
     * Храните недавно созданный ресурс в хранении.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'thread_id' => 'required|exists:threads,id',
            'user_id' => 'required|exists:users,id',
            'body' => 'required|string',
        ]);

        $post = Post::create($validated);
        return response()->json($post, 201);
    }

    /**
     * Отобразить указанный ресурс.
     */
    public function show(Post $post): JsonResponse
    {
        return response()->json($post, 200);
    }

    /**
     * Обновите указанный ресурс в хранилище.
     */
    public function update(Request $request, Post $post): JsonResponse
    {
        $validated = $request->validate([
            'body' => 'sometimes|required|string',
        ]);

        $post->update($validated);
        return response()->json($post, 200);
    }

    /**
     * Удалите указанный ресурс с хранения.
     */
    public function destroy(Post $post): JsonResponse
    {
        $post->delete();
        return response()->json(null, 204);
    }
}

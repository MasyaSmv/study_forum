<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ThreadController extends Controller
{
    /**
     * Показать список ресурса.
     */
    public function index(): JsonResponse
    {
        return response()->json(Thread::all(), 200);
    }

    /**
     * Храните недавно созданный ресурс в хранении.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'user_id' => 'required|exists:users,id',
        ]);

        $thread = Thread::create($validated);
        return response()->json($thread, 201);
    }

    /**
     * Отобразить указанный ресурс.
     */
    public function show(Thread $thread): JsonResponse
    {
        return response()->json($thread, 200);
    }

    /**
     * Обновите указанный ресурс в хранилище.
     */
    public function update(Request $request, Thread $thread): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'body' => 'sometimes|required|string',
        ]);

        $thread->update($validated);
        return response()->json($thread, 200);
    }

    /**
     * Удалите указанный ресурс с хранения.
     */
    public function destroy(Thread $thread): JsonResponse
    {
        $thread->delete();
        return response()->json(null, 204);
    }
}

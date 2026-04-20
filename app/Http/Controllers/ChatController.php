<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\ChatService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ChatController extends Controller
{
    public function __construct(private ChatService $chatService) {}

    public function index(): View
    {
        return view('chat');
    }

    /**
     * Ask a question to the chat service.
     */
    public function ask(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'question' => 'required|string|min:4|max:255',
        ]);

        return response()->json([
            'answer' => $this->chatService->answer($validated['question']),
        ]);
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\ChatService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Controller for handling chat functionality.
 *
 * @author Albert
 *
 * @since 1.0.0
 */
class ChatController extends Controller
{
    private const MAX_HISTORY = 20;

    /**
     * Create a new chat controller instance.
     */
    public function __construct(private ChatService $chatService) {}

    /**
     * Display the chat interface.
     */
    public function index(): View
    {
        $chatHistory = session()->get('chat_history', []);

        return view('chat', compact('chatHistory'));
    }

    /**
     * Process a chat question and return an answer.
     */
    public function ask(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'question' => 'required|string|min:4|max:255',
        ]);

        $question = $validated['question'];

        $answer = $this->chatService->answer($question);

        $this->addToHistory('user', $question);
        $this->addToHistory('assistant', $answer);

        return response()->json([
            'answer' => $answer,
            'timestamp' => now()->toIso8601String(),
        ]);
    }

    /**
     * Add a message to the chat history session.
     *
     * @param  string  $role  The role (user or assistant)
     * @param  string  $content  The message content
     */
    private function addToHistory(string $role, string $content): void
    {
        $history = session()->get('chat_history', []);

        $history[] = [
            'role' => $role,
            'content' => $content,
            'timestamp' => now()->toIso8601String(),
        ];

        if (count($history) > self::MAX_HISTORY) {
            $history = array_slice($history, -self::MAX_HISTORY);
        }

        session()->put('chat_history', $history);
    }

    /**
     * Clear the chat history session.
     */
    public function clearHistory(): JsonResponse
    {
        session()->forget('chat_history');

        return response()->json([
            'success' => true,
        ]);
    }
}

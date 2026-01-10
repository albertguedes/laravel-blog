<?php declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;

use App\Services\ChatService;

class ChatController extends Controller
{
    public function __construct(private ChatService $chatService) {}

    public function index(): View
    {
        return view('chat');
    }

    /**
     * Ask a question to the chat service.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ask(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'question' => 'required|string|min:4|max:255',
        ]);

        return response()->json([
            'answer' => $this->chatService->answer($validated['question'])
        ]);
    }
}

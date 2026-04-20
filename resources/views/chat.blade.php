<x-layouts.main-layout-component title="Chat" description="Chat page of {{ config('app.name') }}" >
    <section class="row" >

        <header class="col-12">
            <x-page-title-component title="Chat" icon="chat" />
        </header>

        <article class="col-12" >
            <div class="chat-container" >
                <div class="chat-header" >
                    <h3 class="m-0" >
                        <i class="fas fa-comments me-2" ></i>Chat
                    </h3>
                    <button type="button" id="clear-chat" class="btn btn-sm btn-outline-secondary" >
                        <i class="fas fa-trash me-1" ></i>Clear
                    </button>
                </div>

                <div class="chat-messages" id="chat-messages" >
                    @forelse($chatHistory as $msg)
                    <div class="message message-{{ $msg['role'] }}" >
                        <div class="message-content" >{!! nl2br(e($msg['content'])) !!}</div>
                        <div class="message-time" >{{ \Carbon\Carbon::parse($msg['timestamp'])->format('H:i') }}</div>
                    </div>
                    @empty
                    <div class="chat-empty" >
                        <i class="fas fa-robot fs-1 mb-3" ></i>
                        <p>Welcome! Ask me anything about the blog.</p>
                        <p class="small text-muted" >Try questions like "How many posts?", "Posts by author X", or "Explain topic Y"</p>
                    </div>
                    @endforelse
                </div>

                <div class="chat-thinking" id="chat-thinking" >
                    <div class="thinking-dots" >
                        <span></span><span></span><span></span>
                    </div>
                    <span class="ms-2" >Thinking...</span>
                </div>

                <form id="chat-form" class="chat-input-area" >
                    @csrf
                    <textarea id="question" name="question" rows="1" placeholder="Type your message... (Enter to send, Shift+Enter for new line)" ></textarea>
                    <button type="submit" class="btn btn-primary" >
                        <i class="fas fa-paper-plane" ></i>
                    </button>
                </form>
            </div>
        </article>

    </section>

    <x-slot:footer_scripts>
        <script type="text/javascript" src="{{ asset('assets/js/pages/chat/ask.js') }}" ></script>
    </x-slot:footer_scripts>

</x-layouts.main-layout-component>

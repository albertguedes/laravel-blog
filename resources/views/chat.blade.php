<x-layouts.main-layout-component title="Chat" description="Chat page of {{ config('app.name') }}" >
    <section class="row" >

        <header class="col-12">
            <x-page-title-component title="Chat" icon="chat" />
        </header>

        <article class="col-12" >
            <div id="answer" ></div>
        </article>

        <section class="pt-5 col-12">
            <form id="chat-form">
                <div class="input-group" >
                    @csrf
                    <textarea id="question" name="question" rows="5" class="form-control" placeholder="Type your message here..." ></textarea>
                    <button id="send" class="input-group-button btn btn-dark" >
                        <i class="fa fa-send"></i>
                    </button>
                </div>
            </form>
        </section>

    </section>

    <x-slot:footer_scripts>
        <script type="text/javascript" src="{{ asset('assets/js/pages/chat/ask.js') }}" ></script>
    </x-slot:footer_scripts>

</x-layouts.main-layout-component>

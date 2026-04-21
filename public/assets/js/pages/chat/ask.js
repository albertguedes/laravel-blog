/**
 * Chat ask functionality - handles chat form submission and message display.
 *
 * @file
 * @author Albert
 * @since 1.0.0
 */

$(function () {
    const chatForm = $('#chat-form');
    const questionInput = $('#question');
    const chatMessages = $('#chat-messages');
    const chatThinking = $('#chat-thinking');
    const clearChatBtn = $('#clear-chat');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    chatForm.on('submit', handleSubmit);
    clearChatBtn.on('click', handleClear);

    questionInput.on('keydown', handleKeyDown);

    function handleSubmit(e) {
        e.preventDefault();

        const question = questionInput.val().trim();
        if (!question) {
            questionInput.css('border', '1px solid #F9322C');
            setTimeout(() => questionInput.css('border', ''), 1500);
            return;
        }

        addMessage('user', question);
        questionInput.val('').css('height', 'auto');

        showThinking();

        const data = {
            _token: $('meta[name="csrf-token"]').attr('content'),
            question: question
        };

        $.post('/chat', data)
            .done(function (response) {
                hideThinking();
                addMessage('assistant', response.answer);
            })
            .fail(function (xhr) {
                hideThinking();
                let errorMsg = 'Ocorreu um erro ao processar sua mensagem.';
                if (xhr.responseJSON && xhr.responseJSON.errors && xhr.responseJSON.errors.question) {
                    errorMsg = xhr.responseJSON.errors.question[0];
                }
                addMessage('assistant', errorMsg);
            });
    }

    function handleKeyDown(e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            chatForm.submit();
        }
    }

    function handleClear() {
        $.post('/chat/clear')
            .done(function () {
                chatMessages.html('');
                chatMessages.append(getEmptyState());
                questionInput.focus();
            })
            .fail(function () {
                addMessage('assistant', 'Erro ao limpar histórico. Recarregue a página.');
            });
    }

    function addMessage(role, content) {
        const time = new Date().toLocaleTimeString('pt-BR', { hour: '2-digit', minute: '2-digit' });
        const escapedContent = content.replace(/\n/g, '<br>');

        const messageHtml = `
            <div class="message message-${role}">
                <div class="message-content">${escapedContent}</div>
                <div class="message-time">${time}</div>
            </div>
        `;

        chatMessages.append(messageHtml);
        scrollToBottom();
    }

    function showThinking() {
        chatThinking.fadeIn(150);
        scrollToBottom();
    }

    function hideThinking() {
        chatThinking.fadeOut(150);
    }

    function scrollToBottom() {
        chatMessages.animate({ scrollTop: chatMessages[0].scrollHeight }, 300);
    }

    function getEmptyState() {
        return `
            <div class="chat-empty">
                <i class="fas fa-robot fs-1 mb-3"></i>
                <p>Welcome! Ask me anything about the blog.</p>
                <p class="small text-muted">Try questions like "How many posts?", "Posts by author X", or "Explain topic Y"</p>
            </div>
        `;
    }
});

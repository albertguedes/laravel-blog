$(function () {
    const chatForm = $('#chat-form');
    const questionInput = $('#question');
    const chatMessages = $('#chat-messages');
    const chatThinking = $('#chat-thinking');
    const clearChatBtn = $('#clear-chat');

    chatForm.on('submit', handleSubmit);
    clearChatBtn.on('click', handleClear);

    questionInput.on('keydown', handleKeyDown);

    function handleSubmit(e) {
        e.preventDefault();

        const question = questionInput.val().trim();
        if (!question) {
            return;
        }

        addMessage('user', question);
        questionInput.val('').css('height', 'auto');

        showThinking();

        $.post('/chat', chatForm.serialize())
            .done(function (response) {
                hideThinking();
                addMessage('assistant', response.answer);
            })
            .fail(function () {
                hideThinking();
                addMessage('assistant', 'Desculpe, occurred an error processing your request. Please try again.');
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

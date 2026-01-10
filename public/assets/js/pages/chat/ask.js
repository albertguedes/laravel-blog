$(function () {
    $('#chat-form').on('submit', ask);
});

function ask(e) {
    e.preventDefault();
  const form = $('#chat-form');
    const data = form.serialize();

    console.log(data);
    // inclui _token automaticamente

    $('#answer').text('Processando...');

    $.post('/chat', data)
        .done(function (response) {
            $('#answer').text(response.answer);
        })
        .fail(function () {
            $('#answer').text('Error processing your request. Please try again.');
        });
}

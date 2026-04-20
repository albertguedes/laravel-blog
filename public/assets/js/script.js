$(function() {
    //footerAtBottom('#footer');
});

function footerAtBottom(footerSelector) {

    console.log('footerAtBottom');

    isString(footerSelector);

    let page = $(window);
    let body = $(document);
    let footer = $(footerSelector);

    var windowHeight = page.height();
    var bodyHeight = body.height();
    var footerHeight = footer.height();

    if (windowHeight > bodyHeight + footerHeight) {
        footer.css('position', 'fixed').css('bottom', 0);
    }
}


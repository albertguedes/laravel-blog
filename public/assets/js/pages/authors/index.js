function verticalCenterSafe(selector) {
    $(selector).each(function () {
        if ($(this).css('display') !== 'flex') {
            $(this).css('display', 'flex');
        }

        $(this).css({
            'flex-direction': 'column',
            'justify-content': 'center'
        });
    });
}

$(function(){
    setUniformHeight('author-name');
    setUniformHeight('author-about');
    verticalCenterSafe('.author-name');
});


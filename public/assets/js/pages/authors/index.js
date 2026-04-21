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

/**
 * Authors page JavaScript functionality.
 *
 * @file
 * @author Albert
 * @since 1.0.0
 */

$(function(){
    setUniformHeight('author-name');
    setUniformHeight('author-about');
    verticalCenterSafe('.author-name');
});


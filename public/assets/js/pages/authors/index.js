/**
 * Vertically centers content within elements.
 * Sets element to flex display with column direction and center justification.
 *
 * @param {string} selector - jQuery selector for elements to center
 * @returns {void}
 *
 * @requires jQuery
 */
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
 *
 * @description
 * Handles authors page UI adjustments including uniform height
 * and vertical centering for author cards.
 *
 * @requires jQuery
 * @requires setUniformHeight() from dom.js
 * @requires isString() from validation.js
 */

$(function(){
    setUniformHeight('author-name');
    setUniformHeight('author-about');
    verticalCenterSafe('.author-name');
});


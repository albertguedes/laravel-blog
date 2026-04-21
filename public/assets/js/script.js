/**
 * Main JavaScript file for general page functionality.
 *
 * @file
 * @author Albert
 * @since 1.0.0
 *
 * @description
 * Contains general-purpose JavaScript functions for the blog.
 * Currently includes footer positioning utility.
 */

$(function() {
    //footerAtBottom('#footer');
});

/**
 * Positions the footer at the bottom of the viewport if page content
 * is shorter than the viewport height.
 *
 * @param {string} footerSelector - jQuery selector for the footer element
 * @returns {void}
 *
 * @example
 * // Position footer at bottom of page
 * footerAtBottom('#footer');
 *
 * @requires jQuery
 * @requires isString() validation function
 *
 * @since 1.0.0
 */

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
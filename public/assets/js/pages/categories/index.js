/**
 * Categories page JavaScript functionality.
 *
 * @file
 * @author Albert
 * @since 1.0.0
 *
 * @description
 * Handles categories page UI interactions including
 * category tree toggle functionality.
 *
 * @requires jQuery
 */

/**
 * Toggles category tree expand/collapse icons.
 * Alternates between folder-plus and folder-open icons
 * when collapse links are clicked.
 *
 * @returns {void}
 *
 * @example
 * // Automatically bound to .collapse-link click events
 * categoryTreeToogle();
 */
function categoryTreeToogle() {
    $('.collapse-link').click(function() {
        let icon = $(this).find('.collapse-icon');

        if (icon.find('i.fa-folder-plus').length > 0) {
            icon.find('i').removeClass('fa-folder-plus').addClass('fa-folder-open');
        }
        else {
            icon.find('i').removeClass('fa-folder-open').addClass('fa-folder-plus');
        }
    });
}

$(function(){
    categoryTreeToogle();
});

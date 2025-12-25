$(function(){
    categoryTreeToogle();
});

function categoryTreeToogle() {

    /*
    * Alternate '+' and '-' symbols on item on categories list page.
    */
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

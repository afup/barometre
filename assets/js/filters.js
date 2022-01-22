$(document).ready(function () {
    $('.filter-toggler', '.form-group').click(function (e) {
        var parentGroup = $(this).parents('.form-group');
        $('.form-row-content', parentGroup).toggle();
        $('.glyphicon', parentGroup)
            .toggleClass('glyphicon-chevron-down')
            .toggleClass('glyphicon-chevron-up')
        ;
        e.preventDefault();
    });
});

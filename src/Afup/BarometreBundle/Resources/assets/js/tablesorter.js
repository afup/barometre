$(document).ready(function () {
    $.extend($.tablesorter.themes.bootstrap, {
        // these classes are added to the table. To see other table classes available,
        // look here: http://twitter.github.com/bootstrap/base-css.html#tables
        table      : '',
        caption    : 'caption',
        header     : 'bootstrap-header', // give the header a gradient background
        footerRow  : '',
        footerCells: '',
        icons      : '', // add "icon-white" to make them white; this icon class is added to the <i> in the header
        sortNone   : 'icon-unsorted glyphicon glyphicon-chevron-up',
        sortAsc    : 'icon-sorted glyphicon glyphicon-chevron-up ',     // includes classes for Bootstrap v2 & v3
        sortDesc   : 'icon-sorted glyphicon glyphicon-chevron-down ', // includes classes for Bootstrap v2 & v3
        active     : '', // applied when column is sorted
        hover      : '', // use custom css here - bootstrap class may not override it
        filterRow  : '', // filter row class
        even       : '', // odd row zebra striping
        odd        : ''  // even row zebra striping
    });


    $('table.tablesorter').tablesorter({
        theme : "bootstrap",
        headerTemplate : '{icon} {content}',
        widgets : [ "uitheme"]
    });
});

$(document).ready(function () {
    $.extend($.tablesorter.themes.bootstrap, {
        // these classes are added to the table. To see other table classes available,
        // look here: http://twitter.github.com/bootstrap/base-css.html#tables
        table      : '',
        caption    : 'caption',
        header     : 'bootstrap-header', // give the header a gradient background
        footerRow  : '',
        footerCells: '',
        icons        : 'fa', // base icon class added to the <i> in the header
        iconSortNone : 'fa-chevron-up fa-unsorted',
        iconSortAsc  : 'fa-chevron-up',     // includes classes for Bootstrap v2 & v3
        iconSortDesc : 'fa-chevron-down', // includes classes for Bootstrap v2 & v3
        active     : '', // applied when column is sorted
        hover      : '', // use custom css here - bootstrap class may not override it
        filterRow  : '', // filter row class
        even       : '', // odd row zebra striping
        odd        : ''  // even row zebra striping
    });


    $('table.tablesorter').tablesorter({
        theme : "bootstrap",
        headerTemplate : '{content} {icon}',
        widgets : [ "uitheme"]
    });
});

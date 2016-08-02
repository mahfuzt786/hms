$(document).ready(function(){
    $('.nav-tabs a').click(function(){
        $(this).tab('show');
    })
    $("#daily-date").datepicker({
        dateFormat:'yy-mm-dd',
        changeMonth: true,
        changeYear: true
    });
    $("#start-date").datepicker({
        dateFormat:'yy-mm-dd',
        changeMonth: true,
        changeYear: true
    });
    $("#end-date").datepicker({
        dateFormat:'yy-mm-dd',
        changeMonth: true,
        changeYear: true
    });
    $('.pdf-viewer').css('max-height',$(window).height());
});
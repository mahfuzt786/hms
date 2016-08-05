$(document).ready(function(){
    $('.nav-tabs a').click(function(){
        $(this).tab('show');
    });
    $("#start-date").datepicker({
        dateFormat:'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        maxDate: 0
    });
    $("#end-date").datepicker({
        dateFormat:'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        maxDate: 0
    });
    // By Default Disable radio button
    $(".relation").attr('disabled', true);
    $(".gender").attr('disabled', true);
    $(".wrap").css('opacity', '.2'); // This line is used to lightly hide label for disable radio buttons.
    // Disable radio buttons function on Check Disable radio button.
    $("form input:radio").change(function() {
        if ($(this).val() == "self") {
            $(".relation").attr('checked', false);
            $(".gender").attr('checked', false);
            $(".relation").attr('disabled', true);
            $(".relation").attr('disabled', true);
            $(".wrap").css('opacity', '.2');
        }
        // Else Enable radio buttons.
        else {
            $(".relation").attr('disabled', false);
            $(".gender").attr('disabled', false);
            $(".wrap").css('opacity', '1');
        }
    });
});
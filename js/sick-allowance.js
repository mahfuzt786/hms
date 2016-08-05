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
    $('#emp-record').hide();
    $('#found').hide();
    $('#notfound').hide();
    $('#empid').keyup(function () {
        if($('#empid').val())
        {
            $.ajax({
                url: "service/sick-allow.php",
                type: "POST",
                data: {
                    action: 'checkEmp',
                    eid: $('input#empid').val()
                },
                //dataType: "json",
                success: function(result){
                    var arr = JSON.parse(result);
                    $('#found').hide();
                    $('#notfound').hide(); 
                    $('#emp-record').hide();
                    if(result!=0) {
                        //alert(result);
                        $('#notfound').hide();
                        $('#found').show();
                        $('#emp-record').show();
                        $('#id').text(arr[0]);
                        $('#name').text(arr[1]);
                        $('#pfid').text(arr[2]);
                        $('#div').text(arr[3]);
                        $('#book').text(arr[4]);
                        $('#desig').text(arr[5]);
                        $('#gen').text(arr[6]);
                        
                    }
                    else {
                        
                        $('#found').hide();
                        $('#notfound').show();
                        $('#emp-record').hide();
                    }
                }
            });
        }
    });
/*$('#empid').blur(function () {
        if($('#empid').val())
        {
            $.ajax({
                url: "service/sick-allow.php",
                type: "POST",
                data: {
                    action: 'checkEmp',
                    eid: $('input#empid').val()
                },
                //dataType: "json",
                success: function(result){
                    $('#found').hide();
                    $('#notfound').hide(); 
                    $('#emp-record').hide();
                    if(result!=0) {
                        $('#notfound').hide();
                        $('#found').show();
                        $('#emp-record').show();
                    }
                    else {
                        $('#found').hide();
                        $('#notfound').show();
                        $('#emp-record').hide();
                        alert("Employee ID not found in Employee Record !!");
                        $('#empid').focus();
                        $('#empid').val('');
                    }
                }
            });
        }
    });*/
});
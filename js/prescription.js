$(document).ready(function(){
    $('#show-detail').hide();
    $('#found').hide();
    $('#notfound').hide();
    $('label#employee-name').hide();
    $('#emp-id').focus();
    $(".nav-tabs a").click(function(){
        $(this).tab('show');
    });
    
   $.ajax({
        url: "includes/login-check.php",
        type: "POST",
        data: {
            action: 'medicine_listbox_main'
        },
        success: function(result){
            content='';
            var arr = $.parseJSON(result);
            $.each(arr, function(k, v) {
                content+='<option value="' + k +'" selected>' + v + '</option>';
            });
            $('#medicine-list').html(content);
        }
    });
    $('#searchMed').keyup(function(){
        $('#searchMed').html('');
        //alert('searching');
        $.ajax({
            url: "includes/login-check.php",
            type: "POST",
            data: {
                action: 'medicine_listbox',
                name: $('#searchMed').val()
            },
            success: function(result){
                content='';
                var arr = $.parseJSON(result);
                $.each(arr, function(k, v) {
                    content+='<option value="' + k +'" selected>' + v + '</option>';
                });
                $('#medicine-list').html(content);
            }
        });
    });
    $('#emp-id').keyup(function () {
        if($('#emp-id').val())
        {
            $.ajax({
                url: "includes/login-check.php",
                type: "POST",
                data: {
                    action: 'checkEmp',
                    eid: $('input#emp-id').val()
                },
                //dataType: "json",
                success: function(result){
                    $NAME=result;
                    if(result!=0) {
                        $('#show-detail').show();
                        $('#found').show();
                        $('#notfound').hide();
                        $('label#employee-name').text($NAME);
                        $('label#employee-name').show();
                    }
                    else {
                        $('label#employee-name').hide();
                        $('#show-detail').show();
                        $('#found').hide();
                        $('#notfound').show();
                    }
                }
            });
        }
    });
});
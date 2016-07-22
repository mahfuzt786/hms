$(document).ready(function(){
    document.getElementById("date").disabled=true;
    $('#show-detail').hide();
    $('#found').hide();
    $('#notfound').hide();
    $('label#employee-name').hide();
    $('#emp-id').focus();
    $(".nav-tabs a").click(function(){
        $(this).tab('show');
    });
    document.getElementById("emp-name").disabled=true;
    document.getElementById("emp-id").disabled=true; 

    $('input[name="patientType"]').change(function(){
        var type=$(this).val();
        if(type == '1'){
            //alert('inpatient');
            document.getElementById("emp-name").disabled=true;
            
            document.getElementById("emp-id").disabled=false;
            $('#emp-id').val('');
            
            $('#emp-id').focus();
            $('#show-detail').hide();
            $('#found').hide();
            $('#notfound').hide();
            
        }else if(type=='2'){
            document.getElementById("emp-id").disabled=true;
            $('#emp-id').val('0000');
            $('#emp-name').val('');
            
            document.getElementById("emp-name").disabled=false;
            $('#emp-name').focus();
            $('#show-detail').hide();
            $('#found').hide();
            $('#notfound').hide();
        }
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
                        $('#emp-name').val($NAME);
                    }
                    else {
                        $('#show-detail').show();
                        $('#found').hide();
                        $('#notfound').show();
                        $('#emp-name').val('');
                    }
                }
            });
        }
    });
});
$(document).ready(function(){
    $('.nav-tabs a').click(function(){
        $(this).tab('show');
    });
    $('#empid').focus();
    $('#edit-rate').hide();
    $('#rate').hide();
    $('#edit-icon').click(function(){
        $('#rate-text').hide();
        $('#edit-rate').show();
        $('#rate').show();
        $('#edit-icon').hide();
    });
    $('#remove-textbox').click(function(){
        $('#rate-text').show();
        $('#edit-rate').hide();
        $('#rate').hide();
        $('#edit-icon').show();
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
    $('#rate-textbox').keyup(function () {
        if (!this.value.match(/^([0-9]{0,10})$/)) {
            this.value = this.value.replace(/[^0-9]/g, '').substring(0,10);
        }
    });
    $('#btn-edit-rate').on('click',function(e) {
        e.preventDefault();
        if($('#rate-textbox').val()=="" || $('#rate-textbox').val()==null || $('#rate-textbox').val()< 1){
            Lobibox.alert("error",
            {
                msg: 'Please Enter Rate!'
            });
        }else{
            $.ajax({
                url: "service/sick-allow.php",
                type: "POST",
                data: {
                    action: 'addRate',
                    rid: $('#rid').val(),
                    rate:$('#rate-textbox').val()
                },
                //dataType: "json",
                success: function(result){
                    if(result=='done') {
                        Lobibox.alert("success",
                        {
                            msg: 'Allowance Rate Successfully Updated ',
                            callback: function ($this, type, ev) {
                                if(type=='ok'){
                                    location.replace('sick-allowance.php');
                                }
                            }
                        });
                    }
                    else {
                        Lobibox.alert("error",
                        {
                            msg: result
                        });
                    }
                }
            });
        }
    });
    $('#empid').blur(function () {
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
    });
    $('#btn-grant-leave').on('click',function(e) {
        e.preventDefault();
        if($('#empid').val()=="" || $('#empid').val()==null){
            Lobibox.alert("error",
            {
                msg: 'Please Enter Employee ID!'
            });
        }else if($("input:radio[name='type-patient']:checked").length == 0){
            Lobibox.alert("error",
            {
                msg: 'Please select a Patient Type!'
            });
        }else if($("input:radio[name='type-patient']:checked").val()=='dependent'){
            if($("input:radio[name='relation']:checked").length == 0){
                Lobibox.alert("error",
                {
                    msg: 'Please select relation!'
                });
            }else if($("input:radio[name='gender']:checked").length == 0){
                Lobibox.alert("error",
                {
                    msg: 'Please select gender!'
                });
            }
        }else if($('#start-date').val()=="" || $('#start-date').val()==null){
            Lobibox.alert("error",
            {
                msg: 'Please Enter Start Date!'
            });
        }else if($('#end-date').val()=="" || $('#end-date').val()==null){
            Lobibox.alert("error",
            {
                msg: 'Please Enter End Date!'
            });
        }else{
            alert('coming soon');
        }
    });
});
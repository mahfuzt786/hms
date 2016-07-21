$(document).ready(function(){
    $('.check_input').hide();
    $('#old_pass').focus();
    $('#btn-change-password').on('click',function(e) {
        e.preventDefault();
        check();    
    });
    if($('#old_pass').val()){
        var value = $('#old_pass').val();
        $.ajax({
            url: "includes/login-check.php",
            type: "POST",
            data: {
                action: 'oldPassCheck',
                id: $('input#id').val()
            },
            //dataType: "json",
            success: function(result){
                if(value==result){
                    $('span#oldP_remove').hide();
                    $('span#oldP_ok').show();
                }else{
                    $('span#oldP_ok').hide();
                    $('span#oldP_remove').show();
                }
            }
        });
    }
    $('#old_pass').keyup(
        function() {
            $('span#oldP_ok').hide();
            $('span#oldP_remove').hide();
            var value = document.getElementById('old_pass').value;
            
            $.ajax({
                url: "includes/login-check.php",
                type: "POST",
                data: {
                    action: 'oldPassCheck',
                    id: $('input#id').val()
                },
                //dataType: "json",
                success: function(result){
                    if(value==result){
                        $('span#oldP_remove').hide();
                        $('span#oldP_ok').show();
                    }else{
                        $('span#oldP_ok').hide();
                        $('span#oldP_remove').show();
                    }
                }
            });
        });
    $('#new_pass').keyup(
        function() {
            var newpass = document.getElementById('new_pass').value;
            var newpassc = document.getElementById('new_pass_c').value;
            if(newpass.length < 4){
                $('span#newP_ok').hide();
                $('span#newP_remove').show();
            }else{
                $('span#newP_remove').hide();
                $('span#newP_ok').show();
            }
            if(newpassc!="" && newpass!=newpassc){
                $('span#newP_ok').hide();
                $('span#newP_remove').show();
            }
        });
    $('#new_pass_c').keyup(
        function() {
            var newpassc = document.getElementById('new_pass_c').value;
            var newpass = document.getElementById('new_pass').value;
            if(newpass==newpassc){
                $('span#newPc_remove').hide();
                $('span#newPc_ok').show();
            }else{
                $('span#newPc_ok').hide();
                $('span#newPc_remove').show();
            }
        });
    function check(){
        $new_p = $('#new_pass').val();
        $new_p_c = $('#new_pass_c').val();
        if($('#old_pass').val()==""){
            Lobibox.alert("error",
            {
                msg: 'Please enter Password !'
            });
        }else if($('#new_pass').val()==""){
            Lobibox.alert("error",
            {
                msg: 'Please enter New Password !!'
            });
        }else if($new_p.length < 4){
            Lobibox.alert("error",
            {
                msg: 'Password must not be less than 3 character !'
            });
        }else if($('#new_pass_c').val()==""){
            Lobibox.alert("error",
            {
                msg: 'Please Re-Type New Password !!!'
            });
        }else if($new_p != $new_p_c){
            Lobibox.alert("error",
            {
                msg: 'New Password Mismatch !!!'
            });
        }else{
            Lobibox.confirm({
                msg: "Click Yes to confirm change?",
                callback: function ($this, type, ev) {
                    if (type == 'yes') {
                        change_password();
                    }
                }
            });
        }
    }
    function change_password()
    {
        if($('#old_pass').val() && $('#new_pass').val() && $('#new_pass_c').val())
        {
            $.ajax({
                url: "includes/login-check.php",
                type: "POST",
                data: {
                    action: 'changePassword',
                    id: $('input#id').val(),
                    username: $('input#username').val(),
                    oldPass: $('input#old_pass').val(),
                    newPass: $('input#new_pass').val()
                },
                //dataType: "json",
                success: function(result){
                    if(result=='done') {
                        Lobibox.alert("success",
                        {
                            msg: 'Password successfully updated !!',
                            callback: function ($this, type, ev) {
                                location.replace('includes/logout.php');
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
    }    
});
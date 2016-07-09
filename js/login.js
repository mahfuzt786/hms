$(document).ready(function(){
    $('#username').focus();
    $('#username').on('keypress',function(e) {
        if(e.keyCode == 13) {
            if($('#password').val())
            {
                login();
            }
            else {
                $('#password').focus();
                Lobibox.alert("error",
                {
                    msg: 'Please enter your Password'
                });
				
                if($('.lobibox'))
                {
                    $('.lobibox .lobibox-btn').focus();
                }
            }
        }
    });
    
    $('#password').on('keypress',function(e) {
        if(e.keyCode == 13) {
            if($('#username').val())
            {
                login();
            }
            else {
                $('#username').focus();
                Lobibox.alert("error",
                {
                    msg: 'Please enter your Username'
                });
				
                if($('.lobibox'))
                {
                    $('.lobibox .lobibox-btn').focus();
                }
            }
        }
    });
    
    $('#btn-login').on('click',function(e) {
        e.preventDefault();
        login();    
    });
    
    function login()
    {
        if($('#username').val() && $('#password').val())
        {
            $.ajax({
                url: "includes/login-check.php",
                type: "POST",
                data: {
                    action: 'confirmLogin',
                    email: $('input#username').val(),
                    password: $('input#password').val()
                },
                //dataType: "json",
                success: function(result){
                    if(result=='done') {
                        location.replace('home.php');
                    }
                    else {
                        Lobibox.alert("warning",
                        {
                            msg: result
                        });
                        
                        if($('.lobibox'))
                        {
                            $('.lobibox .lobibox-btn').focus();
                        }
                    
                    }
                },
                error: function (a,b,c) {
                    Lobibox.alert("error",
                    {
                        msg: 'error in logging in'
                    });
                        
                    if($('.lobibox'))
                    {
                        $('.lobibox .lobibox-btn').focus();
                    }
                    
                }
            });
        }
        else {
            Lobibox.alert("error",
            {
                msg: 'Invalid username or password..'
            });
            if($('.lobibox'))
            {
                $('.lobibox .lobibox-btn').focus();
            }
        }
    }    
});
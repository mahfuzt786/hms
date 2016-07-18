$(document).ready(function(){
    $('#drugs-category').focus();
    $('#btn-add-category-values').on('click',function(e) {
        e.preventDefault();
        check();    
    });
    $('#btn-edit-category-values').on('click',function(e) {
        e.preventDefault();
        check_edit();    
    });
    function check_edit(){
        if($('#edit-drugs-category').val()==""){
            Lobibox.alert("error",
            {
                msg: 'Please enter Category Name!'
            });
        }else if($('textarea#edit-drugs-category-description').val()==""){
            Lobibox.alert("error",
            {
                msg: 'Please provide Category Description !!'
            });
        }
        edit_category();
    }
    function check(){
        if($('#drugs-category').val()==""){
            Lobibox.alert("error",
            {
                msg: 'Please enter Category Name!'
            });
        }else if($('textarea#drugs-category-description').val()==""){
            Lobibox.alert("error",
            {
                msg: 'Please provide Category Description !!'
            });
        }
        add_category();
    }
    function edit_category()
    {
        if($('#edit-drugs-category').val() && $('#edit-drugs-category-description').val())
        {
            $.ajax({
                url: "includes/login-check.php",
                type: "POST",
                data: {
                    action: 'editCategory',
                    eid: $('input#catid').val(),
                    ecat: $('input#edit-drugs-category').val(),
                    ecat_desc: $('textarea#edit-drugs-category-description').val()
                },
                //dataType: "json",
                success: function(result){
                    if(result=='done') {
                        Lobibox.alert("success",
                        {
                            msg: 'Drugs Category Successfully Updated ',
                            callback: function ($this, type, ev) {
                                if(type=='ok'){
                                    location.replace('drugs.php');
                                }
                            }
                        });
                        
                        if($('.lobibox'))
                        {
                            $('.lobibox .lobibox-btn').focus();
                        }
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
    function add_category()
    {
        if($('#drugs-category').val() && $('#drugs-category-description').val())
        {
            $.ajax({
                url: "includes/login-check.php",
                type: "POST",
                data: {
                    action: 'addCategory',
                    cat: $('input#drugs-category').val(),
                    cat_desc: $('textarea#drugs-category-description').val()
                },
                //dataType: "json",
                success: function(result){
                    if(result=='done') {
                        Lobibox.alert("success",
                        {
                            msg: 'Drugs Category Successfully Added ',
                            callback: function ($this, type, ev) {
                                if(type=='ok'){
                                    location.replace('drugs.php');
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
    }    
});
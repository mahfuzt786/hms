$(document).ready(function(){
    $('#emp-id').focus();
    
    $('#emp-age,#emp-salary').keyup(function () {
        if (!this.value.match(/^([0-9]{0,10})$/)) {
            this.value = this.value.replace(/[^0-9]/g, '').substring(0,10);
        }
    });
    $('#emp-id').keyup(function () {
        $.ajax({
            url: "includes/login-check.php",
            type: "POST",
            data: {
                action: 'checkEmployeeId',
                empid: $('#emp-id').val()
            },
            //dataType: "json",
            success: function(result){
                if(result=='duplicate') {
                       
                    Lobibox.alert("error",
                    {
                        msg: 'Employee ID already taken'
                    });
                    $('#emp-id').val('');
                }
            }
        });
    });
    $('#btn-add-employee-values').on('click',function(e) {
        e.preventDefault();
        check();    
    });
    function check(){
        if($('#des-id').val()=="select"){
            Lobibox.alert("error",
            {
                msg: 'Please select a designation!'
            });
        }else if($('#emp-id').val()==""){
            Lobibox.alert("error",
            {
                msg: 'Please enter employee ID!'
            });
        }else if($('#emp-name').val()==""){
            Lobibox.alert("error",
            {
                msg: 'Please enter employee name!'
            });
        }else if($('#emp-name').val()==""){
            Lobibox.alert("error",
            {
                msg: 'Please enter employee name!'
            });
        }else if($("input:radio[name='emp-gender']:checked").length == 0){
            Lobibox.alert("error",
            {
                msg: 'Please select gender!'
            });
        }else if($('#emp-age').val() < 15){
            Lobibox.alert("error",
            {
                msg: 'Please enter valid age!'
            });
        }else if($('#emp-salary').val()==""){
            Lobibox.alert("error",
            {
                msg: 'Please enter salary!'
            });
        }else if($('#emp-salary').val() < 50){
            Lobibox.alert("error",
            {
                msg: 'Please enter valid salary!'
            });
        }else if($('textarea#emp-address').val()==""){
            Lobibox.alert("error",
            {
                msg: 'Please enter employee address !!'
            });
        }else{
            add_employee();
        }
    }
    function add_employee()
    {
        if($('#emp-id').val() && $('#des-id').val() && $('#emp-name').val() && $('#emp-salary').val()&& $('#emp-age').val() && $("input:radio[name='emp-gender']:checked").length != 0 && $('#emp-address').val())
        {
            $.ajax({
                url: "includes/login-check.php",
                type: "POST",
                data: {
                    action: 'addEmployee',
                    empid: $('#emp-id').val(),
                    desid: $('#des-id').val(),
                    name: $('#emp-name').val(),
                    salary: $('#emp-salary').val(),
                    age: $('#emp-age').val(),
                    gender: $("input:radio[name='emp-gender']:checked").val(),
                    address: $('#emp-address').val()
                },
                //dataType: "json",
                success: function(result){
                    if(result=='done') {
                        Lobibox.alert("success",
                        {
                            msg: 'Employee Successfully Added ',
                            callback: function ($this, type, ev) {
                                if(type=='ok'){
                                    location.replace('employee-add.php');
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
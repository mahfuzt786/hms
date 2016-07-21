$(document).ready(function(){
    $("#drugs-manu-date").datepicker({
        dateFormat: 'dd/mm/yy',
        maxDate: 0
    });
    $("#drugs-exp-date").datepicker({
        dateFormat: 'dd/mm/yy',
        minDate: 0
    });
    
    $(".nav-tabs a").click(function(){
        $(this).tab('show');
    });
    $('#manage-drugs').on('shown.bs.modal', function () { 
        $('input#drugs-name').focus(); 
    });
    $('#btn-add-drugs-values').on('click',function(e) {
        e.preventDefault();
        check();    
    });
    
    $('#drugs-quantity').keyup(function () {
        if (!this.value.match(/^([0-9]{0,10})$/)) {
            this.value = this.value.replace(/[^0-9]/g, '').substring(0,10);
        }
    });
    function check(){
        if($('#drugs-category').val()=="select"){
            Lobibox.alert("error",
            {
                msg: 'Please select Category Name!'
            });
        }else if($('#drugs-name').val()==""){
            Lobibox.alert("error",
            {
                msg: 'Please enter drug name !!'
            });
        }else if($('textarea#drugs-description').val()==""){
            Lobibox.alert("error",
            {
                msg: 'Please enter drug description !!'
            });
        }else if($('#drugs-price').val()==""){
            Lobibox.alert("error",
            {
                msg: 'Please enter price !!'
            });
        }/*else if ($('#drugs-price').val() != "") {
            var reg = /^[0-9]+(\.[0-9]{1,2})?$/;
            var price = $('#drugs-price').val();
            if(reg.test(price) == false) {
                Lobibox.alert("error",
                {
                    msg: 'Invalid Price !!'
                });
            }
        }*/else if($('#drugs-company').val()==""){
            Lobibox.alert("error",
            {
                msg: 'Please enter Company Name !!'
            });
        }else if($('#drugs-manu-date').val()==""){
            Lobibox.alert("error",
            {
                msg: 'Please enter manufacturing date !!'
            });
        }else if($('#drugs-exp-date').val()==""){
            Lobibox.alert("error",
            {
                msg: 'Please enter expiry date !!'
            });
        }
        else if($('#drugs-quantity').val()==""){
            Lobibox.alert("error",
            {
                msg: 'Please enter expiry date !!'
            });
        }else{
            add_drug();
        }
    }
    function add_drug()
    {
        if($('#drugs-category').val() && $('#drugs-name').val() && $('#drugs-description').val() && $('#drugs-price').val() && $('#drugs-company').val() && $('#drugs-manu-date').val() && $('#drugs-exp-date').val() && $('#drugs-quantity').val())
        {
            $.ajax({
                url: "includes/login-check.php",
                type: "POST",
                data: {
                    action: 'addDrug',
                    cat: $('#drugs-category').val(),
                    name: $('input#drugs-name').val(),
                    desc: $('textarea#drugs-description').val(),
                    price: $('input#drugs-price').val(),
                    company: $('input#drugs-company').val(),
                    man_d: $('input#drugs-manu-date').val(),
                    exp_d: $('input#drugs-exp-date').val(),
                    quantity: $('input#drugs-quantity').val()
                },
                //dataType: "json",
                success: function(result){
                    if(result=='done') {
                        Lobibox.alert("success",
                        {
                            msg: 'Drugs Successfully Added ',
                            callback: function ($this, type, ev) {
                                if(type=='ok'){
                                    location.replace('manage-drugs.php');
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
$(document).ready(function(){
    document.getElementById("daily-empid").disabled=true;
    var flag_daily=0;
    $('#d-empid').change(function(){
        if($('#d-empid').prop('checked')){
            document.getElementById("daily-empid").disabled=false; 
            $('#daily-empid').focus();
            flag_daily=1;
        }else{
            document.getElementById("daily-empid").disabled=true;
            $('#daily-date').focus();
            $('#daily-empid').val('');
            flag_daily=0;
        }
    });
    $('.nav-tabs a').click(function(){
        $(this).tab('show');
        $('#frame').prop('src', '');
    })
    $("#daily-date").datepicker({
        dateFormat:'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        showOtherMonths: true,
        selectOtherMonths: true,
        maxDate: 0
    });
    /*$("#weekly-date").datepicker({
        dateFormat:'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        maxDate: 0
    });*/
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
    $('#btn-daily-sa').on('click',function(e) {
        e.preventDefault();
        dailysa(); 
    //alert ('daily');
    });
    
    $('#btn-monthly-sl').on('click',function(e) {
        e.preventDefault();
        monthlysl();    
    });
    $('#btn-yearly-sl').on('click',function(e) {
        e.preventDefault();
        yearlysl();    
    });
    $('#btn-between-sl').on('click',function(e) {
        e.preventDefault();
        betweensl();    
    });
    function dailysa(){
        if($('#daily-date').val()==""){
            Lobibox.alert("error",
            {
                msg: 'Please enter Date!'
            });
        }else{
            var dat=$('input#daily-date').val();
            $.ajax({
                url: "service/check-sl-report.php",
                type: "POST",
                data: {
                    action: 'check_daily',
                    dt: dat
                },
                //dataType: "json",
                success: function(result){
                    //alert (result);
                    $('#frame').prop('src', result);
                }
            });
        }
    }
    function monthlysl(){
        if($('#monthly-month').val()=="select"){
            Lobibox.alert("error",
            {
                msg: 'Please Select a Month!'
            });
        }else if($('#monthly-year').val()=="select"){
            Lobibox.alert("error",
            {
                msg: 'Please Select a Year!'
            });
        }else{
            var month=$('#monthly-month').val();
            var year=$('#monthly-year').val();
            $.ajax({
                url: "service/check-sl-report.php",
                type: "POST",
                data: {
                    action: 'check_monthly_sl',
                    month: month,
                    year: year
                },
                //dataType: "json",
                success: function(result){
                    $('#frame').prop('src', result);
                }
            });
        }
    }
    function yearlysl(){
        if($('#d-empid').prop('checked') && $('#daily-empid').val()==""){
            Lobibox.alert("error",
            {
                msg: 'Please enter Employee ID!'
            }); 
        }else if($('#yearly-year').val()=="select"){
            Lobibox.alert("error",
            {
                msg: 'Please Select a Year!'
            });
        }else{
            var year=$('#yearly-year').val();
            var data;
            if(flag_daily==1){
                var empid=$('#daily-empid').val();
                data={
                    action: 'check_yearly_emp',
                    year: year,
                    empid: empid
                };
            }else{
                data={
                    action: 'check_yearly_sl',
                    year: year
                };
            }
            $.ajax({
                url: "service/check-sl-report.php",
                type: "POST",
                data: data,
                //dataType: "json",
                success: function(result){
                     $('#frame').prop('src', result);
                }
            });
        }
    }
    function betweensl(){
        if($('#start-date').val()==""){
            Lobibox.alert("error",
            {
                msg: 'Please Select 1st Date!'
            });
        }else if($('#end-date').val()==""){
            Lobibox.alert("error",
            {
                msg: 'Please Select 2nd Date!'
            });
        }else if($('#start-date').val()==$('#end-date').val()){
            Lobibox.alert("error",
            {
                msg: 'Dates must not be same. Please Select different date!'
            });
        }else{
            var start=$('#start-date').val();
            var end=$('#end-date').val();
            $.ajax({
                url: "service/check-sl-report.php",
                type: "POST",
                data: {
                    action: 'check_between_sl',
                    start: start,
                    end: end
                },
                //dataType: "json",
                success: function(result){
                    $('#frame').prop('src', result);
                }
            });
        }
    }
});
$(document).ready(function(){
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
    $('#btn-daily-drug').on('click',function(e) {
        e.preventDefault();
        dailydrug();    
    });
    $('#btn-weekly-drug').on('click',function(e) {
        e.preventDefault();
        weeklydrug();    
    });
    
    $('#btn-monthly-drug').on('click',function(e) {
        e.preventDefault();
        monthlydrug();    
    });
    $('#btn-yearly-drug').on('click',function(e) {
        e.preventDefault();
        yearlydrug();    
    });
    $('#btn-between-drug').on('click',function(e) {
        e.preventDefault();
        betweendrug();    
    });
    function dailydrug(){
        if($('#daily-date').val()==""){
            Lobibox.alert("error",
            {
                msg: 'Please enter Date!'
            });
        }else{
            var dat=$('input#daily-date').val();
            $.ajax({
                url: "service/check-drug-report.php",
                type: "POST",
                data: {
                    action: 'check_daily',
                    dt: dat
                },
                //dataType: "json",
                success: function(result){
                    if(result=='done'){
                        $('#frame').prop('src', 'lib/tcpdf/reports/daily-drug-report.php?dat='+dat+'');
                               
                    }else{
                        $('#frame').prop('src', 'lib/tcpdf/reports/no-data.php');
                    }
                }
            });
        }
    }
    function weeklydrug(){
        if($('#weekly-date').val() === "")
        {
            Lobibox.alert("error",
            {
                msg: 'Please enter Date!'
            });
        }
        else if($('#startDate').text() === "")
        {
            Lobibox.alert("error",
            {
                msg: 'Week\'s 1st Date is not selected. Please re-select a date!'
            });
        }
        else if($('#endDate').text() === "")
        {
            Lobibox.alert("error",
            {
                msg: 'Week\'s 2nd Date is not selected. Please re-select a date!'
            });
        }
        else {
            //var dat=$('#weekly-date').val();
            //$.ajax({
            //    url: "service/check-drug-report.php",
            //    type: "POST",
            //    data: {
            //        action: 'check_weekly',
            //        dt: dat
            //    },
            //    //dataType: "json",
            //    success: function(result){
            //        if(result=='done'){
            //            $('#frame').prop('src', 'lib/tcpdf/reports/weekly-drug-report.php?dat='+dat+'');
            //                   
            //        }else{
            //            $('#frame').prop('src', 'lib/tcpdf/reports/no-data.php');
            //        }
            //    }
            //});
            var wkstart     = $('#startDate').text();
            var wkend       = $('#endDate').text();
            $.ajax({
                url: "service/check-drug-report.php",
                type: "POST",
                data: {
                    action: 'check_between',
                    start: wkstart,
                    end: wkend
                },
                //dataType: "json",
                success: function(result){
                    if(result=='done'){
                        $('#frame').prop('src', 'lib/tcpdf/reports/between-drug-report.php?start='+wkstart+'&end='+wkend+'');
                               
                    }else{
                        $('#frame').prop('src', 'lib/tcpdf/reports/no-data.php');
                    }
                }
            });
        }
    }
function monthlydrug(){
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
                url: "service/check-drug-report.php",
                type: "POST",
                data: {
                    action: 'check_monthly',
                    month: month,
                    year: year
                },
                //dataType: "json",
                success: function(result){
                    if(result=='done'){
                        $('#frame').prop('src', 'lib/tcpdf/reports/monthly-drug-report.php?month='+month+'&year='+year+'');
                               
                    }else{
                        $('#frame').prop('src', 'lib/tcpdf/reports/no-data.php');
                    }
                }
            });
        }
    }
    function yearlydrug(){
        if($('#yearly-year').val()=="select"){
            Lobibox.alert("error",
            {
                msg: 'Please Select a Year!'
            });
        }else{
            var year=$('#yearly-year').val();
            $.ajax({
                url: "service/check-drug-report.php",
                type: "POST",
                data: {
                    action: 'check_yearly',
                    year: year
                },
                //dataType: "json",
                success: function(result){
                    if(result=='done'){
                        $('#frame').prop('src', 'lib/tcpdf/reports/yearly-drug-report.php?year='+year+'');
                               
                    }else{
                        $('#frame').prop('src', 'lib/tcpdf/reports/no-data.php');
                    }
                }
            });
        }
    }
    function betweendrug(){
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
                url: "service/check-drug-report.php",
                type: "POST",
                data: {
                    action: 'check_between',
                    start: start,
                    end: end
                },
                //dataType: "json",
                success: function(result){
                    if(result=='done'){
                        $('#frame').prop('src', 'lib/tcpdf/reports/between-drug-report.php?start='+start+'&end='+end+'');
                               
                    }else{
                        $('#frame').prop('src', 'lib/tcpdf/reports/no-data.php');
                    }
                }
            });
        }
    }
    
    
    var startDate;
    var endDate;

    var selectCurrentWeek = function() {
        window.setTimeout(function () {
            $('#weekly-date').find('.ui-datepicker-current-day a').addClass('ui-state-active')
        }, 1);
    }

    $('#weekly-date').datepicker({
        dateFormat:'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        maxDate: 0,
        onSelect: function(dateText, inst) { 
            var date = $(this).datepicker('getDate');
            startDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay());
            endDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay() + 6);
            var dateFormat = inst.settings.dateFormat || $.datepicker._defaults.dateFormat;
            $('#startDate').text($.datepicker.formatDate( dateFormat, startDate, inst.settings ));
            $('#endDate').text($.datepicker.formatDate( dateFormat, endDate, inst.settings ));
            
            selectCurrentWeek();
        },
        beforeShowDay: function(date) {
            var cssClass = '';
            if(date >= startDate && date <= endDate)
                cssClass = 'ui-datepicker-current-day';
            return [true, cssClass];
        },
        onChangeMonthYear: function(year, month, inst) {
            selectCurrentWeek();
        }
    });

    //$('.week-picker .ui-datepicker-calendar tr').live('mousemove', function() { $(this).find('td a').addClass('ui-state-hover'); });
    //$('.week-picker .ui-datepicker-calendar tr').live('mouseleave', function() { $(this).find('td a').removeClass('ui-state-hover'); });
});
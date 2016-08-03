$(document).ready(function(){
    $('.nav-tabs a').click(function(){
        $(this).tab('show');
        $('#frame').prop('src', '');
    })
    $("#daily-date").datepicker({
        dateFormat:'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        maxDate: 0
    });
    $("#weekly-date").datepicker({
        dateFormat:'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        maxDate: 0
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
    $('#btn-daily-drug').on('click',function(e) {
        e.preventDefault();
        dailydrug();    
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
/**
     *var html="<html><head></head><body>Some text</body></html>";
     *function inject_html(html){
        var iframe = document.getElementById('frame');
        var iframedoc = iframe.document;
        if (iframe.contentDocument)
            iframedoc = iframe.contentDocument;
        else if (iframe.contentWindow)
            iframedoc = iframe.contentWindow.document;

        if (iframedoc){
            iframedoc.open();
            iframedoc.writeln(html);
            iframedoc.close();
        } else {
            alert('Cannot locate PDF.');
        }
    }**/
});
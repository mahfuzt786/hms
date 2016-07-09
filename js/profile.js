$("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
});
$("#menu-toggle-2").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled-2");
    $('#menu ul').hide();
});

function initMenu() {
    $('#menu ul').hide();
    $('#menu ul').children('.current').parent().show();
    //$('#menu ul:first').show();
    $('#menu li a').click(
        function() {
            var checkElement = $(this).next();
            if((checkElement.is('ul')) && (checkElement.is(':visible'))) {
                return false;
            }
            if((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
                $('#menu ul:visible').slideUp('normal');
                checkElement.slideDown('normal');
                return false;
            }
        }
        );
}
$(document).ready(function() {
    initMenu();
    $('[data-toggle="popover"]').popover({ 
        html : true,
        content: function() {
            return $('#popover_content_wrapper').html();
        }
    });
    //menu item active
    var pathname = window.location.href;
	    
    if (pathname.toLowerCase().indexOf("home") >= 0)
    {
        dashboardHigh();
    }
    if (pathname.toLowerCase().indexOf("setting") >= 0)
    {
        settingHigh();
    }
    if (pathname.toLowerCase().indexOf("drugs") >= 0)
    {
        drugsHigh();
    }
        
    function dashboardHigh()
    {
        $('#sidebar-wrapper ul li.listDashboard').addClass('active');
        $('#sidebar-wrapper ul li.listDrugs').removeClass('active');
        $('#sidebar-wrapper ul li.listSetting').removeClass('active');
    }
    function settingHigh()
    {
        $('#sidebar-wrapper ul li.listDashboard').removeClass('active');
        $('#sidebar-wrapper ul li.listDrugs').removeClass('active');
        $('#sidebar-wrapper ul li.listSetting').addClass('active');
    }
    function drugsHigh()
    {
        $('#sidebar-wrapper ul li.listDashboard').removeClass('active');
        $('#sidebar-wrapper ul li.listDrugs').addClass('active');
        $('#sidebar-wrapper ul li.listSetting').removeClass('active');
    }

});
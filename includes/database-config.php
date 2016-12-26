<?php
    try
    {
        $host='localhost';
        $database='wtfindin_hms';
        $user='root';
        $pass='';
		//$user='wtfindin_admin';
        //$pass='%5*admin87@';
        // connect (create a new MySQLi object)
        @   $mysqli = new mysqli($host, $user, $pass, $database);
     
        //checking for connection error
        if (mysqli_connect_errno())
        {
            throw new Exception(mysqli_connect_error());
        }
    }
    catch (Exception $e)
    {
        echo $e->getMessage();
    }
/*
#
# New XAMPP security concept
#
<LocationMatch "^/(?i:(?:xampp|security|licenses|phpmyadmin|webalizer|server-status|server-info))">
        Require local
	ErrorDocument 403 /error/XAMPP_FORBIDDEN.html.var
</LocationMatch>*/
?>

<?php
    try
    {
        $host='localhost';
        $database='wtfindin_hms';
        $user='root';
        $pass='';
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
?>
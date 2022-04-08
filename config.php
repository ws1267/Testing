<?php

    $myconn = new mysqli('localhost','root','','phpcrud');
    
    if($myconn->connect_error) {
        die("Could not connect to the database!".$myconn->connect_error);
    }

?>

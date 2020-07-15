<?php

    $connection = mysqli_connect("localhost","rafey","123","widget_corp");

    if(mysqli_connect_errno())
    {
        die("Connection Failed: " . mysqli_connect_error() . "(" .mysqli_connect_errno() . ")");
    }

?>  

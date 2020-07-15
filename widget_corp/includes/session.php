<?php

    session_start();

    function message()
    {
        if(isset($_SESSION["message"]))
        {
            $output = "<div class=\"message\">";
            $output .= htmlentities($_SESSION["message"]);
            $output .= "</div>";
            //nulling message
            $_SESSION["message"]=null;
            return $output;
        
        }
    }


    function errors()
    {
        if(isset($_SESSION["errors"]))
        {
            $errors = $_SESSION["errors"];
            //nulling message
            $_SESSION["errors"]=null;
            return $errors;
        
        }
    }
?>
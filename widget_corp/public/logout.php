<?php
    require_once("../includes/session.php");
    require_once("../includes/functions.php"); 
    
    $_SESSION["admin_id"]=null;
    $_SESSION["username"]=null;
    redirect("login.php");

    
 ?>

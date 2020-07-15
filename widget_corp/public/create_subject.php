<?php 
    session_start();
?>
<?php require_once("../includes/validation_functions.php"); ?>
<?php require_once("../includes/db.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/session.php"); ?>
<?php check_login();?>


<?php

    

    if(isset($_POST["submit"]))
    {
        $menu_name = mysql_prep($_POST["menu_name"]);
        $position = (int) $_POST["position"];
        $visible = (int) $_POST["visible"];

        //echo $menu_name;
        //echo $position;
        //echo $visible;

        //validations
        $required_fields = array("menu_name","position","visible");
        validate_presence($required_fields);

        $fields_with_max_length = array("menu_name" => 30);
        validate_max_length($fields_with_max_length); 

        if(!empty($errors))
        {
            $_SESSION["errors"] = $errors;
            redirect("new_subject.php");
        }
    

        $query = "Insert  into subjects (menu_name,position,visible) 
                 Values('{$menu_name}',{$position},{$visible} )";
        
        $result = mysqli_query($connection,$query);

        if($result)
        {
            $_SESSION["message"] = "Subject Created!!";
            redirect("manage_content.php");
        }
        else
        {
            $_SESSION["message"] = "Subject Creation Failed!!";
            redirect("new_subject.php");

        }

    }
    else
    {
        $_SESSION["message"] = "Something went wrong with Forms Error!!!!";
        redirect("new_subject.php");
    }
?>


<?php

    if(isset($connection))
    {
        mysqli_close($connection);
    }

?>
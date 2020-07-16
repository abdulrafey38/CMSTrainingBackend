<?php 
    session_start();
?>
<?php require_once("../includes/validation_functions.php"); ?>
<?php require_once("../includes/db.php"); ?>
<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/functions.php"); ?>


<?php check_login();?>

<?php
  if(isset($_POST["submit"]))
  {
      $username = mysql_prep($_POST["username"]);
      $password= password_encrypt($_POST["password"]);

      $required_fields = array("username","password");
      validate_presence($required_fields);

      $fields_with_max_length = array("username" => 30);
      validate_max_length($fields_with_max_length); 
     
      if(!empty($errors))
      {
          $_SESSION["errors"] = $errors; 
          redirect("new_admin.php");
      }

      $query = "Insert  into admins (username,hashed_password) 
               Values('{$username}','{$password}')";
               
      
      $result = mysqli_query($connection,$query);

      if($result)
      {
          $_SESSION["message"] = "Admin Created!!";
          redirect("manage_admins.php");
      }
      else
      {
          $_SESSION["message"] = "Admins Creation Failed!!";
          redirect("new_admin.php");
          
         

      }

  }
  else
  {
      $_SESSION["message"] = "Something went wrong with Forms Error!!!!";
      redirect("new_admin.php");
      
  }
?>



<?php

    if(isset($connection))
    {
        mysqli_close($connection);
    }

?>
<?php 
    session_start();

    require_once("../includes/validation_functions.php"); 
    require_once("../includes/db.php"); 
    require_once("../includes/session.php"); 
    include("../includes/layouts/header.php");
    require_once("../includes/functions.php");
    $username="";

  if(isset($_POST["submit"]))
  {
      $username = $_POST["username"];
      $password= $_POST["password"];

      $required_fields = array("username","password");
      validate_presence($required_fields);

      
      if(empty($errors))
      {
           $found_admin = attempt_login($username,$password);
            if($found_admin)
            {   
                $_SESSION["admin_id"]=$found_admin["id"];
                $_SESSION["username"] = $found_admin["username"];
                $_SESSION["message"] = "Welcome Admin!!";
                redirect("admin.php");
            }
            else
            {
                $_SESSION["message"] = "Invalid Credentials!!";
                redirect("login.php");
            }
        }
    } 
    else
    {

    }
?>

<div id="main">
    <div id="navigation">
        &nbsp;
    </div>
    
    <div id ="page">
        <h2>Login</h2>
        <?php
            echo message();
        ?>
        <?php $errors= errors(); ?>
        <?php echo form_error($errors); ?>
        <form action="login.php" method="post">
            <p>
                UserName  <input type="text" name="username" value="<?php 
                                echo htmlentities($username);?>"/>
            </p>
            <p>
                Password  <input type="password" name="password" value=""/>
            </p>

            <input type="submit" name="submit" value="Login"/>
        </form>
    </div>
</div>

<?php include("../includes/layouts/footer.php"); ?>
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

<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-t-85 p-b-20">
				<form class="login100-form validate-form" method="post" action="login.php">
					<span class="login100-form-title p-b-70">
						Welcome
					</span>
					<span class="login100-form-avatar">
						<img src="images/image.png" alt="AVATAR">
					</span>
					<?php
						echo message();
					?>
					<?php $errors= errors(); ?>
					<?php echo form_error($errors); ?>

					<div class="wrap-input100 validate-input m-t-85 m-b-35" data-validate = "Enter username">
						<input class="input100" type="text" name="username">
						<span class="focus-input100" data-placeholder="Username"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-50" data-validate="Enter password">
						<input class="input100" type="password" name="password">
						<span class="focus-input100" data-placeholder="Password"></span>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit" name = "submit">
							Login
						</button>
					</div>

					
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>

    <script src="javascript/main.js"></script>
    
<?php include("../includes/layouts/footer.php"); ?>
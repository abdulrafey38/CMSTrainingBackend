<?php
    $layout_context ="admin";
    include("../includes/layouts/header.php");
    require("../includes/functions.php"); 
    require("../includes/session.php");
    require_once("../includes/db.php");
    include("../includes/validation_functions.php");
    check_login();
    

    $current_admin = find_admin_by_id($_GET["id"]);    

    if(!$current_admin)
    {
        
        redirect("manage_admin.php");
    }

    if(isset($_POST["submit"]))
    {   

       
        
        //echo $username;
        //echo $password;

        $required_fields = array("username","password");
        validate_presence($required_fields);

        $fields_with_max_length = array("username" => 30);
        validate_max_length($fields_with_max_length); 
    
        if(empty($errors))
        {   
            $id = $current_admin["id"];
            $username = mysql_prep($_POST["username"]);
            $password= password_encrypt($_POST["password"],PASSWORD_BCRYPT);
            
        
            $query = "Update admins set username = '{$username}',hashed_password = '{$password}' where id = {$id} limit 1";

    
            $result = mysqli_query($connection,$query);

                if($result)
                {   
                    $_SESSION["message"] = "Admin Updated!!";
                    redirect("manage_admins.php");
                }
                else
                {
                    $_SESSION["message"] = "Admins Updation Failed!!";
                    redirect("new_admin.php");
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
				<form class="login100-form validate-form" method="post" action="edit_admin.php?id=<?php echo urlencode($current_admin["id"]);?>">
					<span class="login100-form-title p-b-70">
						Edit Admin
					</span>
					
					<?php
						echo message();
					?>
					<?php $errors= errors(); ?>
					<?php echo form_error($errors); ?>

					<div class="wrap-input100 validate-input m-t-85 m-b-35" data-validate = "Enter username">
						<input class="input100" type="text" name="username" value="<?php echo $current_admin["username"];?>">
						<span class="focus-input100" data-placeholder="Username"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-50" data-validate="Enter password">
						<input class="input100" type="password" name="password">
						<span class="focus-input100" data-placeholder="Password"></span>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit" name = "submit">
							Update Admin
						</button>
                    </div>
                    <br />
                    
                    <div class="container-login100-form-btn">
						<a href="manage_admins.php" class="login100-form-can" type="submit" name = "submit">
							Cancel
                        </a>
					</div>

					
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>

    <script src="javascript/main.js"></script>


        <?php include("../includes/layouts/footer.php"); ?>
   
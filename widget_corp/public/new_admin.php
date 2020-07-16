<?php
    $layout_context ="admin";
    include("../includes/layouts/header.php");
    require("../includes/functions.php"); 
    require("../includes/session.php");
    check_login();
?> 


<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-t-85 p-b-20">
				<form class="login100-form validate-form" method="post" action="create_admin.php">
					<span class="login100-form-title p-b-70">
						Create Admin
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
							Add Admin
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
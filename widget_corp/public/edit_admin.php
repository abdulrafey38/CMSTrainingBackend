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
            $password= password_encrypt($_POST["password"]);
            
        
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
       <div id="main">
            <div id="navigation">
                &nbsp;
            </div>

            <div id ="page">
                <h2>Edit Admin</h2>

                <?php
                    echo message();
                ?>
                <?php $errors= errors(); ?>
                <?php echo form_error($errors); ?>

            
                <form action="edit_admin.php?id=<?php echo urlencode($current_admin["id"]);?>" method="post">
                    <p>
                        UserName  <input type="text" name="username" value=""/>
                    </p>

                    <p>
                        Password  <input type="password" name="password" value=""/>
                    </p>

                    <input type="submit" name="submit" value="Update Admin"/>
                </form>

                <a href="manage_admins.php">Cancel</a>
            </div>
        </div>

        <?php include("../includes/layouts/footer.php"); ?>
   
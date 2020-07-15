<?php
    $layout_context ="admin";
    include("../includes/layouts/header.php");
    require("../includes/functions.php"); 
    require("../includes/session.php");
    check_login();
?> 
       <div id="main">
            <div id="navigation">
                &nbsp;
            </div>

            <div id ="page">
                <h2>Create Admin</h2>

                <?php
                    echo message();
                ?>


                <?php $errors= errors(); ?>
                <?php echo form_error($errors); ?>

                

                <form action="create_admin.php" method="post">
                    <p>
                        UserName  <input type="text" name="username" value=""/>
                    </p>

                    <p>
                        Password  <input type="password" name="password" value=""/>
                    </p>

                    <input type="submit" name="submit" value="Add Admin"/>
                </form>

                <a href="manage_admins.php">Cancel</a>
            </div>
        </div>

        <?php include("../includes/layouts/footer.php"); ?>
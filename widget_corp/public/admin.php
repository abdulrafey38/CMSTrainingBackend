<?php require("../includes/functions.php"); ?>
<?php require("../includes/session.php"); ?>

<?php check_login();?>
<?php $layout_context ="admin"?>
<?php include("../includes/layouts/header.php"); ?>


        <div id="main">
            <div id="navigation">
                &nbsp;
            </div>
            <?php
                echo message();
            ?>

            <div id ="page">
                <h2>Admin Menu</h2>
                <b>Welcome : <?php echo $_SESSION["username"];?>.</b>
                <ul>
                    <li><a href="manage_content.php">Manage Website Content</a></li>
                    <li><a href="manage_admins.php">Manage Admins</a></li>
                    <li><a href="logout.php">Log Out</a></li>
                </ul>
            </div>
        </div>

        <?php include("../includes/layouts/footer.php"); ?>
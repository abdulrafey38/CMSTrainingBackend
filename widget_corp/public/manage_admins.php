<?php
    $layout_context ="admin";
    include("../includes/layouts/header.php");
    require("../includes/functions.php");
    require("../includes/db.php");
    require("../includes/session.php");
    check_login();

    $admin_set = find_all_admin();
    
?>

        <div id="main">
            <div id="navigation">
                This is Navigation Bar!!
            </div>

            <div id ="page">
                <h2>Admin Manager</h2>
                <?php
                    echo message();
                ?>

                <b>Username</b> 
                <?php echo space();?>
                <b>Action</b>
                <br/>
                <p> <?php 
                        while($admin = mysqli_fetch_assoc($admin_set))
                        {
                            echo $admin["username"];
                            echo space();
                            echo "<a href=\"edit_admin.php?id={$admin["id"]}\">Edit</a>";
                            echo "&nbsp; &nbsp;";
                            echo "<a href=\"delete_admin.php?id={$admin["id"]}\" onclick = \"return confirm('ARE YOU SURE?');\">Delete</a>";
                            echo "<br />";
                        }
                    ?>

                    
                </p>

                <a href="new_admin.php">Add new admin </a>
                &nbsp; &nbsp;
                <a href= "admin.php">Cancel</a>
                             
                
            </div>
        </div>

<?php include("../includes/layouts/footer.php"); ?>
<?php require_once("../includes/db.php"); ?>
<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php check_login();?>


<?php 
    $current_admin = find_admin_by_id($_GET["id"]);

    if(!$current_admin)
    {
        redirect("manage_admins.php");
    }


    $id = $current_admin["id"];
    

    $query = "Delete from admins where id = {$id} limit 1";
    $result = mysqli_query($connection,$query);

    if($result && mysqli_affected_rows($connection) == 1 )
    {
        $_SESSION["message"] = "Admin Deleted!!!!";
        redirect("manage_admins.php");
    }
    else
    {
        $_SESSION["message"]= "Admin Deletion Failed!!!";
        redirect("manage_admins.php?id={$id}");
    }


?>
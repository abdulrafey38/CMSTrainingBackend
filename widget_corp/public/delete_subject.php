<?php require_once("../includes/db.php"); ?>
<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php check_login();?>


<?php 
    $current_subject = find_subject_by_id($_GET["subject"]);

    if(!$current_subject)
    {
        redirect("manage_content.php");
    }

    $page_set = find_pages_by_subject($current_subject["id"]);
    if(mysqli_num_rows($page_set) > 0)
    {
        $_SESSION["message"] = "Cant delete a subject with pages!!";
        redirect("manage_content.php?subject= {$current_subject["id"]}");
    }

    $id = $current_subject["id"];
    

    $query = "Delete from subjects where id = {$id} limit 1";
    $result = mysqli_query($connection,$query);

    if($result && mysqli_affected_rows($connection) == 1 )
    {
        $_SESSION["message"] = "Subject Deleted!!!!";
        redirect("manage_content.php");
    }
    else
    {
        $_SESSION["message"]= "Subject Deletion Failed!!!";
        redirect("manage_content.php?subject={$id}");
    }


?>
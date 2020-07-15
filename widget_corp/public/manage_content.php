<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php include("../includes/layouts/header.php"); ?>
<?php check_login();?>

<?php 
    if(isset($_GET["subject"]))
    {
        $selected_subject_id=$_GET["subject"];
        $selected_page_id=null;
    }
    elseif (isset($_GET["page"]))
    {
        $selected_page_id = $_GET["page"];
        $selected_subject_id=null; 
    }
    else{
        $selected_page_id=null;
        $selected_subject_id=null;
    }
?>

        <div id="main">
            <div id="navigation">
                <ul class="subjects">

                   <?php
                        $subject_set = find_all_subjects();
                   ?>



                    <?php
                        while($subject = mysqli_fetch_assoc($subject_set))
                        {
                    ?>
                    
                    <li class = "selected">
                        <a href="manage_content.php?subject=<?php echo urlencode($subject["id"]); ?>">
                            <?php 
                                echo $subject["menu_name"];
                            ?>
                        </a>

                        <?php
                           $page_set = find_pages_by_subject($subject["id"]);
                        ?>

                        <ul class="pages">

                            <?php
                                while($page = mysqli_fetch_assoc($page_set))
                                {
                            ?>
                    
                            <li>
                                <a href="manage_content.php?page=<?php echo urlencode($page["id"]); ?>">
                                    <?php 
                                        echo $page["menu_name"];
                                    ?>
                                </a>  
                            </li>
                        
                            <?php
                            }
                            ?>

                            <?php
                                mysqli_free_result($page_set);
                            ?>

                        </ul>

                    </li>

                    <?php
                        }
                    ?>

                    <?php
                        mysqli_free_result($subject_set);
                    ?>
                      
                      <br />
                      <a href= "new_subject.php">+ Add New Subject</a>
                </ul>
            </div>

            <div id ="page">
                <h2>Manage Content</h2>
            
                <?php
                    echo message();
                ?>

                <?php if($selected_subject_id) { ?>
                <?php $current_subject = find_subject_by_id($selected_subject_id) ;?>
                Menu Name :<?php echo " " .$current_subject["menu_name"]; ?>
                <br />
                Position :<?php echo " " .$current_subject["position"]; ?>
                <br />
                Visible :<?php echo " "; if($current_subject["visible"] == 1)
                                            {
                                                echo "Yes";
                                            }
                                            else{
                                                echo "No";
                                            }; ?>
                <br />
                <br />
                <a href="edit_subject.php?subject= <?php echo $current_subject["id"]; ?>">Edit Subject</a>


                <?php } elseif ($selected_page_id){ ?>
                <?php $current_page = find_page_by_id($selected_page_id); ?>
                Menu Name: <?php echo $current_page ["menu_name"];?>
                <?php } else { ?>
                Please select page id or subject id!!!.
                <?php } ?>
                <br />
                <a href= "admin.php">cancel</a>
            </div>
        </div>

<?php require("../includes/layouts/footer.php"); ?>


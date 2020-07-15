<?php 
    require_once("../includes/db.php");
    require_once("../includes/session.php");
    require_once("../includes/functions.php");
    include("../includes/layouts/header.php");

    check_login();


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
                
                <?php
                   echo message();
                ?>

                <?php $errors= errors(); ?>
                <?php echo form_error($errors); ?>

                    <h2> Create Subject</h2>
                <form action="create_subject.php" method = "post">
                    <p>Menu Name:
                        <input type="text" name="menu_name" value=""/>
                    </p>
                    <p>Position:
                        <select name="position">
                            <?php
                                $subj_set = find_all_subjects();
                                $subject_count=mysqli_num_rows($subj_set);
                                for($count =1 ; $count<=($subject_count +1 );$count++)
                                {
                                    echo "<option value =\"{$count}\">{$count}</option>";
                                }
                            ?>
                        </select>
                    </p>

                    <p>Visible:
                        <input type="radio" name="visible" value="0"/>NO
                        &nbsp;
                        <input type="radio" name="visible" value="1" /> YES
                    </p>
                    <input type="submit" name ="submit" value="Create Subject" />
                </form>
                <br />

                <a href ="manage_content.php"> Cancel</a>

               
            </div>
        </div>

<?php require("../includes/layouts/footer.php"); ?>


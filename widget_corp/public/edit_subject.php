<?php
 require_once("../includes/db.php"); 
 require_once("../includes/session.php"); 
 require_once("../includes/functions.php"); 
 include("../includes/layouts/header.php"); 
 include("../includes/validation_functions.php");
 check_login();

    $current_subject = find_subject_by_id($_GET["subject"]) ;



    if(!$current_subject)
    {
        
        redirect("manage_content.php");
    }
    //=========================================
       

    if(isset($_POST["submit"]))
    {
        //echo $menu_name;
        //echo $position;
        //echo $visible;

        //validations
        $required_fields = array("menu_name","position","visible");
        validate_presence($required_fields);

        $fields_with_max_length = array("menu_name" => 30);
        validate_max_length($fields_with_max_length); 

        if(empty($errors))
        {
            $id = $current_subject["id"];
            $menu_name = mysql_prep($_POST["menu_name"]);
            $position = (int) $_POST["position"];
            $visible = (int) $_POST["visible"];

    

            $query = "Update subjects 
                     set menu_name = '{$menu_name}', position = {$position}
                     ,visible = {$visible} where id = {$id}";
        
             $result = mysqli_query($connection,$query);

             if($result)
             {
                $_SESSION["message"] = "Subject Updated!!";
                redirect("manage_content.php");
            }
            else
            {
                $message = "Subject Updation Failed!!";
                
            }
        }

    }
    else
    {
        
        
    }
//===================================================================


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
                    <a href= "new_subject.php">
                        + Add New Subject
                    </a>
                </ul>  
               
            </div>

            <div id ="page">
                
                <?php
                   if(isset($message))
                   {
                       echo $message;
                   }
                ?>

                <?php echo form_error($errors); ?>

                    <h2> Edit Subject: <?php echo $current_subject["menu_name"] . "   ( " . $current_subject["position"] . " )"; ?></h2>
                <form action="edit_subject.php?subject= <?php echo $current_subject["id"];?>" method = "post">
                    <p>Menu Name:
                        <input type="text" name="menu_name" value="<?php echo $current_subject["menu_name"]; ?>"/>
                    </p>
                    <p>Position:
                        <select name="position">
                            <?php
                                $subj_set = find_all_subjects();
                                $subject_count=mysqli_num_rows($subj_set);
                                $pos = $current_subject["position"];
                                for($count =1 ; $count<= $subject_count ;$count++)
                                {
                                    echo "<option value =\"{$pos}\"";
                                    if($current_subject["position"]==$count)
                                    {
                                        echo " selected!!";
                                    }
                                    echo ">{$count}</option>";
                                }
                            ?>
                        </select>
                    </p>

                    <p>Visible:
                        <input type="radio" name="visible" value="0" 
                        <?php if($current_subject["visible"] == 0) { echo "checked";} ?>/>NO
                        &nbsp;
                        <input type="radio" name="visible" value="1" 
                        <?php if($current_subject["visible"] == 1) { echo "checked";} ?> /> YES
                    </p>
                    <input type="submit" name ="submit" value="Edit Subject" />
                </form>
                <br />

                <a href ="manage_content.php"> Cancel</a>
                &nbsp;
                &nbsp;

                <a href="delete_subject.php?subject=<?php 
                echo $current_subject["id"]; ?>" onclick = "return confirm('ARE YOU SURE?');">Delete Subject</a>




               
            </div>
        </div>

<?php require("../includes/layouts/footer.php"); ?>


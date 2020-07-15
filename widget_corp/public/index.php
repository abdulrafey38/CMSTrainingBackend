<?php
    require_once("../includes/session.php");
    require_once("../includes/db.php"); 
    require_once("../includes/functions.php");
   $layout_context = 
   
    include("../includes/layouts/header.php"); 


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
                        <a href="index.php?subject=<?php echo urlencode($subject["id"]); ?>">
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
                                <a href="index.php?page=<?php echo urlencode($page["id"]); ?>">
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
                      
                </ul>
            </div>

            <div id ="page">
            
                <?php
                    echo message();
                ?>

                <?php if($selected_subject_id) { ?>
                <?php $current_subject = find_subject_by_id($selected_subject_id) ;?>
                <h2> <?php echo $current_subject["menu_name"]; ?> </h2>
                Menu Name:<?php echo $current_subject["menu_name"]; ?>
                <br />
               
                <?php } elseif ($selected_page_id){ ?>
                <?php $current_page = find_page_by_id($selected_page_id); ?>
                <h2> <?php echo $current_page["menu_name"]; ?> </h2>
                Content: <?php echo $current_page ["content"];?>
                <?php } else { ?>
                <h1> Welcome </h1>
                <p> Hi How ARE YOU!!!</p>
                <?php } ?>
            </div>
        </div>

<?php require("../includes/layouts/footer.php"); ?>


<?php
    function confirm_query($result_set)
    {
        if(!$result_set)
        {
            die("DB query failed!!!");
        }
    }

    
    function find_all_subjects()    
    {
        global $connection ;
        $query =  "Select * from subjects order by position ASC ";
        $subject_set = mysqli_query($connection,$query);
        confirm_query($subject_set);
        return $subject_set;
    
    }


    function find_pages_by_subject($subject_id)
    {
        global $connection; 
        $query =  "Select * from pages where visible =1 and subject_id = {$subject_id} order by position ASC ";
        $page_set = mysqli_query($connection,$query);
        confirm_query($page_set);
        return $page_set;
    }

    function find_subject_by_id($subject_id)
    {
        global $connection ;  
        $safe_subject_id = mysqli_real_escape_string($connection,$subject_id);
        $query =  "Select * from subjects where id = {$safe_subject_id} Limit 1";
        $subject_set = mysqli_query($connection,$query);
        confirm_query($subject_set);
        if($subject = mysqli_fetch_assoc($subject_set))
        {
        return $subject;
        }
        else{
            return   null;
        }
    }

    function find_page_by_id($page_id)
    {
        global $connection ;  
        $safe_page_id = mysqli_real_escape_string($connection,$page_id);
        $query =  "Select * from pages where id = {$safe_page_id} Limit 1";
        $page_set = mysqli_query($connection,$query);
        confirm_query($page_set);
        if($page = mysqli_fetch_assoc($page_set))
        {
        return $page;
        }
        else{
            return   null;
        }
    }


    function redirect ($new_page)
    {
        header("Location: " .$new_page);
        exit;
    }

    function mysql_prep($string)
    {
        global $connection;
        return mysqli_real_escape_string($connection,$string);
    }


    function form_error($errors=array())
    {
        $output ="";
        
        if(!empty($errors))
        {
            $output .= "<div class=\"message\">";
            $output .= "These errors must be resolved";
            $output .= "<ul>";
            foreach ($errors as $key => $value)
            {
                $output .= "<li> {$value}</li>";

            }
            $output .= "</ul>";
            $output .= "</div>";


        }          

        return $output;

    }

    function find_defult_page($subject_id)
    {
        $page_set = find_pages_by_subject($subject_id);
        if($first_page=mysqli_fetch_assoc($page_set))
        {
            return $first_page;
        }
        else{
            return null;
        }
    }


    function space()
    {
    
        return "&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
        &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
        &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
        &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;";
    }
    //===================================
    //admin crud
    function find_all_admin()
    {
        global $connection ;
        $query =  "Select * from admins";
        $admin_set = mysqli_query($connection,$query);
        confirm_query($admin_set);
        return $admin_set;
    }

    function find_admin_by_id($admin_id)
    {
        global $connection ;  
        $safe_admin_id = mysql_prep($admin_id);
        $query =  "Select * from admins where id = {$safe_admin_id} Limit 1";
        $admin_set = mysqli_query($connection,$query);
        confirm_query($admin_set);
        if($admin = mysqli_fetch_assoc($admin_set))
        {
        return $admin;
        }
        else{
            return null;
        }
    }

    function password_encrypt($password)
    {
        $hash_format = "$2y$10$";
        $saltlength = 22;
        $salt = generate_salt($saltlength);
        $format_and_salt = $hash_format . $salt;
        $hash = crypt($password,$format_and_salt);
        return $hash;
    }

    function generate_salt($length)
    {
        $unique_random_string = md5(uniqid(mt_rand(),true));
        $base64_string = base64_encode($unique_random_string);
        $modified_base64_string = str_replace('+','.',$base64_string);
        $salt = substr($modified_base64_string,0,$length);
        return $salt;
    }

    function password_check($password,$existing_hash)
    {
        $hash = crypt($password,$existing_hash);
        if($hash === $existing_hash)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    function find_admin_by_username($username)
    {
        global $connection ;  
        $safe_admin_name = mysqli_real_escape_string($connection,$username);
        $query =  "Select * from admins where username = '{$safe_admin_name}' Limit 1";
        $admin_set = mysqli_query($connection,$query);
        confirm_query($admin_set);
        if($admin = mysqli_fetch_assoc($admin_set))
        {
        return $admin;
        }
        else{
            return   null;
        }
    }

    function attempt_login($username,$password)
    {
        $admin = find_admin_by_username($username);
        if($admin)
        {   
            if(password_verify($password,$admin["hashed_password"]))
            {   
                return $admin;
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }
    }


    function logged_in()
    {
        return isset($_SESSION["admin_id"]);
    }

    function check_login()
    {
        if(!logged_in())
        {
            redirect("login.php");
    
        }
    }

?>
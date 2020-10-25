<?php   

//require 'config/config.php';

// vars to prevent error
$f_name = "";
$l_name = "";
$em = "";
$em2 = "";
$pwd = "";
$pwd2 = "";
$date = "";
$error_array = array();     // holds error messages

if (isset($_POST['reg_button']))
{
    $f_name = strip_tags($_POST['reg_fname']);  // remove html tags
    $f_name = str_replace(' ', '', $f_name);    // remove space
    $f_name = ucfirst(strtolower($f_name));     // uppercase 1st letter
    $_SESSION['reg_fname'] = $f_name;           // stores 1st name into session var 
    
    $l_name = strip_tags($_POST['reg_lname']);  // remove html tags
    $l_name = str_replace(' ', '', $l_name);    // remove space
    $l_name = ucfirst(strtolower($l_name));     // uppercase 1st letter
    $_SESSION['reg_lname'] = $l_name;           // stores 1st name into session var 
    
    $em = strip_tags($_POST['reg_email']);      // remove html tags
    $em = str_replace(' ', '', $em);            // remove space
    $em = ucfirst(strtolower($em));             // uppercase 1st letter
    $_SESSION['reg_email'] = $em;               // stores 1st name into session var 
    
    $em2 = strip_tags($_POST['reg_email2']);    // remove html tags
    $em2 = str_replace(' ', '', $em2);          // remove space
    $em2 = ucfirst(strtolower($em2));           // uppercase 1st letter
    $_SESSION['reg_email2'] = $em2;             // stores 1st name into session var 

    $pwd = strip_tags($_POST['reg_pwd']);       // remove html tags
    $pwd2 = strip_tags($_POST['reg_pwd2']);     // remove html tags

    $date = date("Y-m-d");

    if ($em == $em2)
    {
        if(filter_var($em, FILTER_VALIDATE_EMAIL ))
        {
            // check if format is valid
            $em = filter_var($em, FILTER_VALIDATE_EMAIL);

            // check if email already used
            $e_check = mysqli_query($con, "SELECT email FROM users WHERE email = '$em'");
            $num_rows = mysqli_num_rows($e_check);
            if ($num_rows>0)
            {
                array_push($error_array, "err_em_exists<br>");
            }
        }
        else
        {
            array_push($error_array, "err_em_format<br>");
        }
    }
    else
    {
        array_push($error_array, "err_em_not_match<br>");
    }


    if(strlen($f_name)>25 || strlen($f_name)<2)
    {
        array_push($error_array, "err_fname_length<br>");
    }
    if(strlen($l_name)>25 || strlen($l_name)<2)
    {
        array_push($error_array, "err_lname_length<br>");
    }
    if($pwd != $pwd2)
    {
        array_push($error_array, "err_pwd_not_match<br>");
    }
    else
    {
        if(preg_match('/[^A-Za-Z0-9]/', $pwd)) // TODO DO NOT WORK! PUT A BETTER CHECK FOR THE PASSWORD
        {
            array_push($error_array, "err_pwd_format<br>");
        }
    }
    if(strlen($pwd)>30 || strlen($pwd)<5)
    {
        array_push($error_array, "err_pwd_length<br>");
    }


    if (empty($error_array))
    {
        // encrypt password
        $pwd = md5($pwd);
        $username = strtolower($f_name . "_" . $l_name);
        $username_new = $username;
        
        // progressively create a unique username TO DO : DO NOT WORD BUT ALLOW TO CREATE YOU OWN USER
        $i = 0;
        $check_username_query = mysqli_query($con, "SELECT user_name FROM users WHERE user_name = '$username'");
        $resultset = mysqli_num_rows($check_username_query);
        //echo "resultset= ".$resultset;
        while ($resultset != 0 )
        {
            //echo "i= ".$i;
            $i++;
            $username_new = $username . "_" . $i;
            $check_username_query = mysqli_query($con, "SELECT user_name FROM users WHERE user_name = '$username_new'");
            $resultset = mysqli_num_rows($check_username_query);
            //echo "resultset= ".$resultset; 
        } 
        $username = $username_new;

        // profile picture assignment
        $rand = rand(1, 2);
        if ($rand == 1)
            $profile_pic = "/quotes/assets/images/profile_pics/default/basic.png";
        else if ($rand == 2)
            $profile_pic = "/quotes/assets/images/profile_pics/default/suit.png";
    

        $query = mysqli_query ($con, "INSERT INTO users VALUES (NULL, '$f_name', '$l_name', '$username', '$em', '$pwd', '$date', '$profile_pic', '0', '0', 'no', ',' )");
        
        array_push($error_array, "<span style=' color: #14C800;'> You're all set! Go ahead and login.</span><br>");

        // clear session vars
        $_SESSION['reg_fname'] = "";
        $_SESSION['reg_lname'] = "";
        $_SESSION['reg_email'] = "";
        $_SESSION['reg_email2'] = "";
    
    }




}

#echo "ERROR: " .mysqli_error($con);

?>
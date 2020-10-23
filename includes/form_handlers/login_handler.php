<?php


if (isset($_POST['login_button']))

{

    $email = filter_var($_POST['log_email'], FILTER_SANITIZE_EMAIL);
    //$username=strip_tags($_POST['log_username']);
    $_SESSION['log_email'] =$email;                                     //store username into session variable
    $password=md5($_POST['log_password']); 

    $check_database_query = mysqli_query($con, "SELECT * FROM users WHERE email='$email' AND password='$password'");
    $check_login_query = mysqli_num_rows($check_database_query);
    //echo "check_login_query = ". $check_login_query;

    if ($check_login_query == 1)
    {
        $row = mysqli_fetch_array($check_database_query);
        $username=$row['user_name'];

        $user_closed_query = mysqli_query($con, "SELECT * FROM users WHERE email = '$email' AND user_closed='yes'"); 
		if(mysqli_num_rows($user_closed_query) == 1) {
            $reopen_account = mysqli_query($con, "UPDATE users SET user_closed='no' WHERE email='$email'");
		}
        

        $_SESSION['username'] = $username;
        header("Location: index.php");
        echo "000";
        exit();
    }
    else
    {
        array_push($error_array, "err_login_info<br>");
    }


}


?>
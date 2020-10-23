<?php  
require 'config/config.php';
require 'includes/form_handlers/register_handler.php';
require 'includes/form_handlers/login_handler.php';
?>


<html>
<head>
	<title>Welcome to Quotes!</title>
	<link rel="stylesheet" type="text/css" href="assets/css/register_style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="assets/js/register.js"></script>
</head>
<body>

	<?php  

    // if reg button has been pressed .. etc..
    // this is to avoid going to 1st whether there is an error in the registration on second  
	if(isset($_POST['register_button'])) {
		echo '
		<script>

		$(document).ready(function() {
			$("#first").hide();
			$("#second").show();
		});

		</script>

		';
	}


	?>

	<div class="wrapper">

		<div class="login_box">

			<div class="login_header">
				<h1>Quotes!</h1>
				Login or sign up below!
			</div>
			<br>
			<div id="first">

				<form action="register.php" method ="POST">  
                        <input type="email" name="log_email" placeholder="E-mail Address" value = "<?php 
                        if( isset($_SESSION['log_email']))
                        {
                            echo $_SESSION['log_email'];
                        } 
                        ?> "required>
                        <br>
                        <input type="password" name="log_password" placeholder="Password">
                        <br>
                        <?php if (in_array("err_login_info<br>", $error_array )) echo "Email/Username or password incorrect.<br>"; ?>
                        <input type="submit" name="login_button" value="Login">
                        <br>
                        <a href="#" id="signup" class="signup">Need and account? Register here!</a> <!-- # means go to the same page! --> 
                    </form>

			</div>

			<div id="second">

				<form action="register.php" method ="POST">  

                    
                        <input type="text" name="reg_fname" placeholder="First Name" 
                        value = "<?php 
                        if( isset($_SESSION['reg_fname']))
                        {
                            echo $_SESSION['reg_fname'];
                        } 
                        ?> " required><br>
                        <?php if (in_array("err_fname_length<br>", $error_array )) echo "Your first name must be betwen 2 and 25 characters<br>"; ?>

                        <input type="text" name="reg_lname" placeholder="Last Name" 
                        value = " <?php 
                        if( isset($_SESSION['reg_lname']))
                        {
                            echo $_SESSION['reg_lname'];
                        } 
                        ?> " required><br>
                        <?php if (in_array("err_lname_length<br>", $error_array )) echo "Your last name must be betwen 2 and 25 characters<br>"; ?>

                        <input type="email" name="reg_email" placeholder="E-mail" 
                        value = " <?php 
                        if( isset($_SESSION['reg_email']))
                        {
                            echo $_SESSION['reg_email'];
                        } 
                        ?> " required><br>

                        <input type="email" name="reg_email2" placeholder="Confirm E-mail" 
                        value = " <?php 
                        if( isset($_SESSION['reg_email2']))
                        {
                            echo $_SESSION['reg_email2'];
                        } 
                        ?> " required><br> <?php 
                        if (in_array("err_em_exists<br>", $error_array )) echo "Email already exists.<br>"; 
                        elseif (in_array("err_em_format<br>", $error_array )) echo "Email invalid format.<br>";
                        elseif (in_array("err_em_not_match<br>", $error_array )) echo "Email do not match.<br>";
                        ?>


                        <input type="password" name="reg_pwd" placeholder="Password" required><br>
                        <input type="password" name="reg_pwd2" placeholder="Confirm Password" required><br>
                        <?php 
                        if (in_array("err_pwd_not_match<br>", $error_array )) echo "Passwords don't match<br>"; 
                        elseif (in_array("err_pwd_format<br>", $error_array )) echo "Your password can only containt english characters or numbers<br>";
                        elseif (in_array("err_pwd_length<br>", $error_array )) echo "Your password must be betwen 5 and 30 characters<br>";
                        ?>

                        <input type="submit" name="reg_button" value="Register">
                        <br>
                        <?php if (in_array("<span style=' color: #14C800;'> You're all set! Go ahead and login.</span><br>", $error_array )) echo "<span style=' color: #14C800;'> You're all set! Go ahead and login. </span><br>"; ?>
                        
                        <a href="#" id="signin" class="signin">Already have an account? Sign in here!</a>
                    </form>  
			</div>

		</div>

	</div>


</body>
</html>

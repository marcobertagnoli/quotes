<?php   

require 'config/config.php';

if (isset($_SESSION['username'])){
    $userLoggedIn = $_SESSION['username'];
    $user_details_query = mysqli_query($con, "SELECT * FROM users WHERE user_name='$userLoggedIn'");
    $user = mysqli_fetch_array($user_details_query); // returns all info fron this user within an array
}
else{
    // redirect to register.php whether user tries to access index.php through the link
    // without being logged in
    header("Location: register.php");
}


?>

<!--  this will appear in every page we do! --> 
<html>
    <head>
        <title> Index Quotes Page </title>  

        <!---- Personal kit code from fontawesome.com user: mb@libero.it ---->
        <script src="https://kit.fontawesome.com/e62d168e37.js" crossorigin="anonymous"></script>

        <!---- JAVASCRIPT ---->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="assets/js/bootstrap.js"></script>  <!-- downloaded from bootstrap twitter -->

        <!---- CSS ---->
        <!--link rel = "stylesheet" type ="text/css" href="maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css"--> <!-- from font awesome -->
        <link rel = "stylesheet" type ="text/css" href="assets/css/bootstrap.css"> <!-- downloaded from bootstrap twitter -->
        <link rel = "stylesheet" type ="text/css" href="assets/css/style.css">  <!-- after bootstrap.css so we'll override any of the things -->
    </head>  
<body>

    <div class = "top_bar" >
        <div class="logo">
            <a href = "index.php"> Quotes </a>
            <!--img src = "assets/img/"-->
        </div>

        <nav>
            <a href ="#">
                <?php echo $user['first_name']; ?>
            </a>

            <a href ="#">
                <i class="fa fa-home fa-lg"></i>
            </a>
            <a href ="#">
                <i class="fa fa-envelope fa-lg"></i>
            </a>
            <a href ="#">
                <i class="fa fa-bell-o fa-lg"></i>
            </a>
            <a href ="#">
                <i class="fa fa-users fa-lg"></i>
            </a>
            <a href ="#">
                <i class="fa fa-cog fa-lg"></i>
            </a>
        </nav>

    </div>

    <div class = "wrapper" >

<?php   

require 'config/config.php';

if (isset($_SESSION['username'])){
    $userLoggedIn = $_SESSION['username'];
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

        <!---- JAVASCRIPT ---->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="assets/js/bootstrap.js"></script>  <!-- downloaded from bootstrap twitter -->

        <!---- CSS ---->
        <link rel = "stylesheet" type ="text/css" href="assets/css/bootstrap.css"> <!-- downloaded from bootstrap twitter -->
        <link rel = "stylesheet" type ="text/css" href="assets/css/style.css">  <!-- after bootstrap.css so we'll override any of the things -->
    </head>  
<body>

    <div class = "top_bar" >
        <div class="logo">
            <a href = "index.php"> Quotes </a>
            <!--img src = "assets/img/"-->
        </div>
    </div>

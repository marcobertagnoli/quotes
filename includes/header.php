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


<html>
<head>
<title>
Index Quotes Page
</title>  

</head>  
<body>
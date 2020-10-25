<?php
include("includes/header.php");
//destroy session whether user tries to refresh the page once logged in
//session_destroy();      
?>

    <div class="user_details column">  <!-- define two classes in this way -->

		<a href="#"><img src="<?php echo $user['profile_pic'];?>"></a>

    </div>

    </div> <!-- closing of the wrapper class -->
</body>  
</html>
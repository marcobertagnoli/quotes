<?php
include("includes/header.php");
//destroy session whether user tries to refresh the page once logged in
//session_destroy();      
?>

    <div class="user_details column"> <!-- define two classes in this way -->
		<a href="<?php echo $userLoggedIn; ?>">  <img src="<?php echo $user['profile_pic']; ?>"> </a>

		<div class="user_details_left_right">
			<a href="<?php echo $userLoggedIn; ?>">
			<?php 
			echo $user['first_name'] . " " . $user['last_name'];

			 ?>
			</a>
			<br>
			<?php echo "Posts: " . $user['num_posts']. "<br>"; 
			echo "Likes: " . $user['num_likes'];

			?>
		</div>

	</div>

    </div> <!-- closing of the wrapper class -->
</body>  
</html>
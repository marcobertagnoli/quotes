<?php
include("includes/header.php");
include("includes/classes/User.php");
include("includes/classes/Post.php");
//destroy session whether user tries to refresh the page once logged in
//session_destroy();      

if(isset($_POST['post']))
{
    $post = new Post($con, $userLoggedIn);
	$post->submitPost($_POST['post_text'],'none');
	//echo "Error: " . mysqli_error($this->con);	// print error

	// avoid resubmitting the post when page is refreshed (no form resubmission  dialog)
	header("Location: index.php");
}

?>

    <div class="user_details column"> <!-- define two classes in this way -->
		<a href="<?php echo $userLoggedIn; ?>">  <img src="<?php echo $user['profile_pic']; ?>"> </a>

		<div class="user_details_left_right">
            <a href="<?php echo $userLoggedIn; ?>">    
			<?php echo $user['first_name'] . " " . $user['last_name']; ?>
            </a>
			<br>
			<?php echo "Posts: " . $user['num_posts']. "<br>";  echo "Likes: " . $user['num_likes'];?>
		</div>

    </div>
    
    <div class="main_column column">
		<form class="post_form" action="index.php" method="POST">
			<textarea name="post_text" id="post_text" placeholder="Got something to say?"></textarea>
			<input type="submit" name="post" id="post_button" value="Post">
			<hr>

		</form>

		<!--?php 
		$post = new Post($con, $userLoggedIn);
		$post->loadPostsFriends();
		?-->
		<!-- Replacing this PHP with Ajax calls above !-->


	<div class="posts_area"></div>
	<img id="#loading" src="assets/images/icons/loading.gif">


	</div>

	
	<script>
	// AJAX ! allows to make database calls without refreshing the page

	var userLoggedIn = '<?php echo $userLoggedIn; ?>';

	$(document).ready(function()  // don't do nothing until the doc is ready
	{

		$('#loading').show();	// show the loading gif of above

		//Original ajax request for loading first posts 
		$.ajax({
			url: "includes/handlers/ajax_load_posts.php",  
			type: "POST",
			data: "page=1&userLoggedIn=" + userLoggedIn,
			cache:false,

			success: function(data) {
				$('#loading').hide();
				$('.posts_area').html(data); // put the data (posts) into the "posts_area" div
			}
		});

		// do this at scrolling
		$(window).scroll(function() {
			var height = $('.posts_area').height(); //Div containing posts
			var scroll_top = $(this).scrollTop();	// the top of the actual view when scrolling
			var page = $('.posts_area').find('.nextPage').val();
			var noMorePosts = $('.posts_area').find('.noMorePosts').val();

			if ((document.body.scrollHeight == document.body.scrollTop + window.innerHeight) && noMorePosts == 'false') {
				// the person's got to the bottom of the page => load more post
				
				$('#loading').show();

				var ajaxReq = $.ajax({
					url: "includes/handlers/ajax_load_posts.php",
					type: "POST",
					data: "page=" + page + "&userLoggedIn=" + userLoggedIn,
					cache:false,

					success: function(response) {
						$('.posts_area').find('.nextPage').remove(); //Removes current .nextpage 
						$('.posts_area').find('.noMorePosts').remove(); //Removes current .noMorePosts 

						$('#loading').hide();
						$('.posts_area').append(response);  // add new posts to the existing posts
					}
				});

			} //End if 

			return false;

		}); //End (window).scroll(function())


	});

	</script>




    </div> <!-- closing of the wrapper class -->


</body>  
</html>
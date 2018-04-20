
<html>
<head>
	<title>
		
	</title>

	 <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>

	<style>
	* {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
	color: #b69a07;
	}
	body {
    	background-color: #DCDCDC;
    }
    

	</style>

	<?php
require 'config/config.php';
include("includes/classes/User.php");
include("includes/classes/Post.php");

if (isset($_SESSION['username'])) {
	$userLoggedIn = $_SESSION['username'];
	$user_details_query = mysqli_query($connect, "SELECT * FROM users WHERE username='$userLoggedIn'");
	$user = mysqli_fetch_array($user_details_query);
}

else {
	header("Location: register.php");
}
?>
<script>
	function toggle() {
			var element = document.getElementById("comment_section");

			if(element.style.display == "block") 
				element.style.display = "none";
			else 
				element.style.display = "block";
		}	
	</script>

 <?php



if(isset($_GET['postID'])) {
		$postID = $_GET['postID'];
	}

	$user_query = mysqli_query($connect, "SELECT posted_by, sent_to FROM nfeedposts WHERE id='$postID'");
	$row = mysqli_fetch_array($user_query);

	$postedTO = $row['posted_by'];
	
	
	if(isset($_POST['postComment' . $postID])) {
		$postBody = $_POST['postBody'];
		$postBody = mysqli_escape_string($connect, $postBody);
		$dateandtime = date("Y-m-d H:i:s");
		$insert_post = mysqli_query($connect, "INSERT INTO comments VALUES ('', '$postBody', '$userLoggedIn', '$postedTO', '$dateandtime', 'no', '$postID')");
		echo "<p>Your comment has been Posted! </p>";
	}

		


	?>

	<form action="commentiframe.php?postID=<?php echo $postID; ?>" id="comment_form" name="postComment<?php echo $postID; ?>" method="POST">
		<textarea name="postBody"></textarea>
		<input type="submit" name="postComment<?php echo $postID; ?>" value="Post">
	</form>
 	
 	<?php 

 	$get_comments = mysqli_query($connect, "SELECT * FROM comments WHERE postID='$postID' ORDER BY id ASC");
	$count = mysqli_num_rows($get_comments);

	if($count != 0) {

		while($comment = mysqli_fetch_array($get_comments)) {

			$comment_body = $comment['postbody'];
			$posted_by = $comment['postedBY'];
			$posted_to = $comment['postedTO'];
			$date_added = $comment['dateadded'];
			$removed = $comment['removed'];

			//timimg
				$dateandtime_now = date("Y-m-d H:i:s");
				$start_date = new DateTime($date_added); //Time of post
				$end_date = new DateTime($dateandtime_now); //Current time
				$timesense = $start_date->diff($end_date); //Difference between dates 
				if($timesense->y >= 1) {
					if($timesense->y == 1)
						$tmessage = $timesense->y . " year ago"; //1 year ago
					else 
						$tmessage = $timesense->y . " years ago"; //1+ year ago
				}
				else if ($timesense->m >= 1) {
					if($timesense->d == 0) {
						$days = " ago";
					}
					else if($timesense->d == 1) {
						$days = $timesense->d . " day ago";
					}
					else {
						$days = $timesense->d . " days ago";
					}

					if($timesense->m == 1) {
						$tmessage = $timesense->m . " month ". $days;
					}
					else {
						$tmessage = $timesense->m . " months ". $days;
					}

				}
				else if($timesense->d >= 1) {
					if($timesense->d == 1) {
						$tmessage = "Yesterday";
					}
					else {
						$tmessage = $timesense->d . " days ago";
					}
				}
				else if($timesense->h >= 1) {
					if($timesense->h == 1) {
						$tmessage = $timesense->h . " hour ago";
					}
					else {
						$tmessage = $timesense->h . " hours ago";
					}
				}
				else if($timesense->i >= 1) {
					if($timesense->i == 1) {
						$tmessage = $timesense->i . " minute ago";
					}
					else {
						$tmessage = $timesense->i . " minutes ago";
					}
				}
				else {
					if($timesense->s < 30) {
						$tmessage = "Just posted now";
					}
					else {
						$tmessage = $timesense->s . " seconds ago";
					}
				}
			
			$user_obj = new User($connect, $posted_by);

			?>
			<div class="comment_section">
			<a href="<?php echo $posted_by?>" target="_parent"><img src="<?php echo $user_obj->getPic();?>" style="float:left;" height="30"></a>
			<a href="<?php echo $posted_by?>" target="_parent"> <b> <?php echo $user_obj->getFirstAndLastName(); ?> </b></a>
		&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $tmessage . "<br>" . $comment_body; ?> <hr>
	    </div>

			<?php

			}
		}

	else {
		echo "<center><br> There are no comments yet!</center>";
	}
 	 ?>

 	 	

	




</body>
</html>
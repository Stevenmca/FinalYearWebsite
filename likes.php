<html>
<head>
	<title>
		
	</title>
</head>
<body>

	<style type="text/css">
    	
    body {
    	background-color: #DCDCDC;
    }
    form {
		top: 0;
		color: #708090;
		height: 11px;
		width: auto;
	    font-family: Arial, Helvetica, sans-serif;
	    font-size: 15px;
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


if(isset($_GET['postID'])) {
		$postID = $_GET['postID'];
	}

	$get_likes = mysqli_query($connect, "SELECT likes, posted_by FROM nfeedposts WHERE id='$postID'");
	$row = mysqli_fetch_array($get_likes);
	$total_likes = $row['likes']; 
	$user_liked = $row['posted_by'];

	$user_details_query = mysqli_query($connect, "SELECT * FROM users WHERE username='$user_liked'");
	$row = mysqli_fetch_array($user_details_query);
	$total_user_likes = $row['numofLikes'];
	
	//like 
  if(isset($_POST['like_button'])) {
		$total_likes++;
		$query = mysqli_query($connect, "UPDATE nfeedposts SET likes='$total_likes' WHERE id='$postID'");
		$total_user_likes++;
		$user_likes = mysqli_query($connect, "UPDATE users SET numofLikes='$total_user_likes' WHERE username='$user_liked'");
		$insert_user = mysqli_query($connect, "INSERT INTO likes VALUES('', '$userLoggedIn', '$postID')");
	
}
	//unlike
 if(isset($_POST['unlike_button'])) {
		$total_likes--;
		$query = mysqli_query($connect, "UPDATE nfeedposts SET likes='$total_likes' WHERE id='$postID'");
		$total_user_likes--;
		$user_likes = mysqli_query($connect, "UPDATE users SET numofLikes='$total_user_likes' WHERE username='$user_liked'");
		$insert_user = mysqli_query($connect, "DELETE FROM likes WHERE username='$userLoggedIn' AND postID='$postID'");
	
	
}


	$check_query = mysqli_query($connect, "SELECT * FROM likes WHERE username='$userLoggedIn' AND postID='$postID'");
	$num_rows = mysqli_num_rows($check_query);

	if($num_rows > 0) {
		echo '<form action="likes.php?postID=' . $postID . '" method="POST">
				<input type="submit" class="comment_like" name="unlike_button" value="Unlike"><div class="like_value">
					'. $total_likes .' Likes
				</div>
			</form>
		';
	}
	else {
		echo '<form action="likes.php?postID=' . $postID . '" method="POST">
				<input type="submit" class="comment_like" name="like_button" value="Like">
				<div class="like_value">
					'. $total_likes .' Likes
				</div>
			</form>
		';
	}
?>
</body>
</html>
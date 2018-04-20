<?php  
include("includes/header.php");
include("includes/classes/User.php");
include("includes/classes/Post.php");

if(isset($_GET['profile_username'])) {
	$username = $_GET['profile_username'];
	$user_details_query = mysqli_query($connect, "SELECT * FROM users WHERE username='$username'");
	$user_array = mysqli_fetch_array($user_details_query);

	$num_friends = (substr_count($user_array['friendnum'], ",")) - 1;
}

if(isset($_POST['remove_friend'])) {
	$user = new User($connect, $userLoggedIn);
	$user->removeAfriend($username);
}

if(isset($_POST['add_friend'])) {
    echo "Add friend code was called"; // *** ADD THIS LINE ***
 
    $user = new User($connect, $userLoggedIn);
    $user->sendAfriendRequest($username);
}

if(isset($_POST['respond_request'])) {
	header("Location: requests.php");
}

?>

<style type="text/css">
	 	.wrapper {
	 		margin-left: 10px;
			padding-left: 10px;
			font-size: 17px;
	 	}
</style>

<body>

<br>
<div class="newsfeed column">
    
   

    </form>
  
    <?php

 $post = new Post($connect, $userLoggedIn);
 $post-> loadPostsFriends();

    ?>

    

    </div>


<div class="profile_left">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 		<img src="<?php echo $user_array['profile_pic']; ?>">
    <br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php echo $user_array['username']; ?>
  
<br>

<div class="profile_info">
		<p><?php echo "University: " . $user_array['university']; ?></p>
		<p><?php echo "Hometown: " . $user_array['htown']; ?></p>
 		<p><?php echo "Friends: " . $num_friends ?></p>
 		</div>
<br>
 <form action="<?php echo $username; ?>" method="POST">
 			<?php 
 			$profile_user_obj = new User($connect, $username); 
 			if($profile_user_obj->isClosed()) {
 				header("Location: userISclosed.php");
 			}


 			$logged_in_user_obj = new User($connect, $userLoggedIn); 

 			if($userLoggedIn != $username) {

 					
 				if($logged_in_user_obj->ShowPostToFriends($username)) {
 					echo '<input type="submit" name="remove_friend" class="unifriend" value="Remove Friend"><br>';
 				
 				}
 				else if ($logged_in_user_obj->didReceiveRequest($username)) {
 					echo '<input type="submit" name="respond_request" class="unifriend" value="Respond to Request"><br>';
 				}
 				else if ($logged_in_user_obj->didSendRequest($username)) {
 					echo '<input type="submit" name="" class="unifriend" value="Request Sent"><br>';
 				}
 				else 
 					echo '<input type="submit" name="add_friend" class="unifriend" value="Add Friend"><br>';

 			

				}

 			?>

 		</form>

<!-- Button trigger modal(javascprit add it from bs) -->

<input type="submit" class="postbutton" data-toggle="modal" data-target="#postform" value="Say Something!">



<!-- Modal(javascprit add it from bs) -->
<div class="modal fade" id="postform" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">What on your mind?</h4>
      </div>
      <div class="modal-body">
        <p>This will show on the newsfeed for your everyone to see!</p>

      	<form class="profileP" action="" method="POST">
      <div class="form-group">
      	<textarea class="form-control" name="post_body"></textarea>
      	<input type="hidden" name="sent_from" value="<?php echo $userLoggedIn; ?>">
      	<input type="hidden" name="sent_to" value="<?php echo $username; ?>">

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" name="postb" id="postbutton1">Post</button>
      </div>
    </div>
  </div>
</div>
  

</body>
</html>


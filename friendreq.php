<?php
include("includes/header.php");
include("includes/classes/User.php");
?>

<br>
<div class="main_column column" id="main_column">

	<h3>Friend Requests</h3>

	<?php  

	$query = mysqli_query($connect, "SELECT * FROM friend_req WHERE sent_to='$userLoggedIn'");
	if(mysqli_num_rows($query) == 0)
		echo "You do not have any requests at the minute";
	else {

		while($row = mysqli_fetch_array($query)) {
			$user_from = $row['sent_from'];
			$user_from_obj = new User($connect, $user_from);

			echo $user_from_obj->getFirstAndLastName() . "  has sent you a friend request";

			$user_from_friend_array = $user_from_obj->getFriendnum();
			if(isset($_POST['accept_request' . $user_from ])) {
				$add_friend_query = mysqli_query($connect, "UPDATE users SET friendnum=CONCAT(friendnum, '$user_from,') WHERE username='$userLoggedIn'");
				$add_friend_query = mysqli_query($connect, "UPDATE users SET friendnum=CONCAT(friendnum, '$userLoggedIn,') WHERE username='$user_from'");

				$delete_query = mysqli_query($connect, "DELETE FROM friend_req WHERE sent_to='$userLoggedIn' AND sent_from='$user_from'");
				echo "You are now friends!";
				header("Location: friendreq.php");
			}

			if(isset($_POST['ignore_request' . $user_from ])) {
				$delete_query = mysqli_query($connect, "DELETE FROM friend_req WHERE sent_to='$userLoggedIn' AND sent_from='$user_from'");
				echo "Request ignored!";
				header("Location: friendreq.php");
			}

			?>
			<form action="friendreq.php" method="POST">
				<input type="submit" name="accept_request<?php echo $user_from; ?>" id="acceptB" value="Accept">
				<input type="submit" name="ignore_request<?php echo $user_from; ?>" id="ignoreB" value="Ignore">
			</form>
			<?php


		}

	}

	?>


</div>
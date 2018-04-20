<?php 
include("includes/header.php");
include("includes/form_handlers/settingshandler.php");
?>

<div class="main_column column">

	<h2>Account Settings</h2>
	<?php
	echo "<img src='" . $user['profile_pic'] ."' class='small_profile_pic'>";
	?>
	<br>
	<a href="upload.php">Upload new profile picture</a> 
	<br>
	<br>
	<br>

	<h4>Modify the values and click 'Update Details'</h4>
	<br>

	<form action="settings.php" method="POST">
		First Name: <input type="text" name="first_name" value="<?php echo $user['first_name']; ?>"><br><br>
		Last Name: <input type="text" name="last_name" value="<?php echo $user['last_name']; ?>"><br><br>
        University: <input type="text" name="uni_name" value="<?php echo $user['university']; ?>"><br><br>
        Hometown: <input type="text" name="htown_name" value="<?php echo $user['htown']; ?>"><br><br>
		

		<input type="submit" name="updateuserdetails" id="save_details" value="Update Details" class="info settings_submit"><br>
	</form>

	<h4>Change Password</h4>
	<form action="settings.php" method="POST">
		Old Password: <input type="text" name="Oldpass"><br><br>
		New password : <input type="text" name="newpass"><br><br>
        Confirm new password: <input type="text" name="newpass1"><br><br>
		

		<input type="submit" name="changepass" id="savepass" value="Update Password" class="info settings_submit"><br>
	</form><br><br>

	<h4>Close Account</h4><br>
	<form action="settings.php" method="POST">
		<input type="submit" name="closeaccount" id="closeaccount" value="CloseAccount">
	</form>


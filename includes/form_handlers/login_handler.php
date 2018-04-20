<?php

if(isset($_POST['login_button'])) {

	$email = filter_var($_POST['log_email'], FILTER_SANITIZE_EMAIL);

	$_SESSION['log_email'] = $email;
	$password = md5($_POST['log_password']);

	$check_database_query = mysqli_query($connect, "SELECT * FROM users WHERE  password='$password' AND email='$email'" );
	$check_login_query = mysqli_num_rows($check_database_query);

//allows to check for login 
if($check_login_query == 1) {
		$row = mysqli_fetch_array($check_database_query);
		$username = $row['username'];


//allowing users to reopen their accounts my logging in
$user_closed_query = mysqli_query($connect, "SELECT * FROM users WHERE email='$email' AND user_closed='yes'");
if(mysqli_num_rows($user_closed_query) == 1) {
		$reopen_account = mysqli_query($connect, "UPDATE users SET user_closed='no' WHERE email='$email'");
}

$_SESSION['username'] = $username;
		header("Location: index.php");
		exit();
}


else {
		array_push($errorarray, "Email or password was incorrect<br>");
	}
}

?>
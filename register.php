<?php
require 'config/config.php';
require 'includes/form_handlers/r_handler.php';
require 'includes/form_handlers/login_handler.php';


?>

<html>

<head>
       <title> Join UniNet today!</title>
       <link rel="stylesheet" type="text/css" href="assets/css/r-css.css">
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
       <script src="assets/js/res.js"></script>
</head>

<body>

<div class="wrapper">


	<div class="login">
	<div class= "loginhead">
	
	 <h1>UniNet</h1>

		Login or sign up below!
		
	</div>
	

	<div class="first">
<form action="register.php" method="POST">

<input type="email" name="log_email" placeholder="University email" value="<?php 
	if (isset($_SESSION['login_email'])) {
		echo $_SESSION['login_email'];

	} 

	?>" required>
		<br>
		<input type="password" name="log_password" placeholder="password">
		<br>
		<input type="submit" name="login_button" value="Login">
		<br>
		<?php if(in_array("Email or password was incorrect<br>", $errorarray)) echo  "Email or password was incorrect<br>"; ?>
		<br>
		<a href="#" id="signup" class="signup">If you need an account click to register here!</a>
		</form>
	</div>

	 <div class="second">
	<form action="register.php" method="POST">

		<input type="text" name="reg_fname" placeholder="First Name" value="<?php 
		if (isset($_SESSION['reg_fname'])) {
			echo $_SESSION['reg_fname'];

		} 

		?>" required="">
		<br>
		<?php if(in_array("Your first name must be between 2 and 15 characters<br>", $errorarray))echo "Your first name must be between 2 and 15 characters<br>"; ?>

	    <input type="text" name="reg_lname" placeholder="Last Name" value="<?php 
		if (isset($_SESSION['reg_lname'])) {
			echo $_SESSION['reg_lname'];

		} 

		?>" required="">
	    <br>
	    <?php if(in_array("Your last name must be between 2 and 15 characters<br>", $errorarray)) echo "Your last name must be between 2 and 15 characters<br>"; ?>

	    <input type="email" name="reg_email" placeholder="University Email" value="<?php 
		if (isset($_SESSION['reg_email'])) {
			echo $_SESSION['reg_email'];

		} 

		?>" required="">
		<br>
		<input type="email" name="reg_email2" placeholder="Confirm Email" value="<?php 
		if (isset($_SESSION['reg_email2'])) {
			echo $_SESSION['reg_email2'];

		} 

		?>" required="">
		<br>

		 <?php if(in_array("You have entered two emails that do not match<br>", $errorarray))    echo "You have entered two emails that do not match<br>";?>

		 <?php if(in_array("You must sign in using a vaild university email<br>", $errorarray))    echo "You must sign in using a vaild university email<br>";?>


		<input type="password" name="reg_password" placeholder="Password" required="">
		<br>
		<input type="password" name="reg_password2" placeholder="Confirm Password" required="">
		<br>

		<?php if(in_array("You have entered two passwords that do not match<br>", $errorarray)) echo "You have entered two passwords that do not match<br>";

	      else if(in_array("Your password must only be made up of numbers and letters <br>", $errorarray)) echo "Your password must only be made up of numbers and letters <br>";

	    else if(in_array("The password you entered must be between 5 and 25 characters<br>", $errorarray)) echo "The password you entered must be between 5 and 25 characters<br>";
		?>

		<input type="text" name="reg_university" placeholder=" Where do you go to university?" required="">
		<br>

		<input type="text" name="reg_htown" placeholder=" What is your hometown?" required="">
		<br>

		<input type="submit" name="register_button" value="Register">
	    <br>
	    <?php if(in_array("<span style='color: Tomato;'> Your account has made! You can now log in!</span><br>", $errorarray)) echo "<span style='color: Tomato;'> Your account has made! You can now log in!</span><br>"; ?>
	    	<a href="#" id="signin" class="signin">Already have an account? Sign in here!</a>
	</form>
	    </div>
	</div>
</div>
</body>
</html>
<?php
require 'config/config.php';


if (isset($_SESSION['username'])) {
	$userLoggedIn = $_SESSION['username'];
	$user_details_query = mysqli_query($connect, "SELECT * FROM users WHERE username='$userLoggedIn'");
	$user = mysqli_fetch_array($user_details_query);
}

else {
	header("Location: register.php");
}
?>

<html>

<head>
       <title> UniNet </title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="assets/js/bootstrap.js"></script>	
<script src="assets/js/uninet.js"></script>	
<script src="assets/js/jcrop_bits.js"></script>
<script src="assets/js/jquery.Jcrop.js"></script>



<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="assets/css/style.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/solid.css" integrity="sha384-v2Tw72dyUXeU3y4aM2Y0tBJQkGfplr39mxZqlTBDUZAb9BGoC40+rdFCG0m10lXk" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/fontawesome.css" integrity="sha384-q3jl8XQu1OpdLgGFvNRnPdj5VIlCvgsDQTQB6owSOHWlAurxul7f+JpUOVdAiJ5P" crossorigin="anonymous">
<link rel="stylesheet" href="assets/css/jquery.Jcrop.css" type="text/css" />

</head>

<body>

	<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
</script>

	<div class="headerbar">


		<div class="searchbar">

			<form action="search.php" method="GET" name="search_form">
				<input type="text" onkeyup="getLiveSearchUsers(this.value, '<?php echo $userLoggedIn; ?>')" name="q" placeholder="Search a user" autocomplete="off" id="search_text_input">&nbsp;<i class="fas fa-search"></i>

			</form>

			<div class="searchresults">
			</div>

			<div class="searchisempty">
			</div>



		</div>

		<nav>

			<a href="unihelp.php"> UniHelp?</a>&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;

            <a href="unimaps.php"> Uni Maps</a>&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            
			<a href="index.php" data-toggle="tooltip" data-placement="bottom" title="Homefeed">
				<i class="fas fa-home fa-2x"></i>&nbsp;&nbsp;
			</a>
			<a href="<?php echo $userLoggedIn; ?>" data-toggle="tooltip" data-placement="bottom" title="Profile">
            <i class="fas fa-user-circle fa-2x"></i></i>&nbsp;&nbsp;

			</a>

			<a href="friendreq.php" data-toggle="tooltip" data-placement="bottom" title="Friend requests">
				<i class="fas fa-users fa-2x"></i>&nbsp;&nbsp;
			</a>

			<a href="settings.php" data-toggle="tooltip" data-placement="bottom" title="Settings">
				<i class="fas fa-cogs fa-2x"></i>&nbsp;&nbsp;
			</a>

			<a href="includes/handlers/logout.php" data-toggle="tooltip" data-placement="bottom" title="Logour">
				<i class="fas fa-sign-in-alt fa-2x"></i>
			</a>

		</nav>
</div>
 <div class="wrapper">
 	

 
	

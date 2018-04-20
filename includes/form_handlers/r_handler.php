<?php
$fname = "";
$lname = "";
$email = "";
$email2 = "";
$password = "";
$password2 = "";
$date = "";
$university = "";
$htown = "";
$errorarray = array(); // this is to hold any error messages

if (isset($_POST['register_button'])){

        

  // first name 
  $fname = strip_tags($_POST['reg_fname']);
  $fname = str_replace(' ', '', $fname);
  $fanme = ucfirst(strtolower($fname));
  $_SESSION['reg_fname'] = $fname; //sesssion variable

  // last name 
  $lname = strip_tags($_POST['reg_lname']);
  $lname = str_replace(' ', '', $lname);
  $lname = ucfirst(strtolower($lname));
    $_SESSION['reg_lname'] = $lname; //sesssion variable

  // email 
  $email = strip_tags($_POST['reg_email']);
  $email = str_replace(' ', '', $email);
  $email = ucfirst(strtolower($email));
  $_SESSION['reg_email'] = $email; //sesssion variable

  // email confirm n
  $email2 = strip_tags($_POST['reg_email2']);
  $email2 = str_replace(' ', '', $email2);
  $email2 = ucfirst(strtolower($email2));
  $_SESSION['reg_email2'] = $email2; //sesssion variable


  // password
  $password = strip_tags($_POST['reg_password']);
    // confirm password
  $password2 = strip_tags($_POST['reg_password2']);
  // date
  $date = date("Y=m-d");
  // university
  $university = strip_tags($_POST['reg_university']);
  //hometwon 
  $htown = strip_tags($_POST['reg_htown']);
  
  // if statement to check the email addresses
 if($email == $email2) {

}
else {
      array_push($errorarray, "You have entered two emails that do not match<br>");
    }

}

if(substr($email, -strlen("ac.uk")) == "ac.uk") {
    // **** DOES END IN ac.uk ****
}
else {
    array_push($errorarray, "You must sign in using a vaild university email<br>");
}

 if(strlen($fname) > 15 || strlen($fname) <2) {
  array_push($errorarray, "Your first name must be between 2 and 15 characters<br>");
      
    }

 if(strlen($lname) > 15 || strlen($lname) <2) {
  array_push($errorarray, "Your last name must be between 2 and 15 characters<br>");
      
    }

    if ($password != $password2) {
  array_push($errorarray, "You have entered two passwords that do not match<br>");
      
    }
    else {
      if (preg_match('/[^A-Za-z0-9]/', $password)) {
        array_push($errorarray, "Your password must only be made up of numbers and letters <br>");
      }
    
    }

    if(strlen($password) > 15 || strlen($password) <5) {
  array_push($errorarray,"The password you entered must be between 5 and 25 characters<br>");
      
    }


   if (empty($errorarray)) {
     $password = md5($password); // hides password before saving to database

     $username = strtolower($fname . "_" . $lname);
     $check_username_query = mysqli_query($connect, "SELECT username FROM users WHERE username= '$username'");

     $i = 0;

     while (mysqli_num_rows($check_username_query) !=0) {
      $i++;
      $username = $username . "_" . $i;
      $check_username_query = mysqli_query($connect, "SELECT username FROM users WHERE username= '$username'");
     }
      //profile pics
     $profile_pic = "https://www.springboard.com/images/springboard/default-profile-mentor-rounded@2x.70dc0c67.png";
     //enter users data into database
     $query = mysqli_query($connect, "INSERT INTO users VALUES ('','$fname', '$lname', '$username', '$email', '$password', '$date', '$profile_pic', 'no', ',', '0', '$university', '$htown' )");

     array_push($errorarray, "<span style='color: Tomato;'> Your account has made! You can now log in!</span><br>");


     $_SESSION ['reg_fname'] ="";
     $_SESSION ['reg_lname'] ="";
     $_SESSION ['reg_email'] ="";
     $_SESSION ['reg_email2'] ="";

   }

?>
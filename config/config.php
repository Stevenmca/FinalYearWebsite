<?php

ob_start();

session_start();

$timezone = date_default_timezone_set("Europe/London");
$connect =mysqli_connect("localhost", "root", "","uninet"); //to make a connection with the database

if (mysqli_connect_errno())
{
  echo "Failed to connect to the correct database" . mysqli_connect_errno(); //database error message

}

?>
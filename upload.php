<?php  
include("includes/header.php");
include("includes/classes/User.php");
include("includes/classes/Post.php");
?>

<style type="text/css">
    .wrapper {
      margin-left: 10px;
      padding-left: 10px;
      font-size: 14px;
    }
</style>

<body>

<br>

<div class="newsfeed column">

    <h4>Upload a Profile Picture</h4>
    <br>
    <p>To update your profile picture please enter a web URL below and press submit!</p>

   <input type="text" name="pro_pic" placeholder=" Enter a url" required="">

    <br>
    <br>

  <input type="submit" name="upload_pic" value="Submit">
   

    

 </div>





  

</body>
</html>


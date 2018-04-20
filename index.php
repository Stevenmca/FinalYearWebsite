<?php  
include("includes/header.php");
include("includes/classes/User.php");
include("includes/classes/Post.php");


if(isset($_POST['post'])){
 $post = new Post($connect, $userLoggedIn);
  $post-> submitPost ($_POST['post-text'], 'none'); }
?>

<body>
<br>
<div class="user_details column">
    <a href="<?php echo $userLoggedIn; ?>">  <img src="<?php echo $user['profile_pic']; ?>"> </a>

<div class="user_details_left_right">
  Welcome to &nbsp;&nbsp;&nbsp;UniNet!
  
  <p>
   
  <a href="<?php echo $userLoggedIn; ?>">
    <?php echo $user['first_name'] . " " . $user['last_name']; ?>
  </a>
  <br>
  <br>
  

    </div>
    
</div>
    <div class="newsfeed column">
    <form class="post_form" action="index.php" method="POST">
      <textarea name="post-text" id="post-text" placeholder="What's on your mind?"></textarea>
      <input type="submit" name="post" id="post-button" value="Post">
      <hr>

    </form>
  
    <?php

 $post = new Post($connect, $userLoggedIn);
 $post-> loadPostsFriends();

    ?>

</body>
</html>


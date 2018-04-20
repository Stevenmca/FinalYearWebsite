<?php  
require '../../config/config.php';
include("../classes/User.php");
include("../classes/Post.php");


if(isset($_POST['post_body'])) {

	$post = new Post($connect, $_POST['sent_from']);
	$post->submitPost($_POST['post_body'], $_POST['sent_to']);
}

?>
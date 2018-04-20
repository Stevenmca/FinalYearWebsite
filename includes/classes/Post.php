<?php
class Post {
	private $user_obj;
	private $connect;

public function __construct($connect, $user){
		$this->connect = $connect;
		$this->user_obj = new User($connect, $user);
	}

public function submitPost($body, $sent_to) {
		
		$body = strip_tags($body); 
		$body = mysqli_real_escape_string($this->connect, $body);
		$check_empty = preg_replace('/\s+/', '', $body); 
      
		if($check_empty != " ") {
			//time of post
			$dateandposted = date("Y-m-d H:i:s");
            //username
   			$posted_by = $this->user_obj->getUsername();

        
   		if($sent_to == $posted_by){
			$sent_to = "none";
   		}
	}
      // put the post in the newsfeed posts database
	$query = mysqli_query($this->connect, "INSERT INTO nfeedposts VALUES('', '$body', '$posted_by', '$sent_to', '$dateandposted', 'no', 'no', '0')");
			$r_id = mysqli_insert_id($this->connect);


}

public function loadPostsFriends() {

		$string = ""; //String to return 
		$data = mysqli_query($this->connect, "SELECT * FROM nfeedposts WHERE deleted='no' ORDER BY id DESC");
		$userisloggedIn = $this->user_obj->getUsername();


		while($rows = mysqli_fetch_array($data)) {
				$id = $rows['id'];
				$body = $rows['body'];
				$posted_by = $rows['posted_by'];
				$dateandtime = $rows['date_posted'];
				

				if($rows['sent_to'] == "none") {
				$user_to = "";
					}
				else {
					$user_to_obj = new User($this->connect, $rows['sent_to']);
					$user_to_name = $user_to_obj->getFirstAndLastName();
					$user_to = "to <a href='" . $rows['sent_to'] ."'>" . $user_to_name . "</a>";
				}

                //dont allow user to post if account is closed
		$user_to_obj = new User($this->connect, $rows['sent_to']);
		$posted_by_obj = new User($this->connect, $posted_by);
				if($posted_by_obj->isClosed()) {
					continue;
				}

		$user_logged_obj = new User($this->connect, $userisloggedIn);
				if($user_logged_obj->ShowPostToFriends($posted_by)){

		$user_details_query = mysqli_query($this->connect, "SELECT first_name, last_name, profile_pic FROM users WHERE username='$posted_by'");
				$user_row = mysqli_fetch_array($user_details_query);
				$first_name = $user_row['first_name'];
				$last_name = $user_row['last_name'];
				$profile_pic = $user_row['profile_pic']; 


				?>
					<script> 
						function toggle<?php echo $id; ?>() {
								
						var element = document.getElementById("toggleComment<?php echo $id; ?>");

							if(element.style.display == "block") 
								element.style.display = "none";
							else 
								element.style.display = "block";
							
						}

					</script>
					<?php

					$comments_check = mysqli_query($this->connect, "SELECT * FROM comments WHERE postID='$id'"); //thismightit
					$comments_check_num = mysqli_num_rows($comments_check);

				//timimg
				$dateandtime_now = date("Y-m-d H:i:s");
					$start_date = new DateTime($dateandtime); //Time of post
					$end_date = new DateTime($dateandtime_now); //Current time
					$timesense = $start_date->diff($end_date); //Difference between dates 
					if($timesense->y >= 1) {
						if($timesense->y == 1)
							$tmessage = $timesense->y . " year ago"; //1 year ago
						else 
							$tmessage = $timesense->y . " years ago"; //1+ year ago
					}
					else if ($timesense->m >= 1) {
						if($timesense->d == 0) {
							$days = " ago";
						}
						else if($timesense->d == 1) {
							$days = $timesense->d . " day ago";
						}
						else {
							$days = $timesense->d . " days ago";
						}


						if($timesense->m == 1) {
							$tmessage = $timesense->m . " month ". $days;
						}
						else {
							$tmessage = $timesense->m . " months ". $days;
						}

					}
					else if($timesense->d >= 1) {
						if($timesense->d == 1) {
							$tmessage = "Yesterday";
						}
						else {
							$tmessage = $timesense->d . " days ago";
						}
					}
					else if($timesense->h >= 1) {
						if($timesense->h == 1) {
							$tmessage = $timesense->h . " hour ago";
						}
						else {
							$tmessage = $timesense->h . " hours ago";
						}
					}
					else if($timesense->i >= 1) {
						if($timesense->i == 1) {
							$tmessage = $timesense->i . " minute ago";
						}
						else {
							$tmessage = $timesense->i . " minutes ago";
						}
					}
					else {
						if($timesense->s < 30) {
							$tmessage = "Just posted now";
						}
						else {
							$tmessage = $timesense->s . " seconds ago";
						}
					}

				$string .= "<div class='statusupdate' onClick='javascript:toggle$id()'>
								<div class='profilepic'>
									<img src='$profile_pic' width='50'>
								</div>

									<div class='posted_by' style='color:#ACACAC;'>
									<a href='$posted_by'> $first_name $last_name </a> $user_to &nbsp;&nbsp;&nbsp;&nbsp;$tmessage
									
								</div>
								<div id='post_body'>
									$body
									<br>
									
									
								</div>

								<div class='newsfeedPostOptions'>
								Comments($comments_check_num)&nbsp;&nbsp;&nbsp;
								<iframe src='likes.php?postID=$id' scrolling='no'></iframe>
								</div>

							</div>
							<div class='post_comment' id='toggleComment$id' style='display:none;'>
								
								<iframe src ='commentiframe.php?postID=$id' id='commentiframe' frameborder='0's>></iframe>
								</div>
							<hr>";
						}


			}
			echo $string;
		}
	}


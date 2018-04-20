<?php
class User {
	private $user;
	private $connect;

public function __construct($connect, $user){
		$this->connect = $connect;
		$user_details_query = mysqli_query($connect, "SELECT * FROM users WHERE username='$user'");
		$this->user = mysqli_fetch_array($user_details_query);
	}

public function getUsername(){
	return $this ->user['username'];
	}

public function getFirstAndLastName() {
		$username = $this->user['username'];
		$query = mysqli_query($this->connect, "SELECT first_name, last_name FROM users WHERE username='$username'");
		$row = mysqli_fetch_array($query);
		return $row['first_name'] . " " . $row['last_name'];
	}
 
public function getPic() {
		$username = $this->user['username'];
		$query = mysqli_query($this->connect, "SELECT profile_pic FROM users WHERE username='$username'");
		$row = mysqli_fetch_array($query);
		return $row['profile_pic'];
	}

 public function isClosed() {
		$username = $this->user['username'];
		$query = mysqli_query($this->connect, "SELECT user_closed FROM users WHERE username='$username'");
		$row = mysqli_fetch_array($query);

		if($row['user_closed'] == 'yes')
			return true;
		else 
			return false;
	}
 public function ShowPostToFriends($username_Needscheck) {
		$usernameComma = "," . $username_Needscheck . ",";

		if((strstr($this->user['friendnum'], $usernameComma) || $username_Needscheck == $this->user['username'])) {
			return true;
		}
		else {
			return false;
		}
	}

public function didReceiveRequest($user_from) {
		$user_to = $this->user['username'];
		$check_request_query = mysqli_query($this->connect, "SELECT * FROM friend_req WHERE sent_to='$user_to' AND sent_from='$user_from'");
		if(mysqli_num_rows($check_request_query) > 0) {
			return true;
		}
		else {
			return false;
		}
	}

public function didSendRequest($user_to) {
        $user_from = $this->user['username'];
        $check_request_query = mysqli_query($this->connect, "SELECT * FROM friend_req WHERE sent_to='$user_to' AND sent_from='$user_from'");
        if(mysqli_num_rows($check_request_query) > 0) {
            return true;
        }
        else {
            return false;
        }
    }

public function removeAfriend ($user_to_remove) {
		$logged_in_user = $this->user['username'];

		$query = mysqli_query($this->connect, "SELECT friendnum FROM users WHERE username='$user_to_remove'");
		$row = mysqli_fetch_array($query);
		$friend_array_username = $row['friendnum'];

		$new_friendnum = str_replace($user_to_remove . ",", "", $this->user['friendnum']);
		$remove_friend = mysqli_query($this->connect, "UPDATE users SET friendnum='$new_friendnum' WHERE username='$logged_in_user'");

		$new_friendnum = str_replace($this->user['username'] . ",", "", $friend_array_username);
		$remove_friend = mysqli_query($this->connect, "UPDATE users SET friendnum='$new_friendnum' WHERE username='$user_to_remove'");
	}
	
public function sendAfriendRequest($user_to) {
		$user_from = $this->user['username'];
		$query = mysqli_query($this->connect, "INSERT INTO friend_req VALUES('', '$user_to', '$user_from')");
	}

public function getFriendnum() {
		$username = $this->user['username'];
		$query = mysqli_query($this->connect, "SELECT friendnum FROM users WHERE username='$username'");
		$row = mysqli_fetch_array($query);
		return $row['friendnum'];
	}


}
?>
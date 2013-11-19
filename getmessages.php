<?php
// create connection
$con = mysqli_connect("localhost", "admin", "admin", "2nd_classroom_db");

//check connection
if(mysqli_connect_errno($con)) {
	//echo "Failed to connect to MySQL: " . mysqli_connect_error();
} else {

	//get username and initialize a new empty array to return
	$username = $_GET["username"];
	$result = array();
	
	//grab the courses that $username is taking
	$content = mysqli_query($con, "SELECT MESSAGES.message_id, MESSAGES.subject, MESSAGES.time, USERS.first_name, USERS.last_name FROM MESSAGES, USERS WHERE MESSAGES.recipient = '$username' and MESSAGES.sender = USERS.username");

	
	if(!$content) {
			echo "bad query";
		} else if(mysqli_num_rows($content) > 0) {
			
			while($row = mysqli_fetch_array($content)) {
				$sender = $row["first_name"]." ".$row["last_name"];
				$time = $row["time"];
				//create array for this course
				$arr = array('message_id' => $row["message_id"], 'subject' => $row["subject"], 'sender' =>$sender, 'time' => $time);
			
				//push this array into the result
				array_push($result, $arr);
			}

			//encode the array in javascript format
			echo json_encode($result);
		}
}

?>
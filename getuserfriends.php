<?php
session_start();
// create connection
$con = mysqli_connect("localhost", "admin", "admin", "2nd_classroom_db");


//check connection
if(mysqli_connect_errno($con)) {
	//echo "Failed to connect to MySQL: " . mysqli_connect_error();
} else {

	//get username and initialize a new empty array to return
	$username = $_SESSION["username"];
	$result = array();
	
	//grab the courses that $username is taking
	$content = mysqli_query($con, "SELECT USERS.first_name, USERS.last_name, USERS.username 
								   FROM FRIENDS, USERS
								   WHERE FRIENDS.username = '$username' and FRIENDS.friendname = USERS.username");

	
	if(!$content) {
		echo "bad query";
	} else if(mysqli_num_rows($content) > 0) {
			
		while($row = mysqli_fetch_array($content)) {

			//createa array for this course
			$arr = array('name' => $row["first_name"]." ".$row["last_name"],
						 'username' => $row["username"]
						 );
			
			//push this array into the result
			array_push($result, $arr);
		}

		//encode the array in javascript format
		echo json_encode($result);		
	}
}

?>
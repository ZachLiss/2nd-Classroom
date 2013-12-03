<?php
// create connection
$con = mysqli_connect("localhost", "admin", "admin", "2nd_classroom_db");

//check connection
if(mysqli_connect_errno($con)) {
	//echo "Failed to connect to MySQL: " . mysqli_connect_error();
} else {

	//get username and initialize a new empty array to return
	$user = $_GET["user"];
	
	//grab the courses that $username is taking
	$content = mysqli_query($con, "SELECT *
								   FROM USERS
								   WHERE username = '$user'");

	
	if(!$content) {
		echo "bad query";
	} else if(mysqli_num_rows($content) > 0) {
		
		$row = mysqli_fetch_array($content);

		//createa array for this course
		$result = array('first_name' => $row["first_name"], 
						'last_name' => $row["last_name"],
		 				'email' => $row["email"],
						'username' =>$row["username"]);
			
		//encode the array in javascript format
		echo json_encode($result);
	}
}
// group_name course_num course_name creator location time
?>
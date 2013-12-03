<?php
// create connection
$con = mysqli_connect("localhost", "admin", "admin", "2nd_classroom_db");

//check connection
if(mysqli_connect_errno($con)) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
} else {

	//get username and initialize a new empty array to return
	$user = $_GET["user"];
	$friend = $_GET["friend"];
	
	//grab the courses that $username is taking
	$content = mysqli_query($con, "INSERT INTO FRIENDS (username, friendname) VALUES ('$user', '$friend')" );
	echo $user.$friend."success";
}
// group_name course_num course_name creator location time
?>
<?php
// create connection
$con = mysqli_connect("localhost", "root", "root", "2nd_classroom_db");

//check connection
if(mysqli_connect_errno($con)) {
	//echo "Failed to connect to MySQL: " . mysqli_connect_error();
} else {

	$username = $_GET["username"];
	$course_id = $_GET["course_id"];

	echo "username: $username <br>";
	echo "course_id: $course_id <br>";
	
	//have username join course_num
	$content = mysqli_query($con, "INSERT INTO COURSES_TAKEN VALUES ('$username', $course_id)");


		if(!$content) {
			echo "bad query";
		} else {
			echo "course joined!";
		}

}

?>
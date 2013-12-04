<?php
session_start();
$con = mysqli_connect("localhost", "admin", "admin", "2nd_classroom_db");
if(mysqli_connect_errno($con)) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
} else {

	$poster = $_SESSION["username"];
	$title = $_GET["title"];
	$note = $_GET["note"];
	$course_id = $_GET["course_id"];
	//find if class exists
	$content = mysqli_query($con, "INSERT INTO NOTES (user, title, note, course_id ) VALUES ('$poster', '$title', '$note', '$group_id')");
	}

?>

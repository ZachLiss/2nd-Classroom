<?php
session_start();
$con = mysqli_connect("localhost", "admin", "admin", "2nd_classroom_db");
if(mysqli_connect_errno($con)) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
} else {

	$title = $_GET["title"];
	$subject = $_GET["subject"];
	$group_id = $_GET["group_id"];
	//find if class exists
	$content = mysqli_query($con, "INSERT INTO THREADS (title, subject, thread_id, group_id ) VALUES ('$title', '$subject', '$thread_id ', '$group_id')");
	}

?>

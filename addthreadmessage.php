<?php
session_start();
$con = mysqli_connect("localhost", "admin", "admin", "2nd_classroom_db");
if(mysqli_connect_errno($con)) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
} else {

	$username = $_GET["username"];
	$thread_id = $_GET["thread_id"];
	$text = $_GET["content"];
	//find if class exists
	$content = mysqli_query($con, "INSERT INTO THREADMESSAGES (thread_id, content, username) VALUES ('$thread_id', '$text', '$username')");
	}

?>

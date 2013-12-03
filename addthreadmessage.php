<?php
session_start();
$con = mysqli_connect("localhost", "admin", "admin", "2nd_classroom_db");
if(mysqli_connect_errno($con)) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
} else {

	//$username = $_SESSION["pel37"];
	$thread_id = $_GET["thread_id"];
	$text = $_GET["content"];
	//find if class exists
	$content = mysqli_query($con, "INSERT INTO THREADMESSAGES (thread_id, content) VALUES ('$thread_id', '$text')");
	}

?>

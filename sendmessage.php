<?php
session_start();
// create connection
$con = mysqli_connect("localhost", "admin", "admin", "2nd_classroom_db");
//check connection
if(mysqli_connect_errno($con)) {
	//echo "Failed to connect to MySQL: " . mysqli_connect_error();
} else {

	$sender = $_SESSION["username"];
	$subject = $_GET["subject"];
	$message = $_GET["message"];
	$recipient = $_GET["recipient"];
	//find if class exists
	$content = mysqli_query($con, "INSERT INTO MESSAGES (sender, recipient, subject, message) VALUES ('$sender', '$recipient', '$subject', '$message')");
	}

?>
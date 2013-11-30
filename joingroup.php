<?php
// create connection
$con = mysqli_connect("localhost", "admin", "admin", "2nd_classroom_db");

//check connection
if(mysqli_connect_errno($con)) {
	//echo "Failed to connect to MySQL: " . mysqli_connect_error();
} else {

	$username = $_GET["username"];
	$group_id = $_GET["gid"];

	echo "username: $username <br>";
	echo "group_id: $group_id <br>";
	
	//have username join course_num
	$content = mysqli_query($con, "INSERT INTO GROUPS_JOINED VALUES ('$username', $group_id)");


		if(!$content) {
			echo "bad query";
		} else {
			echo "group joined!";
		}

}

?>
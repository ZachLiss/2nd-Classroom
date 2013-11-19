<?php
// create connection
$con = mysqli_connect("localhost", "root", "root", "2nd_classroom_db");

//check connection
if(mysqli_connect_errno($con)) {
	//echo "Failed to connect to MySQL: " . mysqli_connect_error();
} else {

	$username = $_GET["username"];
	$group_id = $_GET["group_name"];
	$course_id =$_GET["course_id"];
	$location = $_GET["creator"];
	$time = $_GET["time"];

	//check if group exists in course
	$content = mysqli_query($con, "SELECT *
								   FROM (SELECT course_id
								   		 FROM groups_joined
								   		 WHERE group_name = '$group_name')");


	if($content) {
			echo "Group already exists in course $course_id";

		} else {
			$SQL = "INSERT INTO GROUPS (group_name, course_id, creator, location, time) VALUES ($group_name, $course_id, $username, $location, $time)";
			$content = mysqli_query($con, "Select group_id
											FROM GROUPS
											WHERE group_name = '$group_name'")

			$row=mysqli_fetch_array($content);
			$SQL = "INSERT INTO GROUPS_JOINED (group_id, username) VALUES ($row[group_id], $username)";
			echo "Course $group_name added to the database and joined."

			}
		}
}

?>

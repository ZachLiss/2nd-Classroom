<?php
// create connection
$con = mysqli_connect("localhost", "admin", "admin", "2nd_classroom_db");

//check connection
if(mysqli_connect_errno($con)) {
	//echo "Failed to connect to MySQL: " . mysqli_connect_error();
} else {

	$username = $_GET["username"];
	$group_name = $_GET["group_name"];
	$course_id =$_GET["course_id"];
	$location = $_GET["location"];
	$creator = $_GET["creator"];
	$description = $_GET["description"];
	$time = $_GET["time"];

	// //check if group exists in course
	// $content = mysqli_query($con, "SELECT *
	// 							   FROM (SELECT course_id
	// 							   		 FROM groups_joined
	// 							   		 WHERE group_name = '$group_name')");


	// if(mysqli_num_rows($content) > 0) {
	// 	//echo "Group already exists in course $course_id";

	// } else {
		$SQL = "INSERT INTO GROUPS (group_name, course_id, creator, location, start_time, description) VALUES ('$group_name', $course_id, '$username', '$location', '$time', '$description')";
		$content = mysqli_query($con, $SQL);

		$content = mysqli_query($con, "Select group_id
											FROM GROUPS
											WHERE group_name = '$group_name'");

		$row=mysqli_fetch_array($content);
		$SQL = "INSERT INTO GROUPS_JOINED (group_id, username) VALUES ($row[group_id], '$username')";
		$content = mysqli_query($con, $SQL);
		//echo "Course $group_name added to the database and joined."
	//}

	$result = array('group_id' => $row["group_id"]);

	echo json_encode($result);
	
}

?>

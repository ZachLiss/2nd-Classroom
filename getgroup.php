<?php
// create connection
$con = mysqli_connect("localhost", "admin", "admin", "2nd_classroom_db");

//check connection
if(mysqli_connect_errno($con)) {
	//echo "Failed to connect to MySQL: " . mysqli_connect_error();
} else {

	//get username and initialize a new empty array to return
	$gid = $_GET["gid"];
	
	//grab the courses that $username is taking
	$content = mysqli_query($con, "SELECT c.course_num, c.course_name, g.creator, g.location, g.time, g.group_name, g.description
								   FROM GROUPS g JOIN COURSES c ON g.course_id = c.course_id
								   WHERE group_id = $gid");

	
	if(!$content) {
		echo "bad query";
	} else if(mysqli_num_rows($content) > 0) {
		
		$row = mysqli_fetch_array($content);

		//createa array for this course
		$result = array('group_name' => $row["group_name"], 
						'course_num' => $row["course_num"],
		 				'course_name' => $row["course_name"],
		 				'description' => $row["description"], 
		 				'location' => $row["location"], 
		 				'time' => $row["time"]);
			
		//encode the array in javascript format
		echo json_encode($result);
	}
}
// group_name course_num course_name creator location time
?>
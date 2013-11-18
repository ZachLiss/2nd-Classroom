<?php
// create connection
$con = mysqli_connect("localhost", "root", "root", "2nd_classroom_db");

//check connection
if(mysqli_connect_errno($con)) {
	//echo "Failed to connect to MySQL: " . mysqli_connect_error();
} else {

	//get username and initialize a new empty array to return
	$cid = $_GET["cid"];
	
	//grab the courses that $username is taking
	$content = mysqli_query($con, "SELECT * 
								   FROM COURSES
								   WHERE course_id = $cid");

	
	if(!$content) {
		echo "bad query";
	} else if(mysqli_num_rows($content) > 0) {
		
		$row = mysqli_fetch_array($content);

		//createa array for this course
		$result = array('course_num' => $row["course_num"], 'course_name' => $row["course_name"]);
			
		//encode the array in javascript format
		echo json_encode($result);
	}
}

?>
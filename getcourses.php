<?php
// create connection
$con = mysqli_connect("localhost", "root", "root", "2nd_classroom_db");

//check connection
if(mysqli_connect_errno($con)) {
	//echo "Failed to connect to MySQL: " . mysqli_connect_error();
} else {

	//get username and initialize a new empty array to return
	$username = $_GET["username"];
	$result = array();
	
	//grab the courses that $username is taking
	$content = mysqli_query($con, "SELECT * 
								   FROM (SELECT course_id 
								   		 FROM courses_taken 
								   		 WHERE username = '$username') c natural join courses");

	
	if(!$content) {
			echo "bad query";
		} else if(mysqli_num_rows($content) > 0) {
			
			while($row = mysqli_fetch_array($content)) {

				//createa array for this course
				$arr = array('course_num' => $row["course_num"], 'course_name' => $row["course_name"]);
			
				//push this array into the result
				array_push($result, $arr);
			}

			//encode the array in javascript format
			echo json_encode($result);
		}
}

?>



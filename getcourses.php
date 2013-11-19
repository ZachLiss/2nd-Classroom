<?php
// create connection
<<<<<<< HEAD
$con = mysqli_connect("localhost", "admin", "admin", "2nd_classroom_db");
=======
<<<<<<< HEAD
$con = mysqli_connect("localhost", "admin", "admin", "2nd_classroom_db");

=======
$con = mysqli_connect("localhost", "SavitC", "icy-gut", "SavitC");
>>>>>>> ae3c4dda9bb8ddf2eea30eab801c0172e2d41a38
>>>>>>> refs/heads/master

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
								   		 FROM COURSES_TAKEN 
								   		 WHERE username = '$username') c natural join COURSES");

	
	if(!$content) {
			echo "bad query";
		} else if(mysqli_num_rows($content) > 0) {
			
<<<<<<< HEAD
		while($row = mysqli_fetch_array($content)) {
=======
			while($row = mysqli_fetch_array($content)) {
>>>>>>> ae3c4dda9bb8ddf2eea30eab801c0172e2d41a38

				//createa array for this course
				$arr = array('course_num' => $row["course_num"], 'course_name' => $row["course_name"]);
			
				//push this array into the result
				array_push($result, $arr);
			}

<<<<<<< HEAD
		//encode the array in javascript format
		echo json_encode($result);		
	}
=======
			//encode the array in javascript format
			echo json_encode($result);
		}
>>>>>>> ae3c4dda9bb8ddf2eea30eab801c0172e2d41a38
}

?>



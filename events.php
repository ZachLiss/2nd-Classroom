<?php
session_start();
$con = mysqli_connect("localhost", "admin", "admin", "2nd_classroom_db");
//check connection
if(mysqli_connect_errno($con)) {
	//echo "Failed to connect to MySQL: " . mysqli_connect_error();
} else {

	//get username and initialize a new empty array to return
	$username = $_SESSION["username"];
	$result = array();
	
	//grab the courses that $username is taking
	$content = mysqli_query($con, "SELECT * 
								   FROM (SELECT course_id 
								   		 FROM COURSES_TAKEN
								   		 WHERE username = '$username') c NATURAL JOIN COURSES");

	
	if(!$content) {
		echo "bad query";
	} else if(mysqli_num_rows($content) > 0) {
			
		while($row = mysqli_fetch_array($content)) {
			$start_date = strtotime($row["start_time"]);
			$end_date = strtotime($row["end_time"]);
			//createa array for this course
			$arr = array('id' => $row["course_id"],
						 'title' => $row["course_name"],
						 'start' => $start_date,
						 'end' => $end_date,
						 'allDay' => false
						 );
			//push this array into the result
			array_push($result, $arr);

			for ( $i = 1; $i<9; $i++){
				$start_date= strtotime('+1 week', $start_date);
				$end_date= strtotime('+1 week', $end_date);
				$arr = array('id' => $row["course_id"],
						 	 'title' => $row["course_name"],
							 'start' => $start_date,
							 'end' => $end_date,
							 'allDay' => false
							 );
			
				//push this array into the result
				array_push($result, $arr);
			}
		}

		//encode the array in javascript format
		echo json_encode($result);		
	}
}

?>



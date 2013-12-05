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
								   FROM (SELECT group_id 
								   		 FROM GROUPS_JOINED
								   		 WHERE username = '$username') c NATURAL JOIN GROUPS");

	
	if(!$content) {
		echo "bad query";
	} else if(mysqli_num_rows($content) > 0) {
			date_default_timezone_set('America/New_York');
		while($row = mysqli_fetch_array($content)) {
			$start_date = strtotime($row["start_time"]);
			$end_date = strtotime($row["end_time"]);
			//createa array for this course
			$arr = array('id' => $row["group_id"],
						 'title' => $row["group_name"],
						 'start' => $start_date,
						 'end' => $end_date,
						 'allDay' => false
						 );
			//push this array into the result
			array_push($result, $arr);
		}

		//encode the array in javascript format
		echo json_encode($result);		
	}
}

?>
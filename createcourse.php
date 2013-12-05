<?php
// create connection
$con = mysqli_connect("localhost", "admin", "admin", "2nd_classroom_db");

//check connection
if(mysqli_connect_errno($con)) {
	//echo "Failed to connect to MySQL: " . mysqli_connect_error();
} else {

	$username = $_GET["username"];
	$course_num = $_GET["course_num"];
	$course_name = $_GET["course_name"];
	$instructor = $_GET["instructor"];
	$ta = $_GET["ta"];
	$location = $_GET["location"];
	$start_time = $_GET["start_time"];
	$end_time = $_GET["end_time"];
	$days = $_GET["days"];
	//find if class exists
	$content = mysqli_query($con, "SELECT *
								   FROM COURSES
								   WHERE course_num = '$course_num'");


								   // (SELECT course_num
								   // 		 FROM COURSES
								   // 		 WHERE course_num = '$course_num')");


	if(mysqli_num_rows($content) > 0) {
		//echo "Course already exists.";
		//echo "$content";

		$row = mysqli_fetch_array($content);
		$result = array('course_id' => $row["course_id"]);
		echo json_encode($result);
	} else {

		$SQL = "INSERT INTO COURSES (course_num, course_name, instructor, ta, location, start_time, end_time, days) VALUES ('$course_num', '$course_name', '$instructor', '$ta', '$location', '$start_time', '$end_time', '$days')";
		//echo $SQL;

		$content = mysqli_query($con, $SQL);

		$content = mysqli_query($con, "Select course_id
											FROM COURSES
											WHERE course_num = '$course_num'");

		$row=mysqli_fetch_array($content);
		$SQL = "INSERT INTO COURSES_TAKEN (course_id, username) VALUES ($row[course_id], '$username')";

		$content = mysqli_query($con, $SQL);
		//echo "Course $course_name added to the database and joined.";

		$result = array('course_id' => $row["course_id"]);

		echo json_encode($result);
	}
}

?>

<?php
// create connection
$con = mysqli_connect("localhost", "root", "root", "2nd_classroom_db");

//check connection
if(mysqli_connect_errno($con)) {
	//echo "Failed to connect to MySQL: " . mysqli_connect_error();
} else {

	$username = $_GET["username"];
	$course_num = $_GET["course_num"]
	$course_name = $_GET["course_name"];
	$instructor = $_GET["instructor"];
	$ta = $_GET["ta"];
	$location = $_GET["location"];
	$time = $_GET["time"];
	//find if class exists
	$content = mysqli_query($con, "SELECT *
								   FROM (SELECT course_num
								   		 FROM COURSES
								   		 WHERE course_num = '$course_num')");


	if($content) {
			echo "Course already exists.";
			echo "$content";
		} else {
			$SQL = "INSERT INTO COURSES (course_num, course_name, instructor, ta, location, time) VALUES ($course_num, $course_name, $instructor, $ta, $location, $time)";

			$content = mysqli_query($con, "Select course_id
											FROM COURSES
											WHERE course_num = '$course_num'")

			$row=mysqli_fetch_array($content);
			$SQL = "INSERT INTO COURSES_TAKEN (course_id, username) VALUES ($row[course_id], $username)";
			echo "Course $course_name added to the database and joined."
			}
		}
}

?>

<?php
// create connection
$con = mysqli_connect("localhost", "root", "root", "2nd_classroom_db");

//check connection
if(mysqli_connect_errno($con)) {
	//echo "Failed to connect to MySQL: " . mysqli_connect_error();
} else {

	$q = $_GET["q"];
	$qlen = strlen($q);

	//search for results in db
	if($qlen > 0) {

		//get results form COURSES
		$content = mysqli_query($con, "SELECT * 
									   FROM COURSES 
									   WHERE course_num LIKE '%$q%' OR course_name LIKE '%$q%'");


		if(!$content) {
			echo "bad query";
		} else if(mysqli_num_rows($content) > 0) {
			echo "<h3>Courses:</h3>";
			while($row = mysqli_fetch_array($content)) {
				echo "<p>$row[course_num] $row[course_name]</p>";
			}
		}

		//get results from USERS
		$content = mysqli_query($con, "SELECT *
									   FROM USERS
									   WHERE first_name LIKE '%$q%' 
									   OR last_name LIKE '%$q%'
									   OR concat(first_name, ' ', last_name) LIKE '%$q%'");

		if(!$content) {
			echo "bad query";
		} else if(mysqli_num_rows($content) > 0) {
			echo "<h3>Users:</h3>";
			while($row = mysqli_fetch_array($content)) {
				echo "<p>$row[first_name] $row[last_name]</p>";
			}
		}

	}
}

?>
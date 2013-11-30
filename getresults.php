<?php
// create connection
$con = mysqli_connect("localhost", "admin", "admin", "2nd_classroom_db");

//check connection
if(mysqli_connect_errno($con)) {
	//echo "Failed to connect to MySQL: " . mysqli_connect_error();
} else {

	$q = $_GET["q"];
	$username = $_GET["username"];
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
			echo "<table>";
			while($row = mysqli_fetch_array($content)) {
				$c1 = mysqli_query($con, "SELECT *
										  FROM COURSES_TAKEN
										  WHERE username='$username' AND course_id=$row[course_id]");
				
				$num_rows = mysqli_num_rows($c1);

				echo "<tr>";
				if($num_rows == 0) {
					//student not taking the course
					echo "<td>$row[course_num]</td>";
					echo "<td>$row[course_name]</td>";
					echo "<td><button class=\"join_course small blue\" value=\"$row[course_id]\">Join Course</button></td>";
				} else {
					//student is taking the course
					echo "<td>$row[course_num]</td>";
					echo "<td>$row[course_name]</td>";
					echo "<td><button class=\"view_course small blue\" value=\"$row[course_id]\">View Course</button></td>";
				}
				echo "</tr>";
				
			}
			echo "<tr><td>Couldn't find your course?</td><td><button class=\"create_course small blue\">Create Course</button></td></tr>";
			echo "</table>";
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
			echo "<table>";
			while($row = mysqli_fetch_array($content)) {
				echo "<tr>";
				echo "<td>$row[first_name] $row[last_name]</td>";
				echo "<td>$row[email]</td>";
				echo "<td><button class=\"view_user small blue\" value=\"$row[username]\">View User</button></td>";
				echo "</tr>";
			}
			echo "</table>";
		}

	}
}

?>
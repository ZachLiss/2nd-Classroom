<?php
// create connection
$con = mysqli_connect("localhost", "admin", "admin", "2nd_classroom_db");

//check connection
if(mysqli_connect_errno($con)) {
	//echo "Failed to connect to MySQL: " . mysqli_connect_error();
} else {
	$cid = $_GET["cid"];
	$username = $_GET["username"];
	
	//have username drop course_num
	$content = mysqli_query($con, "SELECT * 
								   FROM (SELECT *
								   		 FROM COURSES_TAKEN ct NATURAL JOIN USERS u
								   		 WHERE course_id = $cid) as all_users");


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
/// group_id group_name course_id creator location time
?>
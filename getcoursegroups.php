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
								   FROM GROUPS
								   WHERE course_id = '$cid'");


	if(!$content) {
		echo "bad query";
	} else { //if(mysqli_num_rows($content) > 0) {
		echo "<h3>Groups:</h3>";
		echo "<table>";
		while($row = mysqli_fetch_array($content)) {
			$c1 = mysqli_query($con, "SELECT *
									  FROM GROUPS_JOINED
									  WHERE username='$username' AND group_id=$row[group_id]");
			$num_rows = mysqli_num_rows($c1);

			if($num_rows == 0) {
				//student is not in the group
				echo "<tr>";
				echo "<td>$row[group_name]</td>";
				echo "<td>$row[location]</td>";
				echo "<td>$row[start_time]</td>";
				echo "<td>$row[creator]</td>";
				echo "<td><button class=\"join_group  small blue\" value=\"$row[group_id]\">Join Group</button></td>";
				echo "</tr>";
			} else {
				//student is in the group
				echo "<tr>";
				echo "<td>$row[group_name]</td>";
				echo "<td>$row[location]</td>";
				echo "<td>$row[start_time]</td>";
				echo "<td>$row[creator]</td>";
				echo "<td><button class=\"view_group small blue\" value=\"$row[group_id]\">View Group</button></td>";
				echo "</tr>";
			}
			echo "<tr><td>--$row[description]</td></tr>";
			
		}
		echo "<tr><td>Don't like these groups?</td><td><button class=\"create_group small blue\">Create Group</button></td></tr>";
		echo "</table>";
	}
}
/// group_id group_name course_id creator location time
?>
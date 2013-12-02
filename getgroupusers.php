<?php
// create connection
$con = mysqli_connect("localhost", "admin", "admin", "2nd_classroom_db");

//check connection
if(mysqli_connect_errno($con)) {
	//echo "Failed to connect to MySQL: " . mysqli_connect_error();
} else {
	$gid = $_GET["gid"];
	$username = $_GET["username"];
	
	//have username drop course_num
	$content = mysqli_query($con, "SELECT * 
								   FROM (SELECT *
								   		 FROM GROUPS_JOINED ct NATURAL JOIN USERS u
								   		 WHERE group_id = $gid) as all_users");

	$result = array();

	if(!$content) {
		echo "bad query";
	} else if(mysqli_num_rows($content) > 0) {
		// echo "<h3>Users:</h3>";
		// echo "<table>";
		while($row = mysqli_fetch_array($content)) {
			// echo "<tr>";
			// echo "<td>$row[first_name] $row[last_name]</td>";
			// echo "<td>$row[email]</td>";
			// echo "<td><button class=\"view_user small blue\" value=\"$row[username]\">View User</button></td>";
			// echo "</tr>";
			
			$arr = array('first_name' => $row["first_name"], 'last_name' => $row["last_name"], 'email' => $row["email"], 'username' => $row["username"]);

			array_push($result, $arr);
		}

		echo json_encode($result);
		//echo "</table>";
	}
}
/// group_id group_name course_id creator location time
?>
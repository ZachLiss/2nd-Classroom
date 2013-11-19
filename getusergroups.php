<?php
// create connection
$con = mysqli_connect("localhost", "admin", "admin", "2nd_classroom_db");

//check connection
if(mysqli_connect_errno($con)) {
	//echo "Failed to connect to MySQL: " . mysqli_connect_error();
} else {

	$username = $_GET["username"];
	$result = array();

	echo "username: $username <br>";
	
	//have username drop course_num
	$content = mysqli_query($con, "SELECT * 
								   FROM (SELECT group_id 
								   		 FROM groups_joined 
								   		 WHERE username = '$username') g natural join groups");


	if(!$content) {
		echo "bad query";
	} else if(mysqli_num_rows($content) > 0) {
		//echo "<h3>Groups:</h3>";
		while($row = mysqli_fetch_array($content)) {
		//	echo "<p>$row[group_name] $row[creator]</p>";
			$arr = array('group_id' => $row["group_id"]);

			//push this array into the result
			array_push($result, $arr);
		}

		echo json_encode($result);
	}
}
/// group_id group_name course_id creator location time
?>
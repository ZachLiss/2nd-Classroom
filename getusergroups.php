<?php
// create connection
$con = mysqli_connect("localhost", "admin", "admin", "2nd_classroom_db");

//check connection
if(mysqli_connect_errno($con)) {
	//echo "Failed to connect to MySQL: " . mysqli_connect_error();
} else {

	$username = $_GET["username"];
	$result = array();
	
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
			$c1 = mysqli_query($con, "SELECT *
									  FROM GROUPS_JOINED
									  WHERE username='$username' AND group_id=$row[group_id]");
			$num_rows = mysqli_num_rows($c1);

			if($num_rows == 0) {
				//student is not in the group
				$arr = array('group_id' => $row["group_id"],
						'group_name' => $row["group_name"], 
						//'course_num' => $row["course_num"],
		 				//'course_name' => $row["course_name"],
		 				'creator' => $row["creator"], 
		 				'location' => $row["location"], 
		 				'time' => $row["time"],
		 				'in_group' => "false");
			} else {
				//student is in the group
				$arr = array('group_id' => $row["group_id"],
						'group_name' => $row["group_name"], 
						//'course_num' => $row["course_num"],
		 				//'course_name' => $row["course_name"],
		 				'creator' => $row["creator"], 
		 				'location' => $row["location"], 
		 				'time' => $row["time"],
		 				'in_group' => "true");
			}







			//push this array into the result
			array_push($result, $arr);
		}

		echo json_encode($result);
	}
}
/// group_id group_name course_id creator location time
?>
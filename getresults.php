<?php
// create connection
$con = mysqli_connect("localhost", "root", "root", "2nd_classroom_db");

//check connection
if(mysqli_connect_errno($con)) {
	//echo "Failed to connect to MySQL: " . mysqli_connect_error();
} else {

	// $content = mysqli_query($con, "SELECT * FROM USERS");
	// while($row = mysqli_fetch_array($content)) {
	// //	echo "$row[username] --> $row[first_name] $row[last_name] <br>";
	// }

	// $username = 'zll1';
	// $password = 'zach1';

	$q = $_GET["q"];
	$qlen = strlen($q);

	//echo "SELECT * FROM COURSES WHERE course_num LIKE '%$q%'<br>";

	//search for results in db
	if($qlen > 0) {
		$results = "";

		$content = mysqli_query($con, "SELECT * FROM COURSES WHERE course_num LIKE '%$q%'");

		if(!$content) echo "bad query";

		while($row = mysqli_fetch_array($content)) {
		//	echo "Logging $row[first_name] $row[last_name] in<br>";
			//$results += "$row[course_num] $row[course_name] <br>";
			echo "$row[course_num] $row[course_name] <br>";
		}
		//echo "<hr>";
		//echo $results;

	}

	
}

?>
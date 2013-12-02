<?php
// create connection
$con = mysqli_connect("localhost", "admin", "admin", "2nd_classroom_db");

//check connection
if(mysqli_connect_errno($con)) {
	//echo "Failed to connect to MySQL: " . mysqli_connect_error();
} else {

	//get username and initialize a new empty array to return
	$group_id = $_GET["group_id"];
	$result = array();
	
	//grab the courses that $username is taking
	
	$content = mysqli_query($con, "SELECT NOTES.note_id, NOTES.title, NOTES.note, NOTES.time FROM NOTES WHERE NOTES.group_id = '$group_id' ORDER BY time DESC");
	
	



	if(!$content) {
			$arr = array('note_id' => '', 'title' => '', 'poster' =>'', 'time' => '', 'note' => '');
		} else if(mysqli_num_rows($content) > 0) {

			while($row = mysqli_fetch_array($content)) {
				
				$time = $row["time"];
				//create array for this course
				$arr = array('note_id' => $row["note_id"], 'title' => $row["title"], 'time' => $time, 'note' => $row["note"]);

				//push this array into the result
				array_push($result, $arr);
			}

			//encode the array in javascript format

		}
		echo json_encode($result);
}


?>

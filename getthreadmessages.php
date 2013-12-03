<?php
// create connection
$con = mysqli_connect("localhost", "admin", "admin", "2nd_classroom_db");

//check connection
if(mysqli_connect_errno($con)) {
	//echo "Failed to connect to MySQL: " . mysqli_connect_error();
} else {

	//get username and initialize a new empty array to return
	$thread_id = $_GET["thread_id"];
	$result = array();
	
	//grab the courses that $username is taking
	
	$content = mysqli_query($con, "SELECT THREADMESSAGES.username, THREADMESSAGES.message_id, THREADMESSAGES.time, THREADMESSAGES.content FROM THREADMESSAGES WHERE THREADMESSAGES.thread_id = '$thread_id' ORDER BY time ASC");
	
	



	if(!$content) {
			$arr = array('message_id' => '', 'time' => '', 'content' =>'', 'username' => '');
		} else if(mysqli_num_rows($content) > 0) {

			while($row = mysqli_fetch_array($content)) {
				
				$time = $row["time"];
				//create array for this course
				$arr = array('message_id' => $row["message_id"], 'content' => $row["content"], 'time' => $time, 'username' => $row["username"]);

				//push this array into the result
				array_push($result, $arr);
			}

			//encode the array in javascript format

		}
		echo json_encode($result);
}

?>

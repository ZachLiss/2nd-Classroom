<?php
// create connection
$con = mysqli_connect("localhost", "admin", "admin", "2nd_classroom_db");

//check connection
if(mysqli_connect_errno($con)) {
	//echo "Failed to connect to MySQL: " . mysqli_connect_error();
} else {

	
	$group_id = $_GET["group_id"];
	$result = array();

	

	$content = mysqli_query($con, "SELECT THREADS.thread_id, THREADS.title, THREADS.subject FROM THREADS WHERE THREADS.group_id = '$group_id' ORDER BY thread_id DESC");





	if(!$content) {
			$arr = array('thread_id' => '', 'title' => '', 'subject' =>'');
		} else if(mysqli_num_rows($content) > 0) {

			while($row = mysqli_fetch_array($content)) {

				
				//create array for this course
				$arr = array('thread_id' => $row["thread_id"], 'title' => $row["title"], 'subject' => $row["subject"]);

				//push this array into the result
				array_push($result, $arr);
			}

			//encode the array in javascript format

		}
		echo json_encode($result);
}

?>

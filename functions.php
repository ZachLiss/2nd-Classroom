<?php
function get_user( $username ) {

	$db = new mysqli("localhost", "admin", "admin", "2nd_classroom_db") or die("Oooops");
	$result= $db->query("SELECT * FROM USERS WHERE USERS.username='$username'");
	if (!$result) {
   		print "Error - the query could not be executed";
		$error = $db->error;
		print "<p>" . $error . "</p>";
    		exit;
	}
	$num_rows = $result->num_rows;
	if($num_rows == 0){
		return FALSE;
	}
	else{
		$user = $result->fetch_object();
		if($user->password == ''){
			return FALSE;
		}
		else{
			return $user;
		}
	}
}

function sign_up ( $first_name, $last_name, $email, $username, $password){

	$db = new mysqli("localhost", "admin", "admin", "2nd_classroom_db") or die("Oooops");
	$result= $db->query("SELECT * FROM USERS WHERE USERS.username='$username' or USERS.email='$email'");
	if (!$result) {
   		print "Error - the query could not be executed";
		$error = $db->error;
		print "<p>" . $error . "</p>";
    		exit;
	}
	$num_rows = $result->num_rows;
	if($num_rows == 0){ // if no rows, then there is no user with that username or email, so insert.
		$result = $db->query("INSERT into USERS VALUES('$first_name', '$last_name', '$username', '$email', '$password')");
		if (!$result) {
   			print "Error - the query could not be executed";
			$error = $db->error;
			print "<p>" . $error . "</p>";
    			exit;
		}
		$error=0; // 0 means successful add of user.
	}
	else{
		$user = $result->fetch_object();
		if($user->username == $username){
			$error = 1; //1 means duplicate username
		}
		elseif($user->email == $email){
			$error = 2; //2 means duplicate email address
		}
	}
	return $error;
}

function search_courses( $search_val ) {
	$db = new mysqli("localhost", "admin", "admin", "2nd_classroom_db") or die("Oooops");
	$result= $db->query("SELECT course_name FROM COURSES WHERE COURSES.course_num='$search_val'");
	if (!$result) {
   		print "Error - the query could not be executed";
		$error = $db->error;
		print "<p>" . $error . "</p>";
    		exit;
	}
	$num_rows = $result->num_rows;
	if($num_rows == 0){
		return FALSE;
	}
	else{
		$course = $result->fetch_object();

			return $course;
	}
}
?>


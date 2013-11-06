<?php


require_once('functions.php');
session_start();

if( isset($_POST['signin_submit']) ) {
	$result = get_user( $_POST['username']);
	if($result == FALSE){
		header( 'Location: index.php?login_error=true' );
	}

	else if ($result->password != $_POST['password']){
		header( 'Location: index.php?login_error=true' );
	}
	
	else
	{
		
		$_SESSION["first_name"] = $result->fist_name;
		$_SESSION["last_name"] = $result->last_name;
		$_SESSION["username"] = $result->username;
		$_SESSION["password"] = $result->password;
		$_SESSION["email"] = $result->email;
		header( 'Location: home.php' );
	}

}

elseif ( isset($_POST['signup_submit'])){
	$result = sign_up($_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['username'], $_POST['password']);
	if($result == 0){ //successful signup
		$_SESSION["first_name"] = $_POST['first_name'];
		$_SESSION["last_name"] = $_POST['last_name'];
		$_SESSION["username"] = $_POST['username'];
		$_SESSION["password"] = $_POST['password'];
		$_SESSION["email"] = $_POST['email'];
		header( 'Location: home.php' );
	}
	elseif($result== 1) {//username duplicate
		header( 'Location: signup.php?userdup=true' );
	}
		elseif($result== 2) {//email duplicate
		header( 'Location: signup.php?emaildup=true' );
		}
}


else if( isset($_POST['forgot_password']) ) {
	$result = get_user($_POST['username']);
	if($result == FALSE){
		header( 'Location: index.php?forgot_error=true' );
	}
	else
	{
		$email = $result->email;
		mail($email, "2ndClassroom Password Recovery", "Your password is: $result->password", "From: 2ndClassroomStaff");
		echo "Your password has been mailed to you.";
	}
}

else if( isset($_POST['search_submit']) ) {
	$result = search_courses($_POST['search']);
	if ($result == FALSE) {
		header( 'Location: search.php?nocourse=true' );
	}
	else{
		$course_name=$result->course_name;
		header( "Location: search.php?course=$course_name" );

	}
}

?>




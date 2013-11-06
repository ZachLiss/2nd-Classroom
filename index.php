<!DOCTYPE html>
<?php
session_start();
?>
<html>
<head>
	<title>2ndClassroom</title>
	<link href="http://fonts.googleapis.com/css?family=Ubuntu:bold" rel="stylesheet" type="text/css">
	<link href="http://fonts.googleapis.com/css?family=Vollkorn" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="css/style.css"  type="text/css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js">
	</script>
	<script> 
	$(document).ready(function(){
	  $("#notes").click(function(){
	    $("#panel").slideToggle("slow");
	  });
	});
</script>
</head>
<body>

<!--include the header--!>
<?php include 'header.php'; ?>

<?php
	if(isset($_SESSION['maker'])){
		header( 'Location: home.php' );
	}
?>

	<form action = "process.php" method = "post">
</br>
</br>
</br>
</br>
</br>
	<center>
	<table id="login_table" border="0">
	<caption><h1>Sign-In</h1></caption>
	<tr><td align="right"><p>Username:</p></td><td align="left"><input type="text" name="username" size="20"></td><td></td></tr>
	<tr><td align="right"><p>Password:</p></td><td align="left"><input type="password" name="password" size="20"></td><td><button type="submit" name="signin_submit">Sign In</button></td></tr>
	<tr align="left"><td></td><td></td><td><button type="submit" name="forgot_password">Forgot Password?</button></td></tr>
	<tr align="left"><td></td><td></td><td><a href = "signup.php">Sign Up</a></td></tr>
	</table>


	<?php
	if(isset($_GET['login_error'])){
	echo "<p>LOGIN ERROR- Incorrect email and/or password, or account does not exist.</p></br>";
	}
	if(isset($_GET['forgot_error'])){
	echo "<p>FORGOT PASSWORD ERROR- User does not exist. No email sent.</p></br>";
	}
	?>
	</center>
</body>
</html>


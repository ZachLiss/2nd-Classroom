<!DOCTYPE html>
<?php
session_start();
?>
<html>
<head>
	<title>2ndClassroom</title>
	<link href="http://fonts.googleapis.com/css?family=Ubuntu:bold" rel="stylesheet" type="text/css">
	<link href="http://fonts.googleapis.com/css?family=Vollkorn" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="css/kickstart.css"  type="text/css">
	<link rel="stylesheet" href="style.css"  type="text/css">
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
	<div class="container">
	<table id="login_table" border="0">
	<caption><h1>S<span>ign-</span>U<span>p</span></h1></caption
	<tr><td align="right"><p>First Name:</p></td><td align="left"><input type="text" name="first_name" size="20" required></td></tr>
	<tr><td align="right"><p>Last Name:</p></td><td align="left"><input type="text" name="last_name" size="20" required></td></tr>
	<tr><td align="right"><p>Email:</p></td><td align="left"><input type="text" name="email" size="20" required></td></tr>
	<tr><td align="right"><p>Username:</p></td><td align="left"><input type="text" name="username" size="20" required></td></tr>
	<tr><td align="right"><p>Password:</p></td><td align="left"><input type="text" name="password" size="20" required></td></tr>
	<tr><td></td><td align="right"><button class="medium green" type="submit" name="signup_submit">Sign Up</button></td></tr>
	</table>
	</div>


	<?php
	if(isset($_GET['userdup'])){
	echo "<p>This username already exist. Please choose another.</p></br>";
	}
	if(isset($_GET['emaildup'])){
	echo "<p>This email is already associated with an account.</p></br>";
	}
	?>
	</center>
</body>
</html>


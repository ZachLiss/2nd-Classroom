<!DOCTYPE html>
<?php
session_start();
?>
<html>
<head>
	<title>2ndClassroom</title>
	<link href="css/kickstart.css" rel="stylesheet" type="text/css">
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
	if(isset($_SESSION['password'])){
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
	<caption><h1>S<span>ign-</span>I<span>n</span></h1></caption>
	<tr><td><input id="user_in" type="text" name="username" placeholder="Username" required autofocus>
		<input id="pass_in" type="password" name="password" placeholder="Password"></td></tr>
	<tr><td align="right">	<button class="medium green" type="submit" name="signin_submit">Sign In</button>
				<button class="small blue" type="submit" name="forgot_password">Forgot Password?</button></td></tr>
	<tr align="right"><td text-align="right"><a text-align="right" text-size="1em" href="signup.php">Sign Up</a></td></tr>
	</table>
	<?php
	if(isset($_GET['login_error'])){
		echo "<div class='notice error'><i class='icon-remove-sign icon-large'></i> Invalid Login <a href='index.php#close' class='icon-remove'></a></div>";
	}
?>
</div>

	<?php
	if(isset($_GET['forgot_error'])){
	echo "<p>FORGOT PASSWORD ERROR- User does not exist. No email sent.</p></br>";
	}
	?>
	</center>
</body>
</html>


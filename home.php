<?php
session_start();
require_once('functions.php')
?>
<html>
<head>
	<title>2ndClassroom</title>
	<link rel="stylesheet" href="css/kickstart.css"  type="text/css" media="all">
	<link rel="stylesheet" href="style.css"  type="text/css" media="all">
	<link rel="shortcut icon" type="image/ico" href="images/icon.ico">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
   <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css"  type="text/css" media="all">
    <link rel="stylesheet" href="css/timepicker.css"  type="text/css" media="all">
	<script src="js/kickstart.js"></script>
    <script src="init.js"></script>
    <link rel="stylesheet" href="http://arshaw.com/js/fullcalendar-1.6.1/fullcalendar/fullcalendar.css" type="text/css">
    <script src="http://arshaw.com/js/fullcalendar-1.6.1/fullcalendar/fullcalendar.min.js"></script>
    <link rel="stylesheet" href="style.css"  type="text/css" media="all">
    <script src="js/timepicker.js"></script>
	<script>
	$(document).ready(function(){
        localStorage["username"] = '<?php echo $_SESSION['username']; ?>';
        setListeners();  
        userBarReload();
        displayCalendar();
        
        $("#search_txt").keyup(function() {
            $.get("getresults.php?q="+$(this).val()+"&username="+localStorage["username"], function(data, status) {
                $("#results").html(data);
            });
        });  
    });

	</script>
</head>
<body>




<?php include 'header.php'; ?>
</br>
</br>
</br>
</br>
</br>

<?php
$default = "http://www.somewhere.com/homestar.jpg";
$size = 150;
$grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $_SESSION['email'] ) ) ) . "?" . urlencode( $default ) . "&s=" . $size;
?>
<div id="user_bar">
		<center>
		<span class="tooltip-bottom" title="Click to setup or edit your Gravatar image."><a href="https://en.gravatar.com/site/login"><img id= "photo" src="<?php echo $grav_url; ?>" alt="" /></a></span><br>
		</center>
        <div id="user_courses_title">
        <table><caption><h1>COURSES</h1><caption></table>
        </div>
		<div id="user_courses">
			<table id="courses">
			</table>
		</div>
        <div id ="user_groups_title">
        <table><caption><h1>GROUPS</h1><caption></table>
        </div>
		<div id="user_groups">
			<table id="groups">
			</table>
		</div>
</div>

<div id="main">
</div>

</body>
</html>

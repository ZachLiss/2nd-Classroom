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
	<script src="header.js"></script>
	<script>
	$(document).ready(function(){
	localStorage["username"] = '<?php echo $_SESSION['username']; ?>';
                //get the list of courses for the user
                $.get("getusercourses.php?username="+localStorage['username'], function(data, status) {
                		JSON.stringify(data);
                        console.log(data);
                        //parse data into an array
                        var courseArray = JSON.parse(data);
                        
                        var courseList = "<table><caption><h1>COURSES</h1><caption>";

                        console.log(courseArray);
                        courseArray.forEach(function(course) {
                                courseList += "<tr><td>" + course["course_num"]+": ";
                                courseList += course["course_name"] + "</td></tr>";
                        });
                        courseList+="</table>"
                        
                        $("#user_courses").html(courseList);
                });
setNavigation();
$("#main").load("calendar.php");

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
		<img id= "photo" src="<?php echo $grav_url; ?>" alt="" /><br>
		</center>
		<div id="user_courses">
			<table id="courses">
			</table>
		</div>

		<div id="user_groups">
			<table>
			<caption><h1>GROUPS</h1></caption>
			<tr><td>
			<ul>
				<li>CS1520: Midterm Review</li>
			</ul>
			</td></tr>
			</table>
		</div>
</div>

<div id="main">
</div>

</body>
</html>

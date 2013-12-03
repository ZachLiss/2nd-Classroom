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
	<script src="js/kickstart.js"></script>
        <script src="init.js"></script>
	<script src="header.js"></script>

	<script>
	$(document).ready(function(){
	   localStorage["username"] = '<?php echo $_SESSION['username']; ?>';
        //get the list of courses for the user
        $.get("getusercourses.php?username="+localStorage['username'], function(data, status) {
            JSON.stringify(data);
            //console.log(data);
            //parse data into an array
            var courseArray = JSON.parse(data);
                        
            var courseList = "<table>";

            console.log(courseArray);
            courseArray.forEach(function(course) {
                courseList += "<tr><td><a class=\"view_course\" value=\""+course["course_id"]+"\">" + course["course_num"]+": ";
                courseList += course["course_name"] + "</a></td></tr>";
            });
            courseList+="</table>";
                        
            $("#user_courses").html(courseList);
        });

        $.get("getusergroups.php?username="+localStorage['username'], function(data, status) {
            JSON.stringify(data);
            console.log(data);
            //parse data into an array
            var groupArray = JSON.parse(data);
                        
            var groupList = "<table>";

            console.log(groupArray);
            groupArray.forEach(function(group) {
                groupList += "<tr><td><a class=\"view_group\" value=\""+group["group_id"]+"\">";
                groupList += group["group_name"] + "</a></td></tr>";
            });
            groupList+="</table>";
                        
            $("#user_groups").html(groupList);
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


$(document).ready(function(){
	//this is only for testing...
	localStorage["username"] = "zll1";

	setListeners();

  	$("#search_txt").keyup(function() {
  		$.get("getresults.php?q="+$(this).val()+"&username="+localStorage["username"], function(data, status) {
  			$("#results").html(data);
  			setListeners();
  		});
  	});
});

function setListeners() {
   // console.log("setting listeners");
	$(".join_course").click(function() {
        joinCourse($(this).val());
    });

    $(".join_group").click(function() {
        joinGroup($(this).val());
    });

    $(".view_course").click(function() {
        viewCourse($(this).val());
    });

    $(".view_group").click(function() {
        console.log("trying to view group gid: "+$(this).val());
        viewGroup($(this).val());
    });

    $(".view_user").click(function() {
        viewUser($(this).val());
    });
}

function joinCourse(cid) {
	console.log("joining course cid: "+cid);
    $.get("joincourse.php?cid="+cid+"&username="+localStorage["username"]);
    viewCourse(cid);
}

function joinGroup(gid) {
    console.log("joining group gid: "+gid);
    $.get("joingroup.php?gid="+gid+"&username="+localStorage["username"]);
    viewGroup(gid);
}

function viewCourse(cid) {
    //console.log("viewing course cid: "+cid);
  
    $.get("getcourse.php?cid="+cid+"&username="+localStorage["username"], function(data,status) {
        var courseArray = JSON.parse(data);
        var courseData = "<h2>"+courseArray["course_num"]+" "+courseArray["course_name"]+"</h2>";
        courseData += "<p>"+courseArray["instructor"]+"</p>";
        courseData += "<p>"+courseArray["location"]+"</p>";
        courseData += "<p>"+courseArray["time"]+"</p>";
        $("#titlespan").html(courseData);
        setListeners();
    });

    $.get("getcoursegroups.php?cid="+cid+"&username="+localStorage["username"], function(data,status) {
        $("#groupspan").html(data);
        setListeners();
    });

    $.get("getcourseusers.php?cid="+cid+"&username="+localStorage["username"], function(data,status) {
        $("#userspan").html(data);
        setListeners();
    });
}

function viewGroup(gid) {
    console.log("view group gid: "+gid);

    $.get("getgroup.php?gid="+gid, function(data,status) {
        var groupArray = JSON.parse(data);
        console.log(groupArray);
        var groupData = "<h2>"+groupArray["group_name"]+"</h2>";
        groupData += "<p>"+groupArray["course_num"]+" "+groupArray["course_name"]+"<p>";
        groupData += "<p>"+groupArray["creator"]+"</p>";
        groupData += "<p>"+groupArray["location"]+"</p>";
        groupData += "<p>"+groupArray["time"]+"</p>";
        $("#gtitlespan").html(groupData);
    });
}


function viewUser(username) {
	console.log("viewing user username: "+username);

    $.get("getuser.php?user="+username, function(data, status) {
        var userArray = JSON.parse(data);
        var userData = "<h2>"+userArray["first_name"]+" "+userArray["last_name"]+"</h2>";
        userData += "<p>Email: "+userArray["email"]+"</p>";
        $("#utitlespan").html(userData);
    });

    $.get("getusercourses.php?username="+username, function(data, status) {
        var userArray = JSON.parse(data);
        //console.log(userArray);
        var userData = "<h3>Courses</h3>";
        userData += "<table>";
        userArray.forEach(function(course) {
            console.log(course["course_name"]);
            userData += "<tr>";
            userData += "<td>"+course["course_num"]+"</td>";
            userData += "<td>"+course["course_name"]+"</td>";
            userData += "<td>"+course["location"]+"</td>";
            userData += "<td>"+course["time"]+"</td>";
            userData += "</tr>";
        });
        userData += "</table>";
        $("#ucoursesspan").html(userData);
        setListeners();
    });

    $.get("getusergroups.php?username="+username, function(data, status) {
        var userArray = JSON.parse(data);
        //console.log(userArray);
        var userData = "<h3>Groups</h3>";
        userData += "<table>";
        userArray.forEach(function(group) {
      //      console.log(course["course_name"]);
            userData += "<tr>";
            userData += "<td>"+group["group_name"]+"</td>";
           // userData += "<td>"+group["course_num"]+"</td>";
            //userData += "<td>"+group["course_name"]+"</td>";
            userData += "<td>"+group["location"]+"</td>";
            userData += "<td>"+group["time"]+"</td>";
            if(group["in_group"] == "false") {
                userData += "<td><button class=\"join_group\" value=\""+group["group_id"]+"\">Join Group</button></td>";
            } else {
                userData += "<td><button class=\"view_group\" value=\""+group["group_id"]+"\">View Group</button></td>";
            }
            userData += "</tr>";
        });
        userData += "</table>";
        $("#ugroupsspan").html(userData);
        setListeners();
    });


}










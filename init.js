
$(document).ready(function(){
    setListeners();	

  	$("#search_txt").keyup(function() {
  		$.get("getresults.php?q="+$(this).val()+"&username="+localStorage["username"], function(data, status) {
  			$("#results").html(data);
  			
  		});
  	});    
});

function setListeners() {
    console.log("setting listeners");

    $("body").on("click", ".join_course", function() {
        joinCourse($(this).val());
    }); 

    $("body").on("click", ".join_group", function() {
        joinGroup($(this).val());
    }); 

    $("body").on("click", ".view_course", function() {
        viewCourse($(this).attr('value'));
    });

    $("body").on("click", ".view_group", function() {
        console.log("trying to view group gid: "+$(this).val());
        viewGroup($(this).attr('value'));
    });

    $("body").on("click", ".view_user", function() {
         viewUser($(this).val());
    });

    $("body").on("click", ".create_course", function(){
        console.log("create course");
        createCourse();
    });

    $("body").on("click", ".create_group", function() {
        createGroup();
    });

    $("body").on("click", ".friend_user", function() {
        friendUser($(this).attr('value'));
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
    console.log("viewing course cid: "+cid);
    $("#main").html("<span id='titlespan'></span><span id='groupspan'></span><span id='userspan'></span>");
    $.get("getcourse.php?cid="+cid+"&username="+localStorage["username"], function(data,status) {
        var courseArray = JSON.parse(data);
        var courseData = "<h1>"+courseArray["course_num"]+" <span>"+courseArray["course_name"];
        courseData += "<p>"+courseArray["instructor"]+"</p>";
        courseData += "<p>"+courseArray["location"]+"</p>";
        courseData += "<p>"+courseArray["time"]+"</p></span></h1>";
        $("#titlespan").html(courseData);

    });

    $.get("getcoursegroups.php?cid="+cid+"&username="+localStorage["username"], function(data,status) {
        $("#groupspan").html(data);
    });

    $.get("getcourseusers.php?cid="+cid+"&username="+localStorage["username"], function(data,status) {
        $("#userspan").html(data);
    });

}

function viewGroup(gid) {
    console.log("view group gid: "+gid);
    $("#main").html("<span id='gtitlespan'></span><span id='guserspan'></span>");

    $.get("getgroup.php?gid="+gid, function(data,status) {
        var groupArray = JSON.parse(data);
        console.log(groupArray);
        var groupData = "<h1>"+groupArray["group_name"]+"</h1>";
        groupData += "<h3><p>"+groupArray["course_num"]+" "+groupArray["course_name"]+"<p>";
        groupData += "<p>"+groupArray["description"]+"</p>";
        groupData += "<p>"+groupArray["location"]+"</p>";
        groupData += "<p>"+groupArray["time"]+"</p></h3>";
        $("#gtitlespan").html(groupData);
    });

    $.get("getgroupusers.php?gid="+gid+"&username="+localStorage["username"], function(data, status) {
        var a = JSON.parse(data);
        console.log(a);
        var userData = "<h3>Users</h3><table>";

        a.forEach(function(user){
        userData += "<tr><td>"+user["first_name"]+" "+user["last_name"]+"</td><td>"+user["email"]+"</td><td><button class=\"view_user small blue\" value=\""+user["username"]+"\">View User</button></td></tr>";
    });
        userData += "</table>"
        $('#guserspan').html(userData);
    });
}

function viewUser(username) {
	$("#main").html("<span id='gtitlespan'></span>");
    console.log(username);
    $.get("getuser.php?user="+username, function(data,status) {
        var userArray = JSON.parse(data);
        console.log(userArray);
        var userData = "<h1>"+userArray["first_name"]+" "+userArray["last_name"]+"</h1>";
        userData += "<h3><p>"+userArray["email"]+"<p></h3>";
        userData += "<button class=\"friend_user small blue\" value=\""+userArray["username"]+"\">Bind With User</button>"
        $("#gtitlespan").html(userData);
    });
}

function createCourse() {
    var html = "<h5>Course Number -- Course Name</h5>";
        html += "<input type=\"text\" id=\"course_num\">";
        //html += "<h5>Course Name</h5>";
        html += "<input type=\"text\" id=\"course_name\">";
        html += "<h5>Instructor</h5>";
        html += "<input type=\"text\" id=\"instructor\">";
        html += "<h5>TA</h5>";
        html += "<input type=\"text\" id=\"ta\">";
        html += "<h5>Location</h5>";
        html += "<input type=\"text\" id=\"location\">";
        html += "<h5>Time</h5>";
        html += "<input type=\"text\" id=\"time\"><br>";
        html += "<button id=\"submit_class\">Create Class</button>";

    $("#main").html(html);

    $("#submit_class").click(function() {
        console.log("createcourse.php?username="+localStorage["username"]+"&course_num="+$("#course_num").val()+"&course_name="+$("#course_name").val()+"&instructor="+$("#instructor").val()+"&ta="+$("#ta").val()+"&location="+$("#location").val()+"&time="+$("#time").val());
        $.get("createcourse.php?username="+localStorage["username"]+"&course_num="+$("#course_num").val()+"&course_name="+$("#course_name").val()+"&instructor="+$("#instructor").val()+"&ta="+$("#ta").val()+"&location="+$("#location").val()+"&time="+$("#time").val(), function(data, status) {
            console.log(data);
            var a = JSON.parse(data);
            viewCourse(a['course_id']);
        });
    });
}

function createGroup() {


}

function friendUser(friend) {
    $.get("frienduser.php?user="+localStorage["username"]+"&friend="+friend, function(data,status) {
        console.log(data);
    });
}







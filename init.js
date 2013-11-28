
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
        var groupData = "<h1 >"+groupArray["group_name"]+"</h1>";
        groupData += "<h3><p>"+groupArray["course_num"]+" "+groupArray["course_name"]+"<p>";
        groupData += "<p>"+groupArray["description"]+"</p>";
        groupData += "<p>"+groupArray["location"]+"</p>";
        groupData += "<p>"+groupArray["time"]+"</p></h3>";
        $("#gtitlespan").html(groupData);
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
        $("#gtitlespan").html(userData);
    });
}

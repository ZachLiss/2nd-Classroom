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

    $("body").on("click", ".viewCourseNotes", function() {
        getCourseNotes($(this).attr('value'));
    });

    $("body").on("click", ".show_thread", function() {
        showThread($(this).attr('value'));

    });
    
    $("body").on("click", ".new_thread", function() {
        NewThread();    
    });

    $("body").on("click", ".Submit_Thread", function() {
        SubmitThread(localStorage["currentGroup"]); 
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
    localStorage["currentCourse"] = cid;
    $("#main").html("<span id='titlespan'></span><span id='groupspan'></span><span id='userspan'></span>");
    $.get("getcourse.php?cid="+cid+"&username="+localStorage["username"], function(data,status) {
        var courseArray = JSON.parse(data);
        var courseData = "<h1>"+courseArray["course_num"]+" <span>"+courseArray["course_name"];
        courseData += "<p>"+courseArray["instructor"]+"</p>";
        courseData += "<p>"+courseArray["location"]+"</p>";
        courseData += "<p>"+courseArray["start_time"]+"</p></span></h1>";
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
    localStorage["currentGroup"] = gid;
    console.log("view group gid: "+gid);
    $("#main").html("<span id='gtitlespan'></span><span id='guserspan'></span><span id='newtspan'></span><span id='threadspan'></span>");

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

    var newSpanList = "";
    newSpanList += "<td><button class=\"new_thread small blue\" value=\""+gid+"\">Create New Thread</button></td></tr><hr>";
    $("#newtspan").html(newSpanList);

   loadThreads(gid);
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
        html += "<h5>Start Time</h5>";
        html += "<input type=\"text\" id=\"start_time\"><br>";
        html += "<h5>End Time</h5>";
        html += "<input type=\"text\" id=\"end_time\"><br>";
        html += "<button id=\"submit_class\">Create Class</button>";

    $("#main").html(html);
    $('#start_time').datetimepicker();
    $('#end_time').datetimepicker();

    $("#submit_class").click(function() {
        var start = $("#start_time").val();
        console.log("createcourse.php?username="+localStorage["username"]+"&course_num="+$("#course_num").val()+"&course_name="+$("#course_name").val()+"&instructor="+$("#instructor").val()+"&ta="+$("#ta").val()+"&location="+$("#location").val()+"&start_time="+$("#start_time").val()+"&end_time="+$("#end_time").val());
        $.get("createcourse.php?username="+localStorage["username"]+"&course_num="+$("#course_num").val()+"&course_name="+$("#course_name").val()+"&instructor="+$("#instructor").val()+"&ta="+$("#ta").val()+"&location="+$("#location").val()+"&start_time="+start+"&end_time="+$("#end_time").val(), function(data, status) {
            console.log(data);
            var a = JSON.parse(data);
            viewCourse(a['course_id']);
        });
    });
}

function createGroup() {
    var html = "<h5>Group Name</h5>";
        html += "<input type=\"text\" id=\"group_name\">";
       
        html += "<h5>Description</h5>";
        html += "<input type=\"text\" id=\"description\">";

        html += "<h5>Location</h5>";
        html += "<input type=\"text\" id=\"location\">";

        html += "<h5>Time</h5>";
        html += "<input type=\"text\" id=\"time\"><br>";
        html += "<button id=\"submit_group\">Create Group</button>";

    $("#main").html(html);

    $("#submit_group").click(function() {
        console.log("creategroup.php?username="+localStorage["username"]+"&group_name="+$("#group_name").val()+"&course_id="+localStorage["currentCourse"]+"&location="+$("#location").val()+"&description="+$("#description").val()+"&time="+$("#time").val()+"&creator="+localStorage["username"]);
        $.get("creategroup.php?username="+localStorage["username"]+"&group_name="+$("#group_name").val()+"&course_id="+localStorage["currentCourse"]+"&location="+$("#location").val()+"&description="+$("#description").val()+"&time="+$("#time").val()+"&creator="+localStorage["username"], function(data, status) {
            console.log(data);
            var a = JSON.parse(data);
            viewGroup(a['group_id']);
        });
    });

}

function friendUser(friend) {
    $.get("frienduser.php?user="+localStorage["username"]+"&friend="+friend, function(data,status) {
        console.log(data);
    });
}

function showThread(thread_id) {

    $("#main").html("<div id = 'tspan'></div><div id = 'postspan'></div>");
    console.log(thread_id + "this is it");
    
    setInterval(function() {
        $.get("getthreadmessages.php?thread_id=" + thread_id, function(data, status) {
            console.log(data);
            //parse data into an array
            var messageArray = JSON.parse(data);
            var messageList = "";

            console.log(messageArray);
            messageArray.forEach(function(message) {
                messageList += "<h4><p>User " + message["username"] + "</p>";
                messageList += "<p>Said: " + message["content"] + "</p>";
                messageList += "<p>On " + message["time"] + "</p></h4>";
            });
    
            $("#tspan").html(messageList);
        });
    }, 1000);
    var postList = "";
    postList += "<h3>"
    postList += "<input type='text' size=\"100\" id =\"txt\">"
    postList += "<button class=\"Post_Thread\">Post to Thread</button></h3>"
    $("#postspan").html(postList);


    $(".Post_Thread").click(function() {
        $.get("addthreadmessage.php?thread_id=" +thread_id + "&content=" + $("#txt").val() + "&username=" + localStorage["username"]);
        console.log("message submitted");
        var div = $("#tspan")
        var height = div[0].scrollHeight;
        div.scrollTop(height);
    });

}


function NewThread(){
    var threadEntry = "";
    threadEntry += "<h3><p>Title</p>"
    threadEntry += "<input type=\"text\" id=\"tit\"/>"
    threadEntry += "<p>Subject</p>"
    threadEntry += "<input type=\"text\" size=\"50\" id=\"sub\"/><br>"
    threadEntry += "<button class=\"Submit_Thread\">Add Thread</button></h3>"
    $("#newtspan").html(threadEntry);
}

function SubmitThread(gid){
    $.get("addthread.php?group_id=" + gid + "&title=" + $("#tit").val() + "&subject=" + $("#sub").val());
            
    var SpanList = "";
    SpanList += "<td><button class=\"new_thread small blue\" value=\""+gid+"\">Create New Thread</button></td></tr><hr>";
    $("#newtspan").html(SpanList);
    
    loadThreads(gid);
}

function loadThreads(gid) {
			$.get("getthreads.php?group_id="+gid, function(data, status) {
			console.log(data);
			//parse data into an array
			
			var threadArray = JSON.parse(data);
			var threadList = "";
			console.log(threadArray);
			threadArray.forEach(function(thread) {
			threadList += "<h3>Title: " + thread["title"] + "<br>";
			threadList += "Subject: " + thread["subject"] + "<br>";
			threadList += "<td><button class=\"show_thread small blue\" value=\""+thread["thread_id"]+"\">View Thread</button></td></tr></h3>";	
			});
			
			$("#threadspan").html(threadList);
		});


}








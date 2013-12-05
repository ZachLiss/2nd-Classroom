function setListeners() {
    console.log("setting listeners");

    /*listeners for navbar*/
    $("#calendar").click(function() {
        displayCalendar();
    });

    $("#search").click(function() {
        setSearch();
    });

    $("#messages").click(function() {
        get_messages();
    });

    $("#notes").click(function() {
        getNotes();
    });

    $("#settings").click(function() {
        $("#main").load("settings.php");
    });

    $("#help").click(function() {
        $("#main").load("help.php");
    });


    /*listeners for course functions*/
    $("body").on("click", ".join_course", function() {
        joinCourse($(this).val());
    }); 

    $("body").on("click", ".view_course", function() {
        viewCourse($(this).attr('value'));
    });

    $("body").on("click", ".create_course", function(){
        console.log("create course");
        createCourse();
    });


    /*listeners for group functions*/
    $("body").on("click", ".join_group", function() {
        joinGroup($(this).val());
    }); 

    $("body").on("click", ".view_group", function() {
        console.log("trying to view group gid: "+$(this).val());
        viewGroup($(this).attr('value'));
    });

    $("body").on("click", ".create_group", function() {
        createGroup();
    });


    /*listeners for user functions*/
    $("body").on("click", ".view_user", function() {
         viewUser($(this).val());
    });

    $("body").on("click", ".friend_user", function() {
        friendUser($(this).attr('value'));
    });


    /*listeners for notes functions*/
    $("body").on("click", ".viewCourseNotes", function() {
        getCourseNotes($(this).attr('value'));
    });

    $("body").on("click", ".viewNote", function() {
        getNote($(this).attr('value'));
    });

    $("body").on("click", ".newNote", function() {
        newNote($(this).attr('value'));
    });


    /*listeners for thread functions*/
    $("body").on("click", ".show_thread", function() {
        showThread($(this).attr('value'));

    });
    
    $("body").on("click", ".new_thread", function() {
        NewThread();    
    });

    $("body").on("click", ".Submit_Thread", function() {
        SubmitThread(localStorage["currentGroup"]); 
    });


    /*listener for mesage*/
    $(".message_link").click(function() {
        $("#main").load("messages.php");
    });
    
}


/******************
 *Course Functions*
 ******************/

function joinCourse(cid) {
	console.log("joining course cid: "+cid);
    $.get("joincourse.php?cid="+cid+"&username="+localStorage["username"]);
    viewCourse(cid);
    userBarReload();
}

function viewCourse(cid) {
    console.log("viewing course cid: "+cid);
    localStorage["currentCourse"] = cid;
    $("#main").html("<span id='titlespan'></span><span id='groupspan'></span><span id='userspan'></span>");
    $.get("getcourse.php?cid="+cid+"&username="+localStorage["username"], function(data,status) {
        var courseArray = JSON.parse(data);
        var courseData = "<h1>"+courseArray["course_num"]+" <span>:</span> "+courseArray["course_name"];
        courseData += "<span><p>"+courseArray["instructor"]+"</p>";
        courseData += "<p>"+courseArray["location"]+"</p>";
        courseData += "<p>"+courseArray["start_time"]+" "+courseArray["days"]+"</p></span></h1>";
        $("#titlespan").html(courseData);
    });

    $.get("getcoursegroups.php?cid="+cid+"&username="+localStorage["username"], function(data,status) {
        $("#groupspan").html(data);
    });

    $.get("getcourseusers.php?cid="+cid+"&username="+localStorage["username"], function(data,status) {
        $("#userspan").html(data);
    });

}


function createCourse() {
    var html = "<span><h1>Create Class</h1></span>";
        html += "<input type=\"text\" id=\"course_num\" placeholder=\"Course #\">";
        html += "<input type=\"text\" id=\"course_name\" placeholder=\"Course Name\">";
        html += "<br><br><input type=\"text\" id=\"instructor\" placeholder=\"Instructor\">";
        html += "<br><input type=\"text\" id=\"ta\" placeholder=\"TA\">";
        html += "<br><br><input type=\"text\" id=\"location\" placeholder=\"Location\">";
        html += "<br><input type=\"text\" id=\"start_date\"placeholder=\"First Class Date\">";
        html += "<br><br><input type=\"text\" id=\"start_time\" placeholder=\"Start Time\"><br>";
        html += "<input type=\"text\" id=\"end_time\" placeholder=\"End Time\"><br>";
        html += "<br><select multiple id=\"days\" name=\"weekdays\"><option value=\"SUN\">Sunday</option><option value=\"MON\">Monday</option><option value=\"TUE\">Tuesday</option><option value=\"WED\">Wednesday</option><option value=\"THUR\">Thursday</option><option value=\"FRI\">Friday</option><option value=\"SAT\">Saturday</option></select>";
        html += "<button id=\"submit_class\">Create Class</button>";

    $("#main").html(html);
    $('#start_date').datepicker();
    $('#start_time').timepicker({timeFormat: "hh:mm tt"});
    $('#end_time').timepicker({timeFormat: "hh:mm tt"});

    $("#submit_class").click(function() {
        var start = $("#start_date").val()+" "+$("#start_time").val();
        var end = $("#start_date").val()+" "+$("#end_time").val();
        console.log("createcourse.php?username="+localStorage["username"]+"&course_num="+$("#course_num").val()+"&course_name="+$("#course_name").val()+"&instructor="+$("#instructor").val()+"&ta="+$("#ta").val()+"&location="+$("#location").val()+"&start_time="+$("#start_time").val()+"&end_time="+$("#end_time").val());
        $.get("createcourse.php?username="+localStorage["username"]+"&course_num="+$("#course_num").val()+"&course_name="+$("#course_name").val()+"&instructor="+$("#instructor").val()+"&ta="+$("#ta").val()+"&location="+$("#location").val()+"&start_time="+start+"&end_time="+end+"&days="+$("#days").val(), function(data, status) {
            console.log(data);
            var a = JSON.parse(data);
            viewCourse(a['course_id']);
            userBarReload();
        });
    });
}



/******************
 *Group Functions *
 ******************/

function joinGroup(gid) {
    console.log("joining group gid: "+gid);
    $.get("joingroup.php?gid="+gid+"&username="+localStorage["username"]);
    viewGroup(gid);
    userBarReload();
}

function viewGroup(gid) {
    console.log("view group gid: "+gid);
    localStorage["currentGroup"] = gid;
    console.log("view group gid: "+gid);
    $("#main").html("<span id='gtitlespan'></span><span id='guserspan'></span><span id='newtspan'></span><span id='threadspan'></span>");

    $.get("getgroup.php?gid="+gid, function(data,status) {
        var groupArray = JSON.parse(data);
        console.log(groupArray);
        var groupData = "<h1>"+groupArray["group_name"];
        groupData += "<span><p>"+groupArray["course_num"]+" "+groupArray["course_name"]+"<p>";
        groupData += "<p>"+groupArray["description"]+"</p>";
        groupData += "<p>"+groupArray["location"]+"</p>";
        groupData += "<p>"+groupArray["start_time"]+"</p></span></h1>";
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
        $('#time').datetimepicker({timeFormat: "hh:mm tt"});


    $("#submit_group").click(function() {
        console.log("creategroup.php?username="+localStorage["username"]+"&group_name="+$("#group_name").val()+"&course_id="+localStorage["currentCourse"]+"&location="+$("#location").val()+"&description="+$("#description").val()+"&time="+$("#time").val()+"&creator="+localStorage["username"]);
        $.get("creategroup.php?username="+localStorage["username"]+"&group_name="+$("#group_name").val()+"&course_id="+localStorage["currentCourse"]+"&location="+$("#location").val()+"&description="+$("#description").val()+"&time="+$("#time").val()+"&creator="+localStorage["username"], function(data, status) {
            console.log(data);
            var a = JSON.parse(data);
            viewGroup(a['group_id']);
            userBarReload();
        });
    });

}



/******************
 * User Functions *
 ******************/

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

function friendUser(friend) {
    $.get("frienduser.php?user="+localStorage["username"]+"&friend="+friend, function(data,status) {
        console.log(data);
    });
}



/******************
 *Notes Functions *
 ******************/

function getNotes () {
    $("#main").html("<span id='gtitlespan'></span><span id='notespan'></span>");
    $("#gtitlespan").html("<h1>Notes</h1>");
    $.get("getusercourses.php?username="+localStorage['username'], function(data, status) {
        var courseArray = JSON.parse(data);
        var notesList = "<table>";
        courseArray.forEach(function(course) {
            notesList += "<tr class= \"viewCourseNotes\" value=\""+course["course_id"]+"\"><td><h3>"+course["course_num"]+": "+course["course_name"]+"</h3></td></tr>";
        });
        notesList += "</table>";        
        $("#notespan").html(notesList);
    });
}

function getCourseNotes (course_id) {
    $.get("getnotes.php?username="+localStorage['username']+"&course_id="+course_id, function(data, status) {
        var notesArray = JSON.parse(data);
        var notesList = "<table>"
        notesArray.forEach(function(note) {
            console.log(note);
            notesList += "<tr class= \"viewNote\" value=\""+note["note_id"]+"\"><td>"+note["title"]+"</td><td>"+note["time"]+"</td></tr>";
        });
        notesList += "<tr class= \"newNote\" value=\""+course_id+"\"><td>New Note</td></tr>";
        notesList += "</table>";
        $("#notespan").html(notesList);
    });
}

function getNote (note_id) {
    $.get("getnote.php?note_id="+note_id, function(data, status) {
        var note = JSON.parse(data);
        var title = "<h1>"+note["course_name"]+"</h1>";
            title += "<h3>"+note["title"];
            title += "<p>"+note["time"]+"</p></h3>";
        $("#gtitlespan").html(title);

        var content = "<h4>"+note["note"]+"</h4>";
        $("#notespan").html(content);
    });
}

function newNote (course_id) {
    $("#gtitlespan").html("<h1>New Note</h1>");
    var form = " <h3><input type=\"text\" id=\"title\" placeholder=\"Title\"><br>";
        form += "<textarea rows=\"4\" cols=\"50\" id =\"noteTxt\" placeholder=\"Write your note here.\"></textarea>";
        form += "<br><button id=\"postNote\">Post Note</button>";
    $("#notespan").html(form);

    $("#postNote").click(function(){
        var temp = $("#noteTxt").val();
        var note = temp.replace(/\r\n|\r|\n/g,"<br />");
        $.get("postnote.php?title=" + $("#title").val() + "&note=" + note + "&course_id=" + course_id, function(data, status) {
            getNotes();
        });
    });
}



/******************
 *Thread Functions*
 ******************/

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

/*******************
 *Message Functions*
 *******************/

function get_messages() {
    /*create two new divs for mailbox view and message view*/
    $("#main").html("<div id=\"mail_header\"></div><div id=\"mailbox\"></div><div id=\"message\"></div>");
    /* Style */
    $("#mail_header").height("7%");
    $("#mailbox").height("37%");
    $("#message").height("56%");
    $("#mailbox").css({'border-bottom': '2px solid black', 'overflow': 'auto'});
    $("#message").css('overflow', 'auto');
    /*Send get request to getmessages.php . This returns all field of a message table entry
    except the 'recipient', since that is the current user, and the message itself.*/
    $.get("getmessages.php?username="+localStorage['username'], function(data, status) {
        JSON.stringify(data);
        console.log(data);
        //parse data into an array
        var messageArray = JSON.parse(data);
                        
        var header = "<table><tr><th><h1>From:</h1></th><th><h1>Subject:</h1></th><th><h1>Time/Date</h1></th></tr></table>";
        $("#mail_header").html(header);
        console.log(messageArray);
        var messages = "<table id=\"mail\">"
        messageArray.forEach(function(message) {
            messages += "<tr class=\"message_link\" value=\"" + message["message_id"]+"\"><td>" + message["sender"] + "</td>";
            messages += "<td>"+message["subject"] + "</td>";
            messages += "<td>"+ message["time"] + "</td></tr>";
        });
        messages+= "<tr><td><a id='new_message'>New Message</a></td></tr>"

        messages+= "</table>"                
        $("#mailbox").html(messages);
        $(".message_link").click(function() {
            $.get("getmessage.php?id="+ $(this).attr('value'), function(data, status){
                console.log(data);
                var message = JSON.parse(data);
                var output = "<b>From: </b>"+message['sender'];
                output  += "<hr>"+nl2br(message['message']);

                $("#message").html(output);
            });
            
        });

        $("#new_message").click(function() {
            $.get("getuserfriends.php?username="+localStorage["username"], function(data, status){
                var friends = JSON.parse(data);
                var output = "<table><tr><td>To:</td><td><select id='message_to'>";
                output += "<option value = NULL>--Choose Recipient--</option>";
                friends.forEach(function(friend) {
                    output += "<option value = \""+friend["username"]+"\">"+friend["name"]+"</option>";
                });

                output += "</select></td></tr>";
                output  += "<tr><td>Subject:</td><td><input type='text' id='message_subject' placeholder='subject' size='70'></td></tr>";
                output  += "<tr><td></td><td><textarea id='message_body' placeholder='Type your message here' rows='40' cols='60'></textarea>";
                output  += "<button id='send_message'>Send</button></td></tr></table>";
                
                $("#message").html(output);
                $("#message_body").css('white-space', 'pre');
            
                $("#send_message").click(function(){
                    var recipient= $("#message_to").val();
                    console.log($("#message_to").val());
                    var subject= $("#message_subject").val();
                    var body = $("#message_body").val();
                    console.log(body);
                    var message = body.replace(/\r\n|\r|\n/g,"<br />");
                    console.log(message);
                    $.get("sendmessage.php?recipient="+recipient+"&subject="+subject+"&message="+message, function(data, status){
                        var output = "Message Sent!";
                        $("#message").html(output);
                    });
                });
            });
        });
    });
}


function userBarReload () {
    $.get("getusercourses.php?username="+localStorage['username'], function(data, status) {
        JSON.stringify(data);
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
}



/*******************
 * Misc. Functions *
 *******************/

function displayCalendar(){
    var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();
    $('#main').html('');
    $('#main').fullCalendar({
        height: 500,
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,basicWeek,basicDay'
        },
        defaultView: 'basicWeek',
        editable: false,

        eventSources: [

        // your event source
        {
            url: 'events.php', // use the `url` property
            color: 'green',    // an option!
            textColor: 'black'  // an option!
        }

        // any other sources...

    ]
    });
        $('#main').prepend('<h1>CALENDAR</h1>');

}

function nl2br (str, is_xhtml) {
  var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br ' + '/>' : '<br>';
  return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
}

function setSearch(){
    $("#main").html("<h1>Search   <input type='text' id='search_txt'/></h1><span id='results'></span>");
    
    console.log($("#search_txt").attr("id"));
    $("#search_txt").keyup(function() {
        console.log($("#search_txt").val());
        $.get("getresults.php?q="+$(this).val()+"&username="+localStorage["username"], function(data, status) {
            $("#results").html(data);
        });
        
    });
}






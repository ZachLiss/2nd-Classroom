
function setNavigation() {
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

	$(".message_link").click(function() {
		$("#main").load("messages.php");
	});

}

/*
	nl2br : conversion from text field newlines to <br> tags.
	Used for message output, and eventually note output.
*/

function nl2br (str, is_xhtml) {
  var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br ' + '/>' : '<br>';
  return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
}

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
    			output	+= "<hr>"+nl2br(message['message']);

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
    		    output 	+= "<tr><td>Subject:</td><td><input type='text' id='message_subject' placeholder='subject' size='70'></td></tr>";
    		    output	+= "<tr><td></td><td><textarea id='message_body' placeholder='Type your message here' rows='40' cols='60'></textarea>";
    		    output	+= "<button id='send_message'>Send</button></td></tr></table>";
                
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


function getNotes () {
    $.get("getusercourses.php?username="+localStorage['username'], function(data, status) {
        var courseArray = JSON.parse(data);
        var notesList = "<table>";
        courseArray.forEach(function(course) {
            notesList += "<tr class= \"viewCourseNotes\" value=\""+course["course_id"]+"\"><td><h1>"+course["course_num"]+": "+course["course_name"]+"</h1></td></tr>";
        });
        notesList += "</table>";        
        $("#main").html(notesList);
    });
}

function getCourseNotes (course_id) {
     $.get("getnotes.php?username="+localStorage['username']+"&course_id="+course_id, function(data, status) {
                var notesArray = JSON.parse(data);
                var notesList = "<table>"
                notesArray.forEach(function(note) {
                    console.log(note);
                    notesList += "<tr><td>"+note["title"]+"</td><td>"+note["time"]+"</td></tr>";
                });
                notesList += "</table>";
                $("#main").html(notesList);
            });
}

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

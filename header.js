
function setNavigation() {
	$("#calendar").click(function() {
		$("#main").load("calendar.php");
	});

	$("#search").click(function() {
		$("#main").load("search.html");
	});

	$("#messages").click(function() {
		get_messages();
	});

	$("#notes").click(function() {
		$("#main").load("notes.php");
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

function get_messages() {
	$.get("getmessages.php?username="+localStorage['username'], function(data, status) {
    	JSON.stringify(data);
        console.log(data);
        //parse data into an array
        var messageArray = JSON.parse(data);
                        
        var messages = "<table><tr><th>From:</th><th>Subject:</th><th>Time/Date</th></tr>";

        console.log(messageArray);
        messageArray.forEach(function(message) {
        	messages += "<tr><td>" + message["sender"] + "</td>";
        	messages += "<td><a class=\"message_link\" value=\"" + message["message_id"] + "\">";
        	messages += message["subject"] + "</a></td>";
        	messages += "<td>"+ message["time"] + "</td></tr>";
    	});

        messages+= "</table>"                
    	$("#main").html(messages);
    	$(".message_link").click(function() {
    		console.log($(this).attr('value'));
    		$.get("getmessage.php?id="+ $(this).attr('value'), function(data, status){
    			$('#main').append("<p>"+data+"</p>");
    		});
			
		});
	});
}

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

  	$("#testspan").html("<p>i added this in the function</p>");
});

function setListeners() {
	$(".join_course").click(function() {
  		//console.log("course_id: "+$(this).val());
  		joinCourse($(this).val());
  	});

  	$(".view_course").click(function() {
  		viewCourse($(this).val());
  	});

  	$(".view_user").click(function() {
  		viewUser($(this).val());
  	});
}

function joinCourse(cid) {
	console.log("joining course cid: "+cid);
}

function viewCourse(cid) {
	console.log("viewing course cid: "+cid);
}
function viewUser(username) {
	console.log("viewing user username: "+username);
}

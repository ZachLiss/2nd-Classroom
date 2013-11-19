<?php

?>
<nav class="navbar">
	<p id="logo">
		<span>2nd</span>Classroom
	</p>
	<?php if(isset($_SESSION['username'])){ ?>
	<div id="notifications">
	<a id= "calendar" title="Calendar"><img class="nav_but" src="images/home.png" onmouseover="this.src='images/home2.png'" onmouseout="this.src='images/home.png'" /></a>&nbsp;&nbsp;
	<a id="messages" title="Messages"><img class="nav_but" src="images/star.png" onmouseover="this.src='images/star2.png'" onmouseout="this.src='images/star.png'" /></a>&nbsp;&nbsp;
	<a id= "notes" title="Notes"><img class="nav_but" src="images/notes.png" onmouseover="this.src='images/notes2.png'" onmouseout="this.src='images/notes.png'" /></a>&nbsp;&nbsp;
	<img class="nav_but" src="images/div.png">&nbsp;&nbsp;
	<a id = "settings" title="Settings"><img class="nav_but" src="images/settings.png" onmouseover="this.src='images/settings2.png'" onmouseout="this.src='images/settings.png'" /></a>&nbsp;&nbsp;
	<a id= "help" title="Help"><img class="nav_but" src="images/help.png" onmouseover="this.src='images/help2.png'" onmouseout="this.src='images/help.png'" /></a>&nbsp;&nbsp;
		<a href="#" title="Log Out"><img class="nav_but" src="images/exit.png" onmouseover="this.src='images/exit2.png'" onmouseout="this.src='images/exit.png'" /></a>
	</div>
	<?php } ?>
	
</nav>

<?php

?>

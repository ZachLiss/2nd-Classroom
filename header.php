<?php

?>
<nav class="navbar">
	<p id="logo">
		<span>2nd</span>Classroom
	</p>
	<?php if(isset($_SESSION['username'])){ ?>
	<div id="notifications">
	<a href="#" title="Home"><img class="nav_but" src="images/home.png" onmouseover="this.src='images/home2.png'" onmouseout="this.src='images/home.png'" /></a>&nbsp;&nbsp;
	<a href="#" title="Messages"><img class="nav_but" src="images/star.png" onmouseover="this.src='images/star2.png'" onmouseout="this.src='images/star.png'" /></a>&nbsp;&nbsp;
	<img title="Notes" class="nav_but" height=75% src="images/notes.png" onmouseover="this.src='images/notes2.png'" onmouseout="this.src='images/notes.png'" />&nbsp;&nbsp;
	<img class="nav_but" src="images/div.png">&nbsp;&nbsp;
	<a href="#" title="Settings"><img class="nav_but" src="images/settings.png" onmouseover="this.src='images/settings2.png'" onmouseout="this.src='images/settings.png'" /></a>&nbsp;&nbsp;
	<a href="#" title="Help"><img class="nav_but" src="images/help.png" onmouseover="this.src='images/help2.png'" onmouseout="this.src='images/help.png'" /></a>&nbsp;&nbsp;
		<a href="#" title="Log Out"><img class="nav_but" src="images/exit.png" onmouseover="this.src='images/exit2.png'" onmouseout="this.src='images/exit.png'" /></a>
	</div>
	<?php } ?>
	
</nav>

<?php

?>

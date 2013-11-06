<?php

?>
<div id="header-container">
	<div id="logo">
		<h1 class="logo">2ndClassroom</h1>
	</div>
	<?php if(isset($_SESSION['username'])){ ?>

	<div id="notifications">
	<a href="#" title="Home"><img height=75% src="images/home.png" onmouseover="this.src='images/home2.png'" onmouseout="this.src='images/home.png'" /></a>&nbsp;&nbsp;
	<a href="#" title="Messages"><img height=75% src="images/star.png" onmouseover="this.src='images/star2.png'" onmouseout="this.src='images/star.png'" /></a>&nbsp;&nbsp;
	<img title="Notes" id="notes" height=75% src="images/notes.png" onmouseover="this.src='images/notes2.png'" onmouseout="this.src='images/notes.png'" />&nbsp;&nbsp;
	<a href="search.php" title="Search"><img height=75% src="images/search.png" onmouseover="this.src='images/search2.png'" onmouseout="this.src='images/search.png'" /></a>&nbsp;&nbsp;
	<img height=75% src="images/div.png">&nbsp;&nbsp;
	<a href="#" title="Settings"><img height=75% src="images/settings.png" onmouseover="this.src='images/settings2.png'" onmouseout="this.src='images/settings.png'" /></a>&nbsp;&nbsp;
	<a href="#" title="Help"><img height=75% src="images/help.png" onmouseover="this.src='images/help2.png'" onmouseout="this.src='images/help.png'" /></a>&nbsp;&nbsp;
	<a href="#" title="Log Out"><img height=75% src="images/exit.png" onmouseover="this.src='images/exit2.png'" onmouseout="this.src='images/exit.png'" /></a>
	</div>
<div id="panel">CS1520 Notes<br><br>CS1530 Notes<br><br>MAT1000 Notes<br><br>Note 4<br><br>Note 5</div>
	<?php } ?>
	
</div>

<?php

?>

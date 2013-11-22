<?php

?>
<nav class="navbar">
	<p id="logo">
		<span>2nd</span>Classroom
	</p>
	<?php if(isset($_SESSION['username'])){ ?>
	<div id="notifications">
	<a id= "calendar" class="tooltip-bottom" title="Calendar"><i class="icon-calendar icon-2x nav_but" style="color: #86dc00"></i></a>&nbsp;&nbsp;
	<a id= "search" class="tooltip-bottom" title="Search"><i class="icon-search icon-2x nav_but" style="color: #86dc00"></i></a>&nbsp;&nbsp;
	<a id="messages" class="tooltip-bottom" title="Messages"><i class="icon-envelope icon-2x nav_but" style="color: #86dc00"></i></a>&nbsp;&nbsp;
	<a id= "notes" class="tooltip-bottom" title="Notes"><i class="icon-edit icon-2x nav_but" style="color: #86dc00"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;


	<a href="process.php?log_out=1" class="tooltip-bottom" title="Log Out"><i class="icon-signout icon-2x nav_but" style="color: #86dc00"></i></a>
	</div>
	<?php } ?>
	
</nav>

<?php

?>

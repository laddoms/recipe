<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html>
<?php include('header.inc.php'); ?>
<body>
<script src="greeting.js"></script>
<?php 
	if(!isset($_REQUEST['content']))
		include("main.inc.php");
	else
		{
			$content=$_REQUEST['content'];
			$nextpage=$content .  ".inc.php";
			include($nextpage);
		}
?>
</body>
<?php include('footer.html'); ?>
</html>
		
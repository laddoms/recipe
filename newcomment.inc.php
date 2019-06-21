<?php
//session_start();
$recipeid = $_GET['id'];
if (!isset($_SESSION['valid_recipe_user']))
	{
		//echo 'session id: ' . session_id();
		echo "<h2>Sorry, you do not have permission to post comments</h2><br>\n";
		echo "<a href=\"index.php?content=login\">Please login to post comments</a><br><br />\n";
		echo "<a href=\"index.php?content=showrecipe&id=$recipeid\">Go back to recipe</a><br />\n";
		echo"<br />";
	} 
else
	{
		//session_start();
		$userid = $_SESSION['valid_recipe_user'];
		//echo 'session id: ' . session_id();
		echo"<br /><div class='comment'>";
		echo "<form action=\"index.php\" method=\"post\">\n";
		echo "<h2>Enter your comment</h2>";
		echo "<textarea rows=\"10\" cols=\"50\" name=\"comment\"></textarea><br>\n";
		echo "<input type=\"hidden\" name=\"userid\" value=\"$userid\"><br>\n";
		echo "<input type=\"hidden\" name=\"recipeid\" value=\"$recipeid\">\n";
		echo "<input type=\"hidden\" name=\"content\" value=\"addcomment\">\n";
		echo "<input type=\"submit\" value=\"Add Comment\">\n";
		echo "</form>\n";
		echo"</div>";
		echo"<br />";
	}
?>
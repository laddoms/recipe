<?php
if (!isset($_SESSION['valid_recipe_user']))
	{
	   echo "<h2>Sorry, you do not have permission to post recipes</h2>\n";
	   echo "<a href=\"index.php?content=login\">Please login to post recipes</a>\n";
	} 
else
	{
	   echo "<h2>Enter your new recipe</h2>";
	   $userid = $_SESSION['valid_recipe_user'];
	   //echo$userid;
	   echo"<br />";
	   echo "<div class='newrecipe'><form enctype=\"multipart/form-data\" action=\"index.php\" method=\"post\">\n";
	   echo "<h3><b>Title:</h3></label><input type=\"text\" size=\"40\" name=\"title\"><br />\n";
	   echo "<h3>Ingredients:</h3>(one item per line)\n";
	   echo "<textarea rows=\"10\" cols=\"50\" name=\"ingredients\"></textarea>\n";
	   echo "<h3>Directions:</h3>\n";
	   echo "<textarea rows=\"10\" cols=\"50\" name=\"directions\"></textarea>\n";
	   echo "<input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"1024000\">\n";
	   echo "<h3>Recipe Image:</h3><input type=\"file\" name=\"image\">\n";
	   echo "<input type=\"submit\" name=\"submit\" value=\"Post Recipe\">\n";
	   echo "<input type=\"hidden\" name=\"userid\" value=\"$userid\">\n";
	   echo "<input type=\"hidden\" name=\"content\" value=\"addrecipe\">\n";
	   echo "</form>\n</div><br />";
	}
?>


</div>
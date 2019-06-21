<?php
include('mysqli_connect.php');
include('getthumb1.php');
$title=$_POST['title'];
$userid=$_POST['userid'];
$image=$_FILES['image']['name'];
$ingredients=htmlspecialchars($_POST['ingredients']);
$directions=htmlspecialchars($_POST['directions']);
$thumbnail = getThumb($_FILES['image']['name']);
$thumbnail = mysql_real_escape_string($thumbnail);  //necessary for inserting binary data in SQL. Escapes special chars for SQL insertion
if(trim($userid) == "")
	{
		echo "<h2>Each recipe must have a poster.</h2>";
	}
if(trim($title)== '')
	{
		echo "<h2>Please enter a title for your recipe</h2><br />\n";
		echo "<a href=\"index.php?content=newrecipe\">Try Again</a><br>\n";
		echo "<a href=\"index.php\">Return to Home</a>\n";
		$baduser=1;
	}
if(trim($ingredients)== '')
	{
		echo "<h2>Please enter ingredients.</h2><br />\n";
		echo "<a href=\"index.php?content=newrecipe\">Try Again</a><br>\n";
		echo "<a href=\"index.php\">Return to Home</a>\n";
		$baduser=1;
	}
if(trim($directions)== '')
	{
		echo "<h2>Please enter the directions.</h2><br />\n";
		echo "<a href=\"index.php?content=newrecipe\">Try Again</a><br>\n";
		echo "<a href=\"index.php\">Return to Home</a>\n";
		$baduser=1;
	}
else
	{
		//echo"the thumbnail is " . $thumbnail;
		$query="INSERT INTO recipes(title, ingredients, directions, image, userid) VALUES('$title', '$ingredients', '$directions','$thumbnail',$userid)";
    	$result=mysqli_query($dbc, $query);// or die('Sorry could not post your recipe.');
		if ($result)
			{
				echo "<h2> '$title' with image named $image has been posted.</h2>\n";
				//include('footer.html');
			}
		else	
			{
				echo "<h2>Sorry there was a problem posting your recipe.</h2>\n";
				include('footer.html');
			}
	}
?>


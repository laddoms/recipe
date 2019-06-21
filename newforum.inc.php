<?php
include('mysqli_connect.php');
$query="SELECT * FROM words";
$result=mysqli_query($dbc, $query);
$words=mysqli_fetch_array($result, MYSQLI_ASSOC);
echo$words['title'];
if (!isset($_SESSION['valid_recipe_user']))
	{
		if(basename($_SERVER['PHP_SELF'])=='newforum.inc.php')	
			{
				echo'<a href="post.php">' . $words['newthread'] . '</a><br />';
			}
	}
else
	{
		echo'<a href="index.php?content=login"><strong>Login to Post</strong></a><br />';
	}
?>
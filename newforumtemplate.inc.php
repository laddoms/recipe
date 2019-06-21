<html>
<!--this is aka 'header.html' in text book-->
<head>
	<content="text/html;charset=utf-8" />
	<title>
		<?php 
		include('mysqli_connect.php');
		$query="SELECT * FROM words";  //get all the words from the words table
		$result=mysqli_query($dbc, $query);
		$words=mysqli_fetch_array($result, MYSQLI_ASSOC);
		echo $words['title']; ?>
	</title>
	<?php// include('header.inc.php'); ?>
</head>
<body>
<?php
echo'<br />';
echo'<br />';
echo'<a href="index.php?content=forumpage">' . $words['forumhome'] . '</a><br />';  //link to forumpage.inc.php

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
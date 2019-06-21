<?php
include('mysqli_connect.php');
$query="SELECT * FROM words";  //get all the words from the words table
$result=mysqli_query($dbc, $query);
$words=mysqli_fetch_array($result, MYSQLI_ASSOC);
?>
<html>
<head>
	<content="text/html;charset=utf-8" />
	<title><?php  echo $words['title']; ?></title>  <!--make the page title from the words table-->
	
</head>
<body>
<?php
echo'<br />';
echo'<br />';


echo'<a href="index.php?content=forumpage">' . $words['forumhome'] . '</a><br />';  //link to forumpage.inc.php

if (isset($_SESSION['valid_recipe_user']))
	{	
		$userid = $_SESSION['valid_recipe_user'];
		//echo'<p>user id is ' . $userid;
		echo'<a href="index.php?content=post">' . $words['newthread'] . '</a><br />';
		//echo'<a href="index.php?content=logout">' . 'logout' . '</a>';
	}
else
	{
		echo'<a href="index.php?content=login"><strong>Login to Post</strong></a><br />';
	}
?>
</body>
</html>

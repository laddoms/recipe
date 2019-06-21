<?php
//$recipeid=$_POST['recipeid'];
$userid=$_POST['userid'];
$forumcomment=htmlspecialchars($_POST['forumcomment']);
$date=date("Y-m-d");
include('mysqli_connect.php');
$query="INSERT INTO forum (userid, date, forumcomment) VALUES ('$userid', '$date', '$forumcomment')";
$result=mysqli_query($dbc, $query);
if($result)
	{
		echo "<h2>Forum Comment Posted</h2>\n";
	}
else
	{
		echo "<h2>Sorry your comment was not posted.</h2>\n";
	}
echo "<a href=\"index.php?content=forum\">Return to Forum</a>\n";
?>


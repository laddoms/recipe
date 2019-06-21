<?php
$recipeid=$_POST['recipeid'];
$userid=$_POST['userid'];
$comment=htmlspecialchars($_POST['comment']);
$date=date("Y-m-d");
include('mysqli_connect.php');
$query="INSERT INTO comments (recipeid, userid, date, comment) VALUES ($recipeid, '$userid', '$date', '$comment')";
$result=mysqli_query($dbc, $query);
if($result)
	{
		echo "<h2>Comment Posted</h2>\n";
	}
else
	{
		echo "<h2>Sorry your comment was not posted.</h2>\n";
	}
echo "<a href=\"index.php?content=showrecipe&id=$recipeid\">Return to Recipe</a>\n";
?>


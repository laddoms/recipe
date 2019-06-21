<?php  //this script appears to be working
//include('mysqli_connect.php');
//$userid = $_SESSION['valid_recipe_user'];
$query="SELECT * FROM words";
$result=mysqli_query($dbc, $query);
$words=mysqli_fetch_array($result, MYSQLI_ASSOC);
echo'<br />';
//echo$words['title'];
echo'<div class="forumpost">';
if(isset($_SESSION['valid_recipe_user']))
	{
		echo'<form  enctype="multipart/form-data" action="index.php" method="post">';
		if(isset($threadid))   //to check if replying to an existing thread
			{
				echo'<h3>' . $words['postareply'] . '</h3>';
				echo'<input name="threadid" type="hidden" value="' . $threadid . '" />';
			}
		else   //build a new thread
			{
				echo'<h3>' . $words['newthread'] . '</h3>';
				echo'<p><em>' . $words['subject'] . '</em>:<input name="subject" type="text" size="60" maxlength="100" ';
				if(isset($subject))
					{
						echo"value=\"$subject\" ";
					}
				echo'/></p>';
			}
		echo'<p><em>' . $words['body'] . '</em>:<textarea name="body" rows="10" cols="60">';
		if(isset($body))
			{
				echo $body;
			}
		echo'</textarea></p></em>';
		echo'<input name="submit" type="submit" value="' . $words['submit'] . '" /></b>';
		echo "<input type=\"hidden\" name=\"content\" value=\"post\">\n";
		echo'</form></div>';

	}
else	
	{
		echo'<p>You must be logged in to post messages.</p>';
	}
?>

















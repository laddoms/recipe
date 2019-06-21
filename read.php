<?php
include('header.inc.php');
echo'<br />';
include('newforumheader.inc.php');
//include('postform.php');
$threadid=FALSE;  //flag variable set to false
if(isset($_GET['threadid'])) //&& filter_var($_GET['threadid'], FILTER_VALIDATE_INT, array('minrange' => 1)))
	{
		$threadid=$_GET['threadid']; //sets threadid variable to threadid
		$posted='posts.postedon';
		$query="SELECT threads.subject, posts.message, users.firstname, users.userid, posts.postedon FROM threads		
		LEFT JOIN posts USING (threadid) INNER JOIN users ON posts.userid=users.userid WHERE threads.threadid=$threadid ORDER BY
		posts.postedon ASC";
		$result=mysqli_query($dbc, $query);
		if(!(mysqli_num_rows($result) > 0))
			{
				$threadid=FALSE;  //set to false if query doesnt return any rows
			}
	}
if($threadid)
	{
		$printed=FALSE;
		while($row=mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
				$subject=$row['subject'];
				$message=$row['message'];
				$message=nl2br($message);
				$firstname=$row['firstname'];
				$postedon=$row['postedon'];
				$userid=$row['userid'];
				if(!$printed)
					{
						echo"<h2>" . $subject . "</h2>\n";
						$printed=TRUE;
					}
				echo"<p>Posted by: " . $firstname . " on " . $postedon . "<br />" . '"' . $message .  '" '. "</p><br />\n";
			}
		include('postform.php');
	}
else    //invalid thread id
	{
		echo'<p>This page has been accessed in error.</p>';
	}
include('footer.html');
?>
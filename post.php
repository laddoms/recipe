<?php
include('header.inc.php');
if($_SERVER['REQUEST_METHOD']== 'POST')
	{
		if(isset($_POST['threadid']) && filter_var($_POST['threadid'], FILTER_VALIDATE_INT, array('min_range'=>1)))
			{
				$threadid=$_POST['threadid']; //if threadid set then it is a reply to an existing thread
			}
		else
			{
				$threadid=FALSE;
			}
		if(!$threadid && emtpy($_POST['subject']))  //then subject is empty and user needs to enter a subject
			{
				$subject=FALSE;
				echo'<p><Please enter a subject for this post.</p>';
			}	
		elseif(!$threadid && !empty($_POST['subject']))  //has subject and is new thread
			{
				$subject=htmlspecialchars(strip_tags($_POST['subject']));  //removes any tags 
			}
		else	//thread id exists. no need for subject to be entered.
			{
				$subject=TRUE;
			}
		if(!empty($_POST['body']))
			{
				$body=htmlentities($_POST['body']);
				echo'<p>Please enter a body for this post.</p>';
			}
		if($subject && $body)
			{
				if(!$threadid)  //if there is no thread id then this must be inserted into the threads table
					{
						$query="INSERT INTO threads (userid, subject) VALUES ({$_SESSION['userid']}, '" . mysqli_real_escape_string($dbc, $subject)
						. "')";
						$result=mysqli_query($dbc, $query);
						if(mysqli_affected_rows($dbc)==1)  //if query worked then new threadid is retrievedS
							{
								$threadid=mysqli_insert_id($dbc);
							}
						else		
							{
								echo'<p>Your post could not be handled due to a system error.</p>';
							}
					}
				if($threadid)  //if thread id already exists then enter the post
					{
						$query="INSERT INTO posts (threadid, userid, message, postedon) VALUES ($threadid, {$_SESSION['userid']}, '" . 
						mysqli_real_escape_string($dbc, $body) . "', UTC_TIMESTAMP())";
						$result=mysqli_query($dbc, $query);
						if(mysqli_affected_rows($dbc) ==1)
							{
								echo'<p>Your post has been entered.</p>';
							}
						else	
							{
								echo'<p>Your post could not be handled due to a system error.</p>';
							}
					}
			}
		else	  //include the form
			{
				include('postform.php');
			}
	}
else	
	{
		include('postform.php');
	}
include('footer.html')
?>
				





















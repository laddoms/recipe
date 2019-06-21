<?php 
include('mysqli_connect.php');
$userid = $_SESSION['valid_recipe_user'];
//echo'<p>user id is ' . $userid;	
if($_SERVER['REQUEST_METHOD']=='POST')
	{
		$userid = $_SESSION['valid_recipe_user'];
		if(isset($_POST['threadid']))     //if threadid set then it is a reply to an existing thread
			{
				//echo'<p>The script is getting to the 2nd IF</p>';  //This IF is working
				$threadid=$_POST['threadid']; 
			}
		else
			{
				$threadid=FALSE;
			}
		if(!$threadid && empty($_POST['subject']))  //then subject is empty and user needs to enter a subject
			{
				//echo'<p>The script is getting to the 3rd IF</p>';  //this IF is working
				$subject=FALSE;
				echo'<p>Please enter a subject for this post.</p>';
			}	
		elseif(!$threadid && !empty($_POST['subject']))  //has subject and is new thread
			{
				$subject=htmlspecialchars($_POST['subject']);  //removes any tags 
				$subject=strip_tags($subject);
				$subject=mysqli_real_escape_string($dbc, $subject);
				echo'<p> The subject is ' . $subject . '</p>';
			}
		else	//thread id exists. no need for subject to be entered.
			{
				$subject=TRUE;
			}
		if(!empty($_POST['body']))    //scipts is working this far
			{ 
				$body=htmlspecialchars($_POST['body']);  //removes any tags 
				$body=strip_tags($body);
				//$body=mysqli_real_escape_string($dbc, $body);
				echo'<p>The body is ' . $body . '</p>';
			}
		else        //script is working this far
			{
				echo'<p>Please enter the body of your post.</p>';
				$body=FALSE;
			}
		if($subject && $body)
			{
				if(!$threadid)  //if there is no thread id then this must be inserted into the threads table
					{
						//echo'<p>user id is ' . $userid . '</p>';
						$query="INSERT INTO threads (userid, subject) VALUES ('$userid', '$subject')";
						$result=mysqli_query($dbc, $query);
						if(mysqli_affected_rows($dbc)==1)  //if query worked then new threadid is retrieved
							{
								$threadid=mysqli_insert_id($dbc);
								echo'<p>Your post has been entered.';
							}
						else		
							{
								echo'<p>Your post could not be handled due to a system error1.</p>';
							}
					}
				if($threadid)  //if thread id already exists then enter the post
					{
						$query="INSERT INTO posts (threadid, userid, message, postedon) VALUES ('$threadid', '$userid', '$body', UTC_TIMESTAMP())";
						$result=mysqli_query($dbc, $query);
						if(mysqli_affected_rows($dbc) ==1)
							{
								echo'<p>Your post has been entered.</p>';
							}
						else	
							{
								echo'<p>Your post could not be handled due to a system error2.</p>';
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
//include('footer.html')
?>
				





















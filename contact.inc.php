<html>
<head>
	<title>Contact Me</title>
</head>
<body>
	<h1>Contact Me</h1>

<?php
if($_SERVER['REQUEST_METHOD']=='POST')
	{
		if(!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['comments']))
			{
				$body="NAME: {$_POST['name']}\n\nComments: {$_POST['comments']}";
				$body=wordwrap($body, 70);
				$subject='Contact Form Submission';
				mail('addoms@localhost.com', $body, $subject, "From: {$_POST['email']}");
				echo'<p><em>Thank you for submitting the contact form.</p></em>';
				echo "<a href=\"index.php\">Return to Home</a>\n";
				$_POST=array();
			}
		else
			{
				echo'<p><b>Please fill out the form completely.</b></p>';
			}
		if(mail('addoms@localhost.com', $body, $subject))
			{
				echo"message sent successfully";
			}
		else
			{
				echo"message failed";
			}
	}

?>
<h2>Please fill out this form to contact Laurie</h2>
	<form action="contact.inc.php" method="post" target="_parent">
		<p>Name:<input type="text" name="name" size="30" maxlength="80" /></p>
		<p>Email Address:<input type="text" name="email" size="30" maxlength="80" /></p>
		<p>Comments:<textarea name="comments" rows="5" cols="30"></textarea></p>
		<p><input type="submit" name="submit" value="Send" /></p>
	</form>

</body>
</html>


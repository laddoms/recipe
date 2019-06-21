<?php
$to="addoms@localhost.com";
$subject="Test";
$body="test";
$headers="From: postmaster@localhost";

if(mail($to, $subject, $body, $headers))
	{
		echo"message sent successfully";
	}
else
	{
		echo"message failed";
	}
?>
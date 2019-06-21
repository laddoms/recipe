 <?php
include('mysqli_connect.php');
if(!$dbc)
	{
		echo"<h2>Sorry we cannot process your request at this time.</h2>\n";
		echo"<a href=\"index.php?connect=register\">Try Again</a><br />\n";
		echo"<a href=\"index.php\">Return to Homepage</a>\n";
		exit;
	}
$password=$_POST['password'];
$password2=$_POST['password2'];
$firstname=$_POST['firstname'];
$lastname=$_POST['lastname'];
$email=$_POST['email'];
$baduser=0;

// Check if email was entered
if(trim($email)== '')
	{
		echo "<h2>Sorry. You must enter a email address.</h2><br />\n";
		echo "<a href=\"index.php?content=register\">Try Again</a><br>\n";
		echo "<a href=\"index.php\">Return to Home</a>\n";
		$baduser=1;
	}

//Check for entered password
if(trim($password)=='')
	{
		 echo "<h2>Sorry, you must enter a password.</h2><br>\n";
		 echo "<a href=\"index.php?content=register\">Try again</a><br>\n";
		 echo "<a href=\"index.php\">Return to Home</a>\n";
		 $baduser = 1;
	}

//check for entered firstname
if(trim($firstname)=='')
	{
		 echo "<h2>Sorry, you must enter a first name.</h2><br>\n";
		 echo "<a href=\"index.php?content=register\">Try again</a><br>\n";
		 echo "<a href=\"index.php\">Return to Home</a>\n";
		 $baduser = 1;
	}

//check for entered last name
if(trim($lastname)=='')
	{
		 echo "<h2>Sorry, you must enter a last name.</h2><br>\n";
		 echo "<a href=\"index.php?content=register\">Try again</a><br>\n";
		 echo "<a href=\"index.php\">Return to Home</a>\n";
		 $baduser = 1;
	}
//Check if passwords match
if($password != $password2)
	{
		echo"<h2>Sorry the Passwords do not match.</h2>";
		echo "<a href=\"index.php?content=register\">Try again</a><br>\n";
		echo "<a href=\"index.php\">Return to Home</a>\n";
		$baduser = 1;
	}

//Check if email is already existing
if($baduser!=1)
	{
		$query="SELECT email FROM users WHERE email = '$email'";
		$result=mysqli_query($dbc, $query);
		$row=mysqli_fetch_array($result, MYSQL_ASSOC);
		if($row['email']==$email)
			{
				echo"<h2>Sorry the email address has already registered.</h2><br />\n";
				echo "<a href=\"index.php?content=register\">Try again</a><br>\n";
				echo "<a href=\"index.php\">Return to Home</a>\n";
				$baduser = 1;
			}
	}
if($baduser!=1)
	{
		//enter user in database
		$query="INSERT INTO users(firstname, lastname, email, password) VALUES ('$firstname', '$lastname', '$email', PASSWORD('$password'))";
		$result=mysqli_query($dbc, $query);  // or die('Sorry unable to process registration');
		if($result)
			{
				setcookie('userid');
				echo"<h2>Your registration has been approved and you can now log in and post recipes.</h2>\n";
				//echo "<a href=\"index.php\">Return to Home</a>\n";
				
			}
		else
			{
				echo"<h2>Sorry there was a problem processing your login registration.</h2>\n";
				echo "<a href=\"index.php?content=register\">Try again</a><br>\n";
				echo "<a href=\"index.php\">Return to Home</a>\n";
			}
	}

?>

























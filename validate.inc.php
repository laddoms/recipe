<?php
require('mysqli_connect.php');
$email = $_POST['email'];
$password = $_POST['password'];
$query = "SELECT userid, firstname from users where email = '$email' and password = PASSWORD('$password')";
$result = mysqli_query($dbc, $query);
$row=mysqli_fetch_array($result, MYSQL_ASSOC);
$firstname=$row['firstname'];
$userid=$row['userid'];
//echo$userid;
if (mysqli_num_rows($result) ==0)
	{
		echo "<h2>Sorry, your user account was not validated.</h2><br>\n";
		echo "<a href=\"index.php\">Return to Home</a>\n";
	} 
else
	{   
		//session_start();
		$_SESSION['valid_recipe_user'] = $userid;
		//echo 'session id: ' . session_id();
		//setcookie('userid');
		echo "<h2>Welcome " . $firstname . " You can now post recipes, comments and to the forum.</h2><br>\n";
	}
?>

<p><b>To post recipes and comments please log in below</p></b>
<div class="login">
<form action="index.php" method="post" target="_self">
	<label class="label">Email Address:</label><input type="text" size="40" name="email"><br />
	<label class="label">Password:</label><input type="password" size="40" name="password"><br /><br />
	<input type="submit" value="login">
	<input type="hidden" value="validate" name="content">
</form>
</div>
<hr>
<p><font size="1"><strong>TERMS OF USE:</strong> By logging in to this Web site you agree to abide by all rules and regulations 
set forth in the TERMS OF USE policy. No foul language is permitted in the postings at any time. Respect the opinions of 
others</font></p>

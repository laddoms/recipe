<?php 
include('header.inc.php');
if($_SERVER['REQUEST_METHOD']=='POST')
	{
		require('mysqli_connect.php');
		$errors=array();
		if(empty($_POST['email']))
			{
				$errors[]='Please enter your email address.';
			}
		else
			{
				$email=mysql_real_escape_string(trim($_POST['email']));
			}
		if(empty($_POST['password']))
			{
				$errors[]='Please enter your current password.';
			}
		else	
			{
				$password=mysqli_real_escape_string($dbc, trim($_POST['password']));
			}
		if(empty($_POST['password1']))
			{
				$errors[]='Please enter your new password.';
			}
		else	
			{
				$password1=mysqli_real_escape_string($dbc, trim($_POST['password1']));
			}
		if(!empty($_POST['password2']))
			{
				if($_POST['password1'] !=$_POST['password2'])
					{
						$errors[]='Your new password did not match the confirmed password.';
					}
				else	
					{
						$newpassword=mysqli_real_escape_string($dbc, trim($_POST['password1']));
					}
			}
		else	
			{
				$errors[]='Please enter your new password.';
			}
		if(empty($errors))
			{
				$query="SELECT userid FROM users WHERE (email='$email') && password =PASSWORD('$password') ";  //returns userid for email address entered
				$result=mysqli_query($dbc, $query);
				$num=mysqli_num_rows($result);
				if($num==1)   //email match made
					{
						$row=mysqli_fetch_array($result, MYSQLI_NUM);   
						$query="UPDATE users SET password=PASSWORD('$password1') WHERE userid=$row[0] LIMIT 1";
						$result=@mysqli_query($dbc, $query);
						if(mysqli_affected_rows($dbc)==1)
							{
								$query="SELECT firstname FROM users WHERE userid=$row[0] LIMIT 1 ";
								$result=mysqli_query($dbc, $query);
								$row=mysqli_fetch_array($result, MYSQL_ASSOC);
								$firstname=$row['firstname'];
								echo'<h2>Thank you ' . $firstname . ' Your password has been updated.</h2><br />';
								include('footer.html');
							}
						else	
							{
								echo'<h1>System Error</h1><p>Your password could not be changed at this time. Please ensure your 
									 new password and confirmed password match and you are choosing a brand new password</p><br />';
							}
						mysqli_close($dbc);
						exit();
					}
				else	
					{
						echo'<h1>Error</h1><p>The email address and password do not match those on file.</p>';
					}
			}
		else	
			{
				echo'<h1>Error</h1><p>The following errors occurred:<br />';
				foreach($errors as $msg)
					{
						echo" - $msg<br />\n";
					}
				echo'</p><p><br /></p>';
			}
	mysqli_close($dbc);
	}

?>
<h2>Change Your Password</h2>
	<div class="password"><form action="passwordchange.inc.php" method="post" class="form">
		<p><label>Email Address:</label><input type="text" name="email" size="41" maxlength="41"/></p>
		<p><label>Current Password:</label><input type="text" name="password" size="41" maxlength="41"/></p>
		<p><label>New Password:</label><input type="text" name="password1" size="41" maxlength="41"/></p>
		<p><label>Confirm new Password:</label><input type="text" name="password2" size="41" maxlength="41"/></p>
		<input type="submit" name="submit" value="Change Password"/>
	</form>
	</div>
<?php include('footer.html'); ?>
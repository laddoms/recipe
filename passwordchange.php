 <?php..
include('header.inc.php');
if($_SERVER['REQUEST_METHOD']=='POST')
	{
		$connect = mysql_connect("localhost", "ijdbUser", "") or die('Could not connect to server');
		mysql_select_db("recipe", $connect) or die('Could not connect to recipe database');
		if(empty($_POST['email']))
			{
				echo"<p>Please enter your email address.</p>";
			}
		else
			{
				$email=mysqli_real_escape_string($connect, trim($_POST['email']));
			}
		if(empty($_POST['password']
		

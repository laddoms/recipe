<?php

function redirect_user($page="index.php")
		{
			$url='http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
			$url=rtrim($url, '/\\');  //use two slashes to refer to a single backslash (//)
			$url.= '/' . $page;
			header("Location:$url");
			exit();
		}
function check_login($dbc, $email = '', $password= '')
		{
			$errors=array();
			if(empty($email))
				{
					$errors[]='Please enter your email address';    //$errors is local to this function
				}
			else
				{
					$email=mysqli_real_escape_string($dbc, trim($email));
				}
			if(empty($password))
				{
					$errors[]='Please enter your password';
				}
			else	
				{
					$password=mysqli_real_escape_string($dbc, trim($password));
				}
			if(empty($errors))
				{
					$query="SELECT userid, firstname FROM users WHERE email='$email' AND password=PASSWORD('$password')";
					$result=mysqli_query($dbc, $query);
					if(mysqli_num_rows($result) ==1)
						{
							$row=mysqli_fetch_array($result, MYSQLI_ASSOC);
							return array(true, $row);   //function stops here if user found
						}
					else		
						{
							$errors[]='The email address and password entered to not match those on file';
						}
				}
			return array(false, $errors);   //function stops here if any errors exist
		}











































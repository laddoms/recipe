<?php
//session_start();
//$recipeid = $_GET['id'];
include('mysqli_connect.php');
$query = "SELECT count(forumid) FROM forum";
$result=mysqli_query($dbc, $query);
@$row=mysqli_fetch_array($result, MYSQL_NUM);
if ($row[0]==0)
    {
        echo "No forum comments posted yet. &nbsp;&nbsp;\n";
        //echo "<a href=\"index.php?content=newcomment&id=$recipeid\">Add a comment</a><br /><br />";
        //echo "&nbsp;&nbsp;&nbsp; <a href=\"print.php?id=recipeid\" target=\"_blank\">Print Recipe</a>\n";
        echo "<br /><br />\n";
    } 
else
   {
		$totalrecords=$row[0];
		echo$totalrecords . " <b>comments posted</b>\n";
        //echo "&nbsp;&nbsp;&nbsp; <a href=\"print.php?id=recipeid\" target=\"_blank\">Print Recipe</a>\n";
		echo"<hr />\n";
        echo "<h2>Comments:</h2>\n";
		if(!isset($_GET['page']))
			{
				$thispage=1;
			}
		else	
			{
				$thispage=$_GET['page'];
			}
		$recordsperpage=5;
		$offset=($thispage-1*$recordsperpage);
		$totalpages=ceil($totalrecords/$recordsperpage);
		$query= "SELECT forum.date, forum.userid, forum.forumcomment, users.firstname FROM forum INNER JOIN users on forum.userid=users.userid ORDER BY forumid DESC "; //$offset,$recordsperpage";
        $result=mysqli_query($dbc, $query) or die('Could not retrieve comments');
        while ($row=mysqli_fetch_array($result, MYSQL_ASSOC))
            {
                $firstname=$row['firstname'];
				$date=$row['date'];
                $userid=$row['userid'];
                $forumcomment=$row['forumcomment'];
                $forumcomment=nl2br($forumcomment);
                echo  "<br />" . "<b>Posted by </b> " . $firstname . " on " . $date . "<br />\n";
                echo  '"' . $forumcomment .  '" ';
                echo "<br />\n";
            }
		//echo "<a href=\"index.php?content=newcomment&id=$recipeid\">Add a comment</a><br /><br />";
	
		if ($thispage>1)
			{
				$page=$thispage-1;
				$prevpage = "<a href=\"index.php?content=showrecipe&id=$recipeid&page=$page\">Prev</a>";
			}
		else
			{
				$prevpage="";
			}
		$bar='';
				if($totalpages>1)
			{
				for($page=1; $page<=$totalpages; $page++)
					{
						if($page==$thispage)
							{
								$bar .= " $page ";
							}
						else	
							{
								$bar .= " <a href=\"index.php?content=forum&page=$page\">$page</a> ";
							}
					}
			}
		if($thispage<$totalpages)
			{
				$page=$thispage+1;
				$nextpage = " <a href=\"index.php?content=forum&page=$page\">Next</a>";
			}
		else	
			{
				$nextpage="";
			}
		echo"Go to: " . $prevpage . $bar . $nextpage;
}


if (!isset($_SESSION['valid_recipe_user']))
	{
		//echo 'session id: ' . session_id();
		echo "<h2>Sorry, you do not have permission to post to the forum</h2><br>\n";
		echo "<a href=\"index.php?content=login\">Please login to post to the forum</a><br><br />\n";
		echo "<a href=\"index.php\">Return to Home Page</a><br />\n";
		echo"<br />";
	} 
else
	{
		//session_start();
		$userid = $_SESSION['valid_recipe_user'];
		//echo 'session id: ' . session_id();
		echo"<br /><div class='comment'>";
		echo "<form action=\"index.php\" method=\"post\">\n";
		echo "<h2>Post to the forum</h2>";
		echo "<textarea rows=\"10\" cols=\"50\" name=\"forumcomment\"></textarea><br>\n";
		echo "<input type=\"hidden\" name=\"userid\" value=\"$userid\"><br>\n";
		//echo "<input type=\"hidden\" name=\"recipeid\" value=\"$recipeid\">\n";
		echo "<input type=\"hidden\" name=\"content\" value=\"addforumcomment\">\n";
		echo "<input type=\"submit\" value=\"Add Post\">\n";
		echo "</form>\n";
		echo"</div>";
		echo"<br />";
	}
?>
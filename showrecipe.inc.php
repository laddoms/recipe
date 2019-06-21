<?php
include('mysqli_connect.php');
$recipeid=$_GET['id'];
$query="SELECT recipes.recipeid, recipes.title, recipes.ingredients, recipes.directions, recipes.image, users.userid, users.firstname FROM recipes INNER JOIN users WHERE recipeid=$recipeid ";
$result=mysqli_query($dbc, $query) or die ('Could not find the recipe');
$row=mysqli_fetch_array($result, MYSQL_ASSOC) or die ('No records retrieved');
$recipeid=$row['recipeid'];
$title=$row['title'];
$userid=$row['userid'];
$firstname=$row['firstname'];
$ingredients=$row['ingredients'];
$directions=$row['directions'];
$ingredients=nl2br($ingredients);  //puts a new line between each ingredient
$directions=nl2br($directions);    //puts a new line between directions
echo"<br />";
echo "<figure><img src=\"showimage.php?id=$recipeid\" width=\"290\" height=\"180\"></figure>";
echo "<div class=\"rightside\">";
echo "<h3>$title</h3>\n";
echo "by $firstname <br /><br />\n";
echo "<h3>Ingredients:</h3>\n";
echo "$ingredients<br />\n";
echo"</div>";
echo"<div class=\"leftside\">";
echo "<h3>Directions:</h3>\n";
echo "$directions";
echo "<br /><br />\n";
echo"</div>";

     //////comments/////

$query = "SELECT count(commentid) FROM comments WHERE recipeid = $recipeid";
$result=mysqli_query($dbc, $query);
$row=mysqli_fetch_array($result, MYSQL_NUM);
if ($row[0]==0)
    {
		echo"<div class=\"rightside\">";
        echo "No comments posted yet. &nbsp;&nbsp;\n";
        echo "<a href=\"index.php?content=newcomment&id=$recipeid\">Add a comment</a><br /><br />";
       // echo "&nbsp;&nbsp;&nbsp; <a href=\"print.php?id=recipeid\" target=\"_blank\">Print Recipe</a>\n";
        echo "<br /><br />\n";
		echo"</div>";
    } 
else
   {
		$totalrecords=$row[0];
		echo"<div class=\"leftside\">";
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
		$query= "SELECT comments.date, comments.userid, comments.comment, users.firstname FROM comments INNER JOIN users on 
				comments.userid=users.userid WHERE recipeid=$recipeid ORDER BY commentid DESC "; //$offset,$recordsperpage";
        $result=mysqli_query($dbc, $query) or die('Could not retrieve comments');
        while ($row=mysqli_fetch_array($result, MYSQL_ASSOC))
            {
                $firstname=$row['firstname'];
				$date=$row['date'];
                $userid=$row['userid'];
                $comment=$row['comment'];
                $comment=nl2br($comment);
                echo  "<br />" . "<b>Posted by </b> " . $firstname . " on " . $date . "<br />\n";
                echo  '"' . $comment .  '" ';
                echo "<br /><br />\n";
            }
		echo "<a href=\"index.php?content=newcomment&id=$recipeid\">Add a comment</a><br /><br />";
		echo"</div>";
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
								$bar .= " <a href=\"index.php?content=showrecipe&id=$recipeid&page=$page\">$page</a> ";
							}
					}
			}
		if($thispage<$totalpages)
			{
				$page=$thispage+1;
				$nextpage = " <a href=\"index.php?content=showrecipe&id=$recipeid&page=$page\">Next</a>";
			}
		else	
			{
				$nextpage="";
			}
		echo"<div class=\"leftside\">Go to: " . $prevpage . $bar . $nextpage;
		echo"</div>";
}
?>
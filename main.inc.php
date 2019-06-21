	<br /><div class="leftside">
	<br />
	<figure>
	    <img src="Maple Pumpkin Bread.jpg" alt="Maple Pumpkin Bread"/></a>
        <figcaption>Maple Pumpkin Bread</figcaption>
    </figure>
	</div>

		
<?php
echo'<br />';
echo'<div class=rightside>';
echo'<h2 align="center"> The Latest Recipes</h2>';
include('mysqli_connect.php');
$query="SELECT recipes.title, recipes.recipeid, recipes.userid, users.userid, users.firstname FROM recipes INNER JOIN users 
		ON recipes.userid=users.userid ORDER BY recipes.recipeid DESC ";
$result=mysqli_query($dbc, $query);

   if(!$result)          
	{
		echo "<h3>No recipes have been posted.</h3>";
	}
else
	{
		echo'<br />';
		while ($row=mysqli_fetch_array($result, MYSQL_ASSOC))
		{
			$recipeid=$row['recipeid'];
			$title=$row['title'];
			$userid=$row['userid'];
			$firstname=$row['firstname'];
			echo "<em><a href=\"index.php?content=showrecipe&id=$recipeid\">$title</em></a>.........Posted by: $firstname<br />\n"; //makes a link to the recipe via content variable and recipeid
		}
	}

echo'</div>';

//include('footer.html');
?>

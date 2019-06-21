<?php
    require('mysqli_connect.php');
    $search = $_GET['searchFor'];
    $words = explode(" ", $search);  //note to self. Study these.
    $phrase = implode("%' AND title LIKE '%", $words);
    $query = "SELECT recipeid, title FROM recipes WHERE title like '%$phrase%'";
    $result = mysqli_query($dbc, $query); // or die('Could not query database at this time');

    echo "<h1>Search Results</h1>\n";
    if (mysqli_num_rows($result) == 0)
		{
			echo "<h2>Sorry, no recipes were found with '$search' in them.</h2>";
		} 
	else
		{
			while($row=mysqli_fetch_array($result, MYSQL_ASSOC))
			{
				$recipeid = $row['recipeid'];  //use $row from query result to extract data from database
				$title = $row['title'];
				echo "<a href=\"index.php?content=showrecipe&id=$recipeid\">$title</a><br>\n";
			}
		}
?>
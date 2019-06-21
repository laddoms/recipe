<!DOCTYPE html5>
<html>
<head>
<link rel="stylesheet" type="text/css" href="print.css" />
<title>Print a Recipe</title>
</head>
<body>
<?php
include('mysqli_connect.php');
$recipeid=$_GET['id'];
$query="SELECT title, ingredients, directions FROM recipes WHERE recipeid=$recipeid";
$result=mysqli_query($dbc, $query) or die('Could not find recipe.');
$row=mysqli_fetch_array($result, MYSQL_ASSOC) or die('No records retrieved.');
$title=$row['title'];
//$userid=$row['userid'];
//$shortdesc=$row['shortdesc'];
$ingredients=$row['ingredients'];
$directions=$row['directions'];
$ingredients = nl2br($ingredients);
$directions = nl2br($directions);
echo"<h2>$title</h2>\n";
//echo"Posted by " . $userid . " <br />\n";
//echo $shortdesc . "\n";
echo"<h3>Ingredients: </h3>\n";
echo"$ingredients" . "<br />\n";
echo"<h3>Directions: </h3>\n";
echo $directions . "\n";
?>
</body>
</html>
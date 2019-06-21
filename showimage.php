<?php
   header("Content-type: image/jpeg");
   $recipeid = $_GET['id'];
   include('mysqli_connect.php');

   $query = "SELECT image from recipes WHERE recipeid = $recipeid";
   $result = mysqli_query($dbc, $query) or die('could not query');
   $row = mysqli_fetch_array($result, MYSQL_ASSOC);
   $image = $row['image'];
   echo $image;
?>
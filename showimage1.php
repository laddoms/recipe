<?php
   header("Content-type:image/jpeg");
   $id = $_GET['id'];
   include('mysqli_connect.php');
   $query = "SELECT image1 from pages WHERE id ='$id'";
   $result = mysqli_query($dbc, $query) or die('could not query');
   $row = mysqli_fetch_array($result, MYSQL_ASSOC);
   $image1 = $row['image1'];
   echo $image1;   
?>
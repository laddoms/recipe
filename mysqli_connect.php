<?php
DEFINE('DB_USER', 'admin');
DEFINE('DB_PASSWORD', 'kjkjkj');
DEFINE('DB_HOST', 'localhost');
DEFINE('DB_NAME', 'recipes');

$dbc=@mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die ('Could not connect to mysql');

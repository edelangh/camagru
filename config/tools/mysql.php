<?php
include ("config/database.php");

$db = new PDO("mysql:host=".$DB_DSN, $DB_USER, $DB_PASSWORD);	
if (!$db)
	header("Location:index.php?href=error_mysql");


?>
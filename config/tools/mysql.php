<?php
include_once("config/database.php");

$db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);	
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if (!$db)
	header("Location:index.php?href=error_mysql");
?>

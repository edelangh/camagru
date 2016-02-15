<?php
//$local_path = '../';
require("config/root.php");
require($root['mysql']);

function insert_user_to_db($name, $mail, $pass)
{
	$bdd->query("INSERT INTO `camagru`.`users` (`name`, `mail`, `password`) VALUES ('".$name."', '".$mail."', '".$pass."')");
}

?>
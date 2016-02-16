<?php
require("config/root.php");
require($root['mysql']);

function name_already_use($name)
{
	global $db;
	$req = $db->prepare("SELECT * FROM `camagru`.`users` WHERE name = :name");
	$req->execute(array(':name' => $name));
	$res = $req->fetchAll();
	if (empty($res))
		return false;
	else
		return true;
}

function send_token_mail($mail)
{
	$token = uniqid();
	$chaine = "gdhjsamciomklas.ndk.lmcdusailshbhdjka";
	$token = substr($chaine, rand(0, strlen($chaine) - 5), 5).$token;
	$token = sha1($token);
	$message = "Bonjour merci de cliquer sur ce lien pour valider votre compte Camagru !\nhttp://camagru.local.42.fr/camagru/index.php?href=inscription&action=validation&token=".$token;
	if (!mail($mail, "Validation de votre compte Camagru", $message))
		return false;
	else
		return $token;
}

function insert_user_to_db($name, $mail, $pass, $pass2)
{
	global $db;
	if (name_already_use($name))
	{
		header("Location:?href=inscription&error=name_use");
		exit();
	}
	if (!filter_var($mail, FILTER_VALIDATE_EMAIL))
	{
		header("Location:?href=inscription&error=bad_mail");
		exit();
	}
	if ($pass !== $pass2)
	{
		header("Location:?href=inscription&error=not_same_pass");
		exit();
	}
	if (strlen($pass) < 8)
	{
		header("Location:?href=inscription&error=small_pass");
		exit();
	}

	$token = send_token_mail($mail);
	if ($token == false)
	{
		header("Location:?href=inscription&error=err_mail");
		exit();
	}
	echo $token;
	exit();
	$req = $db->prepare("INSERT INTO `camagru`.`users` (`name`, `mail`, `password`, `token_verif`) VALUES (:name, :mail, :pass, :token)");
	$req->execute(array(
		':name' => $name,
		':mail' => $mail,
		':pass' => $pass,
		':token' => $token));
}

?>
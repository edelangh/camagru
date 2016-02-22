<?php
require("config/config.php");
require("config/root.php");
require("config/tools/mysql.php");

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

function createToken()
{
	$token = uniqid();
	$chaine = "gdhjsamciomklas.ndk.lmcdusailshbhdjka";
	$token = substr($chaine, rand(0, strlen($chaine) - 5), 5).$token;
	return sha1($token);	
}

function send_token_mail($mail)
{
	global $LIEN_SITE;
	$token = createToken();
	$message = "Bonjour merci de cliquer sur ce lien pour valider votre compte Camagru !\n".$LIEN_SITE."index.php?href=inscription&action=validation&token=".$token;
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
	$req = $db->prepare("INSERT INTO `camagru`.`users` (`name`, `mail`, `password`, `token_verif`) VALUES (:name, :mail, :pass, :token)");
	$req->execute(array(
		':name' => $name,
		':mail' => $mail,
		':pass' => sha1($pass),
		':token' => $token));
}

function valide_account($token)
{
	global $db;
	$req = $db->prepare("SELECT id,token_verif FROM `camagru`.`users` WHERE token_verif = :token");
	$req->execute(array(':token' => $token));
	$res = $req->fetchAll();
	if (empty($res))
		return false;
	else
	{
		$req = $db->prepare("UPDATE `camagru`.`users` SET token_verif = :token WHERE id= :id ");
		$req->execute(array(':token' => 'c', ':id' => $res['0']['id']));
		return true;
	}
}

function disconnect()
{
	if (isset($_SESSION['user']))
		unset($_SESSION['user']);
}

function connect($name, $password)
{
	global $db;

	$req = $db->prepare("SELECT * FROM `camagru`.`users` WHERE name = :name && password = :password");
	$req->execute(array(':name' => $name, ':password' => sha1($password)));
	$res = $req->fetchAll();
	if (empty($res) || $res[0]['token_verif'] != 'c')
		return false;
	else
	{
		$user = new userCon($res[0]['id'], $name, $res[0]['mail']);
		$_SESSION['user'] = $user->serializeClasse();

		return true;
	}
}

function sendMailReinitPassword($user)
{
	global $db;
	global $LIEN_SITE;

	$req = $db->prepare("SELECT mail FROM `camagru`.`users` WHERE name = :name");
	$req->execute(array(":name" => $user));
	$res = $req->fetchAll();
	if (empty($res))
	{
		return false;
	}
	else
	{
		$token = createToken();
		$message = "Bonjour vous avez demande une reinitialisation de votre mot de passe Camagru merci de cliquer sur ce lien pour continuer !\n".$LIEN_SITE."index.php?href=reinit_password&action=recup&token=".$token."\nSi vous n'avez pas effectue cette demande merci de l'ignorer.";
		if (!mail($res[0]['mail'], "reinitialisation de votre mot de passe Camagru", $message))
			return false;
		else
		{
			$req = $db->prepare("UPDATE `camagru`.`users` SET token_recup = :token WHERE name = :name");
			$req->execute(array(":token" => $token, ":name" => $user));
			return true;
		}
	}
}

function change_password($token, $pass, $pass2)
{
	global $db;

	if ($pass != $pass2)
	{
		header("Location:?href=reinit_password&action=recup&err=pass_diff&token=".$token);
		exit();
	}
	if (strlen($pass) < 8)
	{
		header("Location:?href=reinit_password&action=recup&err=pass_court&token=".$token);
		exit();
	}
	$req = $db->prepare("UPDATE `camagru`.`users` SET password = :pass, token_recup = :token WHERE token_recup = :tok");
	$req->execute(array(":pass" => sha1($pass), ":token" => 'c', ":tok" => "$token"));
}

function force_login()
{
	$user = false;
	if (isset($_SESSION['user']))
	{
		$user = new userCon($_SESSION['user']);
	}
	if (!$user)
	{
		header("Location: index.php?href=login");
	}
}
?>

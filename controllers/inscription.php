<?php

require_once("model/user.model.php");
if (isset($_GET['action']))
{
	if($_GET['action'] == "valide" && isset($_POST['name']) && isset($_POST['mail']) && isset($_POST['pass']) && isset($_POST['pass2']))
	{
		insert_user_to_db($_POST['name'], $_POST['mail'], $_POST['pass'], $_POST['pass2']);
		header("Location:index.php");
	}
	if ($_GET['action'] == "validation" && isset($_GET['token']))
	{
		valide_account($_GET['token']);
		header("Location:index.php");
	}
	if ($_GET['action'] == 'js' && isset($_POST['name']))
	{
		if (name_already_use($_POST['name']))
			echo "ok";
		else
			echo "nope";
	}
}
else if(isset($_GET['error']))
{
	if ($_GET['error'] == "name_use")
		echo "Ce nom d'utilisateur est deja utilise.";
	if ($_GET['error'] == "bad_mail")
		echo "Votre email n'a pas l'air valide.";
			if ($_GET['error'] == "not_same_pass")
		echo "Les mots de passe ne corresponde pas.";
	if ($_GET['error'] == "small_pass")
		echo "Votre mot de passe est trop petit.";
	if ($_GET['error'] == "err_mail")
		echo "Une erreur a ete rencontre lors de l'envois du mail.";
	require_once("view/inscription.view.php");
}
else if (!isset($_GET['clean']))
	require_once("view/inscription.view.php");

?>
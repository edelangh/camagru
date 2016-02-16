<?php

require_once("model/user.model.php");
if (isset($_GET['action']))
{
	if($_GET['action'] == "valide" && isset($_POST['name']) && isset($_POST['mail']) && isset($_POST['pass']) && isset($_POST['pass2']))
	{
		insert_user_to_db($_POST['name'], $_POST['mail'], $_POST['pass'], $_POST['pass2']);
	}
	header("Location:index.php?href=login");
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
else
	require_once("view/inscription.view.php");

?>
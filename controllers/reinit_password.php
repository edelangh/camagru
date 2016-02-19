<?php
require_once("model/user.model.php");
if(isset($_GET['err']))
{
	if ($_GET['err'] == "pass_diff")
		echo "Vos mots de passe sont differents.";
	if ($_GET['err'] == "pass_court")
		echo "Votre mot de passe est trop court.";
//	require_once("view/reinit_password.view.php");
}
if (isset($_GET['action']))
{
	if($_GET['action'] == "send_mail" && isset($_POST['name']))
	{
		sendMailReinitPassword($_POST['name']);
		header("Location:index.php");
	}
	if ($_GET['action'] == 'recup' && isset($_GET['token']))
	{
		require_once("view/choose_password.view.php");
	}
	if ($_GET['action'] == "change" && isset($_GET['token']) && isset($_POST['mdp']) && isset($_POST['mdp_conf']))
	{
		change_password($_GET['token'], $_POST['mdp'], $_POST['mdp_conf']);
		header("Location:index.php");
	}
//	header("Location:index.php");
}
else
	require_once("view/reinit_password.view.php");

?>
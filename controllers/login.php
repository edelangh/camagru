<?php
require_once("model/user.model.php");
if (isset($_GET['action']))
{
	if ($_GET['action'] == "log" && isset($_POST['name']) && isset($_POST['password']))
	{
		if (connect($_POST['name'], $_POST['password']))
		{
			header("Location:index.php");
		}
		else
		{
			echo "erreur de connection";
			require_once("view/login.view.php");
		}
	}
	else if ($_GET['action'] == "logout")
	{
		disconnect();
		header("Location:index.php");
	}
}
else
	require_once("view/login.view.php");
?>

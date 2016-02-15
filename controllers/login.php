<?php
require_once("model/user.model.php");
if (isset($_GET['action']))
{
	if($_GET['action'] == "inscription")
		insert_user_to_db("test", "test@test.test", "12345");
	header("Location:index.php?href=login");
}
else
	require_once("view/login.view.php");
?>

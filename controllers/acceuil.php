<?php
if (!isset($_SESSION['user']))
{
?>
<a href="?href=inscription">Inscription</a>
<a href="?href=login">Connection</a>
<a href="?href=reinit_password">Mot de passe oublie ?</a>

<?php
}
else
{
	?>
<a href="?href=login&action=logout">Deconnection</a>
<?php
}
if (isset($_SESSION['user']))
{
	$user = new userCon($_SESSION['user']);
	echo "bonjour ".$user->getName();
}
?>
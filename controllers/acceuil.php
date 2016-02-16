<a href="?href=inscription">Inscription</a>
<a href="?href=login">Connexion</a>

<?php

if (isset($_SESSION['user']))
{
	///echo $_SESSION['user'];
	$user = new userCon($_SESSION['user']);
	echo "bonjour ".$user->getName();
}
<head>
	<title>Camagru</title>
	<link rel="stylesheet" href="assets/styles/styles.css">
	<link rel="stylesheet" href="assets/styles/montage.css">
	<link rel="stylesheet" href="assets/styles/acceuil.css">
</head>
<body>
<div id='header'>

<a href="?href=acceuil">HOME</a>
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
<a href="?href=montage">Montage</a>
<?php
}
if (isset($_SESSION['user']))
{
	$user = new userCon($_SESSION['user']);
	echo "bonjour ".$user->getName();
}
?>
</div>
<div id='containt'>

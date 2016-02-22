<head>
	<title>Camagru</title>
	<link rel="stylesheet" href="assets/styles/styles.css">
	<link rel="stylesheet" href="assets/styles/montage.css">
	<link rel="stylesheet" href="assets/styles/acceuil.css">
</head>
<body>
<div id='header'>
<table id='header-table'>
<tr>
<td><a href="?href=acceuil"><img class="navbar-img home-img" src="assets/img/home.png"></a></td>
<?php
if (!isset($_SESSION['user']))
{
?>
<td><a href="?href=inscription">Inscription</a></td>
<td><a href="?href=login">Connection</a></td>
<td><a href="?href=reinit_password">Mot de passe oublie ?</a></td>

<?php
}
else
{
?>
<td><a href="?href=montage">Montage</a></td>
<?php
}
if (isset($_SESSION['user']))
{
	$user = new userCon($_SESSION['user']);
//	echo "bonjour ".$user->getName();
	echo '<td><a href="?href=profile">Profile</a></td>';
}
?>
<td><a href="?href=login&action=logout">Deconnection</a></td>
</tr></table>
</div>
<div id='containt'>

<head>
	<title>Camagru</title>
	<link rel="stylesheet" href="assets/styles/styles.css">
	<link rel="stylesheet" href="assets/styles/montage.css">
</head>
<body>
<div id='header'>
 HEADER

<?php
if (!isset($_SESSION['user']))
{
?>
<a href="?href=inscription">Inscription</a>
<a href="?href=login">Connection</a>

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
</div>
<div id='containt'>

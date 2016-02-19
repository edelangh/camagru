<?php

if(isset($_GET['token']))
{
?>
<form action=<?php echo "?href=reinit_password&action=change&token=".$_GET['token'];?> method="post">
	<input type="password" name="mdp" placeholder="Nouveau mot de passe">
	<input type="password" name="mdp_conf" placeholder="Verification">
	<input type="submit">
</form>

<?php
echo $_GET['token'];
}
else
	header("Location:index.php");
?>
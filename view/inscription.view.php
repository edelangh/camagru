
<div id='table-form-div'>
	<h2>Inscription</h2>
	<form id="tableInscription" action="?href=inscription&action=valide" method="post">
		<table id='table-form'>
			<tr><td>Login</td><td><input id="login" type="text" name="name" placeholder="Nom d'utilisateur" onBlur="checkUserName();"></td></tr>
			<tr><td>Mail</td><td><input type="text" name="mail" placeholder="Email"></td></tr>
			<tr><td>Mot de passe</td><td><input type="password" name="pass" placeholder="Mot de passe" id="pass1" onBlur="checkpass('pass1');"></td></tr>
			<tr><td>Verification mdp</td><td><input type="password" name="pass2" id="pass2" placeholder="Verification du mot de passe" onBlur="checkpass('pass2');"></td></tr>
			<tr><td colspan='2'><center><input type="submit" value="s'inscrire"></center></td></tr>
		</table>
	</form>
</div>

<script type='text/javascript' src='assets/js/inscription.js'></script>
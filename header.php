<div id="header">
		<img src="img/logo.png" alt="logo" />
	
	<h2> Dare and get known ! </h2>
		<?php 
		// Si l'utilisateur est connecté : afficher quelques informations (pseudo, lien vers 'mon profil', deconnexion...)
		?>
		
		<?php
		// Sinon : champ de connexion (Pseudo - Mot de passe) + lien d'inscription
		?>
	
	<form method="post" action="members/signin.php">
		<label for="pseudo">Username :</label>   <input type="text" name="pseudo" id="pseudo" /> 
		<br />
		<label for="pass">Password :</label> <input type="password" name="pass" id="pass" />
		<br />
		<input type="submit" value="Login" />
	</form>
		
	<a href="signup.php">Create Account</a>
</div>

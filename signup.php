<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Titre</title>
    </head>
		<body>
			<?php include('header.php');  ?>
			
			<div id="content">
			<br />
			<br />
				<form method="post" action="signupaction.php">
					<label for="pseudo">Username :</label>   <input type="text" name="pseudo" id="pseudo" /> 
					<br />
					<label for="mail">E-mail adress :</label>   <input type="text" name="mail" id="mail" /> 
					<br />
					<label for="pass">Password :</label> <input type="password" name="pass" id="pass" />
					<br />
					<label for="sex">Sex :</label>
					<select name="sex">
						<option value="Male">Male</option>
						<option value="Female">Female</option>
					</select>
					<br />
					<input type="submit" value="Create my profile !" />
				</form>
				<br />
				<br />
			</div>
			
			<?php include('footer.php'); ?>
    </body>
</html>

<?php
require_once('config.php');
require_once('Member.php');

class Members
{
    /*
    * if $mode = true or no arg given, return the last three profiles created
    * if $mode = false, return three random profile
    * A profile is defined by an array with two keys : image, pseudo
    */
    public static function getFrontProfiles($mode = true)
    {
       	// Connexion to the DB
		$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	   	try {
			$bdd = new PDO(DSN, DB_USERNAME, DB_PASSWORD, $pdo_options);
		}
		catch (PDOException $e) {
			echo 'Connexion failed : ' . $e->getMessage();
			exit();
		}
		
		// Select the correct request
		if($mode == true) {
			$answer = $bdd->prepare('SELECT pseudo, image FROM Member ORDER BY idMember DESC LIMIT 3');
		}
		else {
			$answer = $bdd->prepare('SELECT pseudo, image FROM Member ORDER BY RAND() LIMIT 3');	
		}
		$answer->execute();
		
		// Create an array of profiles corresponding to the request
		while($data = $answer->fetch())
		{
			// If the member didn't give an image for his profile, put a default picture
			if($data['image'] == null)
				$data['image'] = 'http://img7.xooimage.com/files/f/c/4/stouffr-holiday-tux-4a156e.png';

			$profiles[] = array(
						'pseudo'	=> $data['pseudo'],
						'image'		=> $data['image']
						);
		}				
		$answer->closeCursor();

		return $profiles;	
	}

	/*
	Return true if the pseudo is already taken
	*/
	public static function isPseudoTaken($pseudo) {
		// Connexion to the DB
       	$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	   	try {
			$bdd = new PDO(DSN, DB_USERNAME, DB_PASSWORD, $pdo_options);
		}
		catch (PDOException $e) {
			echo 'Connexion failed : ' . $e->getMessage();
			exit();
		}
		
		// Look for the given pseudo
		$req = $bdd->prepare('SELECT idMember FROM Member WHERE pseudo = :pseudo');
		$req->execute(array('pseudo' => $pseudo));
		// If a match is found return true
		if($req->fetch()) {
			$req->closeCursor();
			return true;
		}
		// If the pseudo isn't used, return false
		else {
			$req->closeCursor();
			return false;
		}	
	}	

	/*
	Return true if the email is already taken
	*/
	public static function isMailTaken($email) {
		// Connexion to the DB
       	$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	   	try {
			$bdd = new PDO(DSN, DB_USERNAME, DB_PASSWORD, $pdo_options);
		}
		catch (PDOException $e) {
			echo 'Connexion failed : ' . $e->getMessage();
			exit();
		}
		
		// Look for the given email
		$req = $bdd->prepare('SELECT idMember FROM Member WHERE email = :email');
		$req->execute(array('email' => $email));

		// If a match is found return true
		if($req->fetch()) {
			$req->closeCursor();
			return true;
		}
		// If the email isn't used, return false
		else {
			$req->closeCursor();
			return false;
		}	
	}

    /*
    * If username and password is in database, return TRUE. Otherwise, return false
    */ 
    public static function signIn($username, $password)
    {
		// Connexion to the DB
       	$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	   	try {
			$bdd = new PDO(DSN, DB_USERNAME, DB_PASSWORD, $pdo_options);
		}	
		catch (PDOException $e) {
			echo 'Connexion failed : ' . $e->getMessage();
			exit();
		}
		// Check if the combination username/password is in the DB
	   	$answer = $bdd->prepare('SELECT idMember FROM Member WHERE pseudo = :pseudo AND password = :password');

	   	$answer->execute(array(
	   						'pseudo' 	=> $username,
	   						'password'	=> $password
							));
		// Return true if the user is found, false if it isn't
		if($answer->fetch()) {
			$answer->closeCursor();
			return true;
		}
		else {
			$answer->closeCursor();
			return false;
		}
    }
    
    /*
    * Return an array of all members stored in database. If $number is different from 0, 
    limit the size of the array
    */
    public static function getAll($number = 0)
    {
        // Connexion to the DB
       	$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	   	try {
			$bdd = new PDO(DSN, DB_USERNAME, DB_PASSWORD, $pdo_options);
		}
		catch (PDOException $e) {
			echo 'Connexion failed : ' . $e->getMessage();
			exit();
		}
		// Select the appropriate request
		if($number > 0) {
			$answer = $bdd->prepare('SELECT pseudo FROM Member LIMIT ?');
			$answer->execute($number);
		}		
		else {
			$answer = $bdd->prepare('SELECT pseudo FROM Member');
			$answer->execute();
		}
		// Create an array with the number of members asked
		while($data = $answer->fetch())
		{
			$allMembers[] = new Member($data['pseudo']);
		}
		$answer->closeCursor();

		return $allMembers;
    }
    
    /*
    Delete the given member, if $idMember is not empty
    */
    public static function delete($idMember)
    {
		if($idMember != null) {	
			// Connexion to the DB
       		$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	   		try {
				$bdd = new PDO(DSN, DB_USERNAME, DB_PASSWORD, $pdo_options);
			}
			catch (PDOException $e) {
				echo 'Connexion failed : ' . $e->getMessage();
				exit();
			}
			// Delete the member from the id given
			$req = $bdd->prepare('DELETE FROM Member WHERE idMember = ?');
			$req->execute($idMember);

			$req->closeCursor();
		}
    }
}

<?php
require_once('config.php');
require_once('Member.php');

class Members
{
    /*
    * if $mode = true or no arg given, return the last three profiles created
    * if $mode = false, return three random profile
    * A profile is defined by an array with two keys : image, username
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
			$answer = $bdd->prepare('SELECT username, image FROM Member ORDER BY idMember DESC LIMIT 3');
		}
		else {
			$answer = $bdd->prepare('SELECT username, image FROM Member ORDER BY RAND() LIMIT 3');	
		}
		$answer->execute();
		
		// Create an array of profiles corresponding to the request
		while($data = $answer->fetch())
		{
			// If the member didn't give an image for his profile, put a default picture
			if($data['image'] == null)
				$data['image'] = 'http://img7.xooimage.com/files/f/c/4/stouffr-holiday-tux-4a156e.png';

			$profiles[] = array(
						'username'	=> $data['username'],
						'image'		=> $data['image']
						);
		}				
		$answer->closeCursor();

		return $profiles;	
	}

	/*
	Return true if the username is already taken
	*/
	public static function isUserNameTaken($username) {
		// Connexion to the DB
       	$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	   	try {
			$bdd = new PDO(DSN, DB_USERNAME, DB_PASSWORD, $pdo_options);
		}
		catch (PDOException $e) {
			echo 'Connexion failed : ' . $e->getMessage();
			exit();
		}
		
		// Look for the given username
		$req = $bdd->prepare('SELECT idMember FROM Member WHERE username = :username');
		$req->execute(array('username' => $username));
		// If a match is found return true
		if($req->fetch()) {
			$req->closeCursor();
			return true;
		}
		// If the username isn't used, return false
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
	   	$answer = $bdd->prepare('SELECT idMember FROM Member WHERE username = :username AND password = :password');

	   	$answer->execute(array(
	   						'username' 	=> $username,
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
			$answer = $bdd->prepare('SELECT username FROM Member ORDER BY idMember DESC LIMIT :number');
			$answer->bindParam(':number', $number, PDO::PARAM_INT); // Avoid $number to be considered as a string
			$answer->execute(); 
		}		
		else {
			$answer = $bdd->prepare('SELECT username FROM Member');
			$answer->execute();
		}
		// Create an array with the number of members asked
		while($data = $answer->fetch())
		{
			$allMembers[] = new Member($data['username']);
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
			$req->execute(array($idMember));

			$req->closeCursor();
		}
    }
}

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
        // SELECT
       	$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	   	try {
			$bdd = new PDO(DSN, DB_USERNAME, DB_PASSWORD, $pdo_options);
		}
		catch (PDOException $e) {
			echo 'Connexion failed : ' . $e->getMessage();
			exit();
		}
		
		if($mode == true) {
			$answer = $bdd->prepare('SELECT pseudo, image FROM Member ORDER BY idMember DESC LIMIT 3');
		}
		else {
			$answer = $bdd->prepare('SELECT pseudo, image FROM Member ORDER BY RAND() LIMIT 3');	
		}
		$answer->execute();

		while($data = $answer->fetch())
		{
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
    * If username and password is in database, return TRUE. Otherwise, return false
    */ 
    public static function signIn($username, $password)
    {
       	$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	   	try {
			$bdd = new PDO(DSN, DB_USERNAME, DB_PASSWORD, $pdo_options);
		}	
		catch (PDOException $e) {
			echo 'Connexion failed : ' . $e->getMessage();
			exit();
		}
			
	   	$answer = $bdd->prepare('SELECT idMember FROM Member WHERE pseudo = :pseudo AND password = :password');

	   	$answer->execute(array(
	   						'pseudo' 	=> $username,
	   						'password'	=> $password
							));
		
		if($answer->rowCount() > 0) {
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
        // SELECT
       	$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	   	try {
			$bdd = new PDO(DSN, DB_USERNAME, DB_PASSWORD, $pdo_options);
		}
		catch (PDOException $e) {
			echo 'Connexion failed : ' . $e->getMessage();
			exit();
		}

		if($number > 0) {
			$answer = $bdd->prepare('SELECT pseudo FROM Member LIMIT ?');
			$answer->execute($number);
		}		
		else {
			$answer = $bdd->prepare('SELECT pseudo FROM Member');
			$answer->execute();
		}

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
        // DELETE
		if($idMember != null) {	
       		$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	   		try {
				$bdd = new PDO(DSN, DB_USERNAME, DB_PASSWORD, $pdo_options);
			}
			catch (PDOException $e) {
				echo 'Connexion failed : ' . $e->getMessage();
				exit();
			}
			
			$req = $bdd->prepare('DELETE FROM Member WHERE idMember = ?');
			$req->execute($idMember);

			$req->closeCursor();
		}
    }
}

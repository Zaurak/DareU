<?php

require_once('config.php');
require_once('Member.php');
require_once('Update.php');
/*
* Represent a profile page we can see : attached to a member and to updates
*/
class Profile
{
    // Member type
    private $member;
    
    // Array of Update objects
    private $updates;
    
    /*
    Fill all properties thanks to the database
    */
    public function __construct($idMember)
    {
        // Connexion to the DB
		$pdo_options[PDO::ATTR__ERRMODE] = PDO::ERRMODE_EXCEPTION;
		try {
			$bdd = new PDO(DSN, DB_USERNAME, DB_PASSWORD, $pdo_options);
		}
		catch(PDOException $e) {
			echo 'Connexion Failed : ' . $e->getMessage();
			exit();
		}
		
		// Select the member from the given id
		$answer = $bdd->prepare('SELECT pseudo FROM Member WHERE idMember = ?');
		$answer->execute($idMember);
		
		if($data = $answer->fetch()) 
		{
			$this->member = new Member($data['pseudo']);
		}
		$answer->closeCursor();
		
		// Select the updates done by the member
		$answer = bdd->prepare('SELECT idUpdate FROM Update WHERE idMember = ?');
		$answer->execute($idMember);

		while($data = $answer->fetch())
		{
			$this->updates[] = new Update(data['idUpdate']);	
		}
		$answer->closeCursor();
    } 
}

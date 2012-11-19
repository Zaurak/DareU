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
    public $member;
    
    // Array of Update objects
    public $updates;
    
    /*
    Fill all properties thanks to the database
    */
    public function __construct($idMember)
    {
        // Member initialisation
		$pdo_options[PDO::ATTR__ERRMODE] = PDO::ERRMODE_EXCEPTION;
		$bdd = new PDO('DSN', 'DB_USERNAME', 'DB_PASSWORD', $pdo_options);
		
		$answer = $bdd->prepare('SELECT pseudo FROM Member WHERE idMember = ?');
		$answer->execute($idMember);
		
		if($data = $answer->fetch()) 
		{
			$this->member = new Member($data['pseudo']);
		}
		$answer->closeCursor();
		
		// Updates initialisation
		$answer = bdd->prepare('SELECT idUpdate FROM Update WHERE idMember = ?');
		$answer->execute($idMember);

		while($data = $answer->fetch())
		{
			$this->updates[] = new Update(data['idUpdate']);	
		}
		$answer->closeCursor();
    } 
}

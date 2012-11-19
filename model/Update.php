<?php
require_once('config.php');
class Update 
{
    // put here the names of fields
	public $idUpdate;
	public $content;
	public $date;
	public $service;
	public $idMember;

	/* 
	Update constructor
	Fill the fields from a given id
	*/
	public function __construct($idUpdate)
	{
		$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		try {
			$bdd = new PDO(DSN, DB_USERNAME, DB_PASSWORD, $pdo_options);
		}
		catch(PDOException $e) {
			echo 'Connexion Failed : ' . $e->getMessage();
			exit();
		}
		
		$answer = bdd->prepare('SELECT * FROM Update WHERE idUpdate = ?');
		$answer->execute($idUpdate);
		
		if($data = $answer->fetch()) {
			$this->idUpdate	= data['idUpdate'];
			$this->content	= data['content'];
			$this->date		= data['date'];
			$this->service	= data['service'];
			$this->idMember	= data['idMember'];
		}
		$answer->closeCursor();
	}

    /*
    Save the update into the database, if the id property is null, create a new Update
    If not, just update it
    */
    public function save()
    {
        // INSERT, UPDATE
		$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		try {
			$bdd = new PDO(DSN, DB_USERNAME, DB_PASSWORD, $pdo_options);
		}
		catch(PDOException $e) {
			echo 'Connexion Failed : ' . $e->getMessage();
			exit();
		}

		if(empty($this->idUpdate)) {
			$req = $bdd->prepare('INSERT INTO Member(content, date, service, idMember) VALUES(:content, :date, :service, :idMember');

			$req->execute(array(
					'content'		=> $this->content,
					'date'			=> $this->date,
					'service'		=> $this->service,
					'idMember'		=> $this->idMember
					));
		}
		else {
			$req = $bdd->prepare('UPDATE Member SET content = :content, date = :date, service = :service, idMember = :idMember WHERE idUpdate = :idUpdate');

			$req->execute(array(
					'content'		=> $this->content,
					'date'			=> $this->date,
					'service'		=> $this->service,
					'idMember'		=> $this->idMember,
					'idUpdate'		=> $this->idUpdate
					));
		}
		$req->closeCursor();    
    }
}

<?php
require_once('config.php');
class Comment
{
    // put here the names of fields
	private $idComment			= 0;    
	private $content;
	private $date;
	private $idUpdate;
	private $idMember;
 	
	public function __construct($idComment)
	{
		$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		try {
			$bdd = new PDO(DSN, DB_USERNAME, DB_PASSWORD, $pdo_options);
		}
		catch(PDOException $e) {
			echo 'Connexion Failed : ' . $e->getMessage();
			exit();
		}
			
		$answer = $bdd->prepare('SELECT * FROM Comment WHERE idComment = :idComment');
		$answer->bindParam(':idComment', $idComment, PDO::PARAM_INT);
		$answer->execute();

		if($data = $answer->fetch()) {
			$this->idComment	= $data['idComment'];
			$this->content		= $data['content'];
			$this->date			= $data['date'];
			$this->idUpdate		= $data['idUpdate'];
			$this->idMember		= $data['idMember'];
		}
		$answer->CloseCursor();
	}

    /*
    Save the update into the database, if the id property is null, create a new comment
    If not, just update it
    */
    public function save()
    {
		// Connexion to the DB
		$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		try {
			$bdd = new PDO(DSN, DB_USERNAME, DB_PASSWORD, $pdo_options);
		}
		catch(PDOException $e) {
			echo 'Connexion Failed : ' . $e->getMessage();
			exit();
		}
		// If the comment haven't been saved yet
		if($this->idComment == 0) {
			// Create the comment
			$req = $bdd->prepare('INSERT INTO Comment(content, date, idUpdate, idMember) VALUES(:content, :date, :idUpdate, :idMember)');
			
			$req->execute(array(
					'content'		=> $this->content,
					'date'			=> $this->date,
					'idUpdate'		=> $this->idUpdate,
					'idMember'		=> $this->idMember
					));
		}
		// If the comment already exists
		else {
			// Update it with new values
			$req = $bdd->prepare('UPDATE Comment SET content = :content, date = :date, idUpdate = :idUpdate, idMember = :idMember WHERE idComment = :idComment');
			
			$req->execute(array(
					'content'		=> $this->content,
					'date'			=> $this->date,
					'idUpdate'		=> $this->idUpdate,
					'idMember'		=> $this->idMember,
					'idComment'		=> $this->idComment
					));
		}
		$req->closeCursor();    
    }

	public function setContent($content) {
		$this->content = $content;
	}

	public function getContent() {
		return $this->content;
	}

	public function setDate($date) {
		$this->date = $date;
	}

	public function getDate() {
		return $this->date;
	}

	public function setIdUpdate($idUpdate) {
		$this->idUpdate = $idUpdate;
	}

	public function setIdMember($idMember) {
		$this->idMember = $idMember;
	}
}

<?php
require_once('config.php');
class Update 
{
    // put here the names of fields
	private $idUpdate 	= 0;
	private $content;
	private $date;
	private $service;
	private $idMember;
	private $comments;

	/* 
	Update constructor
	Fill the fields from a given id
	*/
	public function __construct($idUpdate = -1)
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
		
		// Select the update from the given id
		$answer = $bdd->prepare('SELECT * FROM Updates WHERE idUpdate = :id');
		$answer->bindParam(':id', $idUpdate, PDO::PARAM_INT);
		$answer->execute();
		
		if($data = $answer->fetch()) {
			$this->idUpdate	= $data['idUpdate'];
			$this->content	= $data['content'];
			$this->date		= $data['date'];
			$this->service	= $data['service'];
			$this->idMember	= $data['idMember'];
		}
		$answer->closeCursor();
	
		$answer = $bdd->prepare('SELECT idComment FROM Comment WHERE idUpdate = :idUpdate AND idMember = :idMember ORDER BY date');
		$answer->execute(array(
								'idUpdate' => $this->idUpdate,
								'idMember' => $this->idMember
								)
						);
		while($data = $answer->fetch()) {
			$this->comments[] = new Comment($data['idComment']);
		}
		$answer->closeCursor();
	}

    /*
    Save the update into the database, if the id property is null, create a new Update
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
		// If the update hasn't been saved in the DB yet
		if($this->idUpdate == 0) {
			// Insert the update in the DB
			$req = $bdd->prepare('INSERT INTO Updates(content, date, service, idMember) VALUES(:content, :date, :service, :idMember)');

			$req->execute(array(
					'content'		=> $this->content,
					'date'			=> $this->date,
					'service'		=> $this->service,
					'idMember'		=> $this->idMember
					));
		}
		// If the update already is in the DB
		else {
			// Update the update
			$req = $bdd->prepare('UPDATE Updates SET content = :content, date = :date, service = :service, idMember = :idMember WHERE idUpdate = :idUpdate');

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
	
	static public function testUrl($url) {
		$url = @parse_url($url); 
		if (!$url) return false; 
 
		$url = array_map('trim', $url); 
 		$url['port'] = (!isset($url['port'])) ? 80 : (int)$url['port']; 
  
  		$path = (isset($url['path'])) ? $url['path'] : '/'; 
  		$path .= (isset($url['query'])) ? "?$url[query]" : ''; 
   
   		if (isset($url['host']) && $url['host'] != gethostbyname($url['host'])) { 
    
	    	$fp = fsockopen($url['host'], $url['port'], $errno, $errstr, 30); 
		  
		    if (!$fp) 
				return false; //socket not opened
				 
		   	fputs($fp, "HEAD $path HTTP/1.1\r\nHost: $url[host]\r\n\r\n"); //socket opened
			$headers = fread($fp, 4096); 
			fclose($fp); 
										  
			if(preg_match('#^HTTP/.*\s+[(200|301|302)]+\s#i', $headers)){//matching header
				return true; 
			} 
			else return false;
						  
		} // if parse url
		else return false;
	}
	

	static public function getLikes($username) {
		$url = 'http://vimeo.com/api/v2/' . $username . '/likes.xml';
		
		if(Update::testUrl($url)) {
			$xml = file_get_contents($url);

			return simplexml_load_string($xml);
		}
	}
	
	/**
	 * Get the date of the last vimeo video liked by the user that was registered in the DB
	 */
	static public function getLastTimeVimeo($idMember) {
        // Connexion to the DB
		$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		try {
			$bdd = new PDO(DSN, DB_USERNAME, DB_PASSWORD, $pdo_options);
		}
		catch(PDOException $e) {
			echo 'Connexion Failed : ' . $e->getMessage();
			exit();
		}
		$req = $bdd->prepare('SELECT date FROM Updates WHERE service = "vimeo" AND idMember = ? ORDER BY date DESC');
		$req->execute(array($idMember));

		if($data = $req->fetch()) 
			return $data['date'];
		else
			return null;
	}

	public function getIdUpdate() {
		return $this->idUpdate;
	}

	public function getContent() {
		return $this->content;
	}

	public function setContent($content) {
		$this->content = $content;
	}

	public function getDate() {
		return $this->date;
	}

	public function setDate($date) {
		$this->date = $date;
	}

	public function getService() {
		return $this->service;
	}

	public function setService($service) {
		$this->service = $service;
	}

	public function setIdMember($idMember) {
		$this->idMember = $idMember;
	}

	public function getIdMember() {
		return $this->idMember;
	}

	public function getComments() {
		return $this->comments;
	}


	static public function deleteUpdate($idUpdate) {
        // Connexion to the DB
		$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		try {
			$bdd = new PDO(DSN, DB_USERNAME, DB_PASSWORD, $pdo_options);
		}
		catch(PDOException $e) {
			echo 'Connexion Failed : ' . $e->getMessage();
			exit();
		}

		$req = $bdd->prepare('DELETE FROM Updates WHERE idUpdate = ?');
		$req->execute(array($idUpdate));
		$req->closeCursor();
	}

}

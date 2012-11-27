<?php
require_once ('config.php');
class Member
{
	private $idMember 	= 0;
	private $username;
	private $email;
	private $password;
	private $sex;
	private $isAdmin 	= 0;
	private $desc 		= 'No description';
	private $image 		= '';
	private $website 	= '';
	
    /*
    If the username is not null, get the data from database and fill the properties
    If the username is null, do nothing
    */
    public function __construct($username = NULL) 
	{
		if($username != NULL)
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
			// Get the member information from his user name
			$answer = $bdd->prepare('SELECT * FROM Member WHERE username = :username');

			$answer->execute(array('username' => $username));
			
			if($data = $answer->fetch()) {

				$this->idMember 	=	$data['idMember'];
				$this->username		=	$data['username'];
				$this->email		=	$data['email'];
				$this->password		=	$data['password'];
				$this->sex			=	$data['sex'];
				$this->isAdmin		=	$data['isAdmin'];
				$this->desc			=	$data['description'];
				$this->image		=	$data['image'];
				$this->website		=	$data['website'];	
			}
			$answer->closeCursor();
		}
    }
	
	public function getId() {
		return $this->idMember;
	}

	public function getUserName() {
		return $this->username;
	}

	public function setUserName($username) {
		$this->username = $username;
	}

	public function getEmail() {
		return $this->email;
	}

	public function setEmail($email) {
		$this->email = $email;
	}
	
	public function getPassword() {
		return $this->password;
	}

	public function setPassword($password) {
		$this->password = $password;
	}

	public function getSex() {
		return $this->sex;
	}

	public function setSex($sex) {
		$this->sex = $sex;
	}
	
	public function getWebsite() {
		return $this->website;
	}
	
	public function setWebsite($website) {
		$this->website = $website;
	}

	public function getDescription() {
		return $this->desc;
	}

	public function setDescription($desc) {
		$this->desc = $desc;
	}
	
/*
    Save the member into the database. If the id property is null, create a new member
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
		// If the member hasn't been saved yet
		if($this->idMember == 0) {
			// Insert the current member in the DB 
			$req = $bdd->prepare('INSERT INTO Member(username, email, password, sex, isAdmin, description, image, website) VALUES (:username, :email, :password, :sex, :isAdmin, :description, :image, :website)');	

			$req->execute(array(
					'username'		=> $this->username,
					'email'			=> $this->email,
					'password'		=> $this->password,
					'sex'			=> $this->sex,
					'isAdmin'		=> $this->isAdmin,
					'description'	=> $this->desc,
					'image'			=> $this->image, 
					'website'		=> $this->website
					));
		}
		// If the current member already is in the DB
		else {
			// Update his informations
			$req = $bdd->prepare('UPDATE Member SET username = :username, email = :email, password = :password, sex = :sex, isAdmin = :isAdmin, description = :description, image = :image, website = :website WHERE idMember = :idMember');

			$req->execute(array(
					'username'		=> $this->username,
					'email'			=> $this->email,
					'password'		=> $this->password,
					'sex'			=> $this->sex,
					'isAdmin'		=> $this->isAdmin,
					'description'	=> $this->desc,
					'image'			=> $this->image,
					'website'		=> $this->website,
					'idMember'		=> $this->idMember
					));
		}
		$req->closeCursor();
    }
    
    /* is the current member admin ? */
    public function isAdmin()
    {
		// If the properties are filled
		if(!empty($this->username))
		{
			return $this->isAdmin;
		}	
    }    
    

}

<?php
require_once ('config.php');
class Member
{
    // put properties here
	public $idMember;
	public $pseudo;
	public $email;
	public $password;
	public $sex;
	public $isAdmin;
	public $description;
	public $image;
	public $website;
	
    /*
    If the pseudo is not null, get the data from database and fill the properties
    If the pseudo is null, do nothing
    */
    public function __construct($pseudo = NULL) 
	{
		if($pseudo != NULL)
		{
			$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
			try {
				$bdd = new PDO(DSN, DB_USERNAME, DB_PASSWORD, $pdo_options);
			}
			catch(PDOException $e) {
				echo 'Connexion Failed : ' . $e->getMessage();
				exit();
			}

			$answer = $bdd->prepare('SELECT * FROM Member WHERE pseudo = :pseudo');

			$anwer->execute(array('pseudo' => $pseudo));
			
			if($data = $answer->fetch()) {

				$this->idMember 	=	$data['idMember'];
				$this->pseudo		=	$data['pseudo'];
				$this->email		=	$data['email'];
				$this->password		=	$data['password'];
				$this->sex			=	$data['sex'];
				$this->isAdmin		=	$data['isAdmin'];
				$this->description	=	$data['description'];
				$this->image		=	$data['image'];
				$this->website		=	$data['website'];	
			}
			$answer->closeCursor();
		}
    }
    
    /*
    Save the member into the database. If the id property is null, create a new member
    If not, just update it
    */
    public function save()
    {
        //UPDATE & INSERT
		$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		try {
			$bdd = new PDO(DSN, DB_USERNAME, DB_PASSWORD, $pdo_options);
		}
		catch(PDOException $e) {
			echo 'Connexion Failed : ' . $e->getMessage();
			exit();
		}

		if(empty($this->idMember)) {
			$req = $bdd->prepare('INSERT INTO Member(pseudo, email, password, sex, isAdmin, description, image, website) VALUES(:pseudo, :email, :password, :sex, :isAdmin, :description, :image, :website');

			$req->execute(array(
					'pseudo'		=> $this->pseudo,
					'email'			=> $this->email,
					'password'		=> $this->password,
					'sex'			=> $this->sex,
					'isAdmin'		=> $this->isAdmin,
					'description'	=> $this->description,
					'image'			=> $this->image, 
					'website'		=> $this->website
					));
		}
		else {
			$req = $bdd->prepare('UPDATE Member SET pseudo = :pseudo, email = :email, password = :password, sex = :sex, isAdmin = :isAdmin, description = :description, image = :image, website = :website WHERE idMember = :idMember');

			$req->execute(array(
					'pseudo'		=> $this->pseudo,
					'email'			=> $this->email,
					'password'		=> $this->password,
					'sex'			=> $this->sex,
					'isAdmin'		=> $this->isAdmin,
					'description'	=> $this->description,
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
		if(!empty($this->pseudo))
		{
			return $this->isAdmin;
		}	
    }    
    

}

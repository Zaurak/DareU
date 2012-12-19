<?php

require_once dirname(__FILE__) . '/../lightmvc/ActionController.php';
require_once dirname(__FILE__) . '/../model/Member.php';
require_once dirname(__FILE__) . '/../model/Members.php';
require_once dirname(__FILE__) . '/../model/Profile.php';

class ProfileController extends ActionController
{
    /**
     * Simple index page which links to the main available actions
     */
    public function indexAction()
    {
        // Do nothing
    }
    
    /**
     *  Edit the profile of the logged member
     */
    public function editAction()
    {
		// If the user is not logged in
		if(!isset($_SESSION['connected']) || $_SESSION['connected'] == false) {
			$this->redirect('/');
		}
		else {
			$member = new Member($_SESSION['username']);
			// Form submitted
			if(isset($_POST['username'])) {
				if(!Members::isUserNameTaken($_POST['username'])) {
					$_SESSION['username'] = $_POST['username'];
				
					$member->setUserName($_POST['username']);
					$member->setDescription($_POST['description']);
					$member->setWebsite($_POST['website']);

					$member->save();
					$this->message = '';
				}
				else {
					$this->message = 'User Name already taken';
				}
			}
			$this->username	= $member->getUserName();
			$this->desc		= $member->getDescription();
			$this->website 	= $member->getWebsite();
		}
    }	
    
    /**
     * Add a like  
     */
    public function addAction()
    {
		// If the user is not logged in
		if(!isset($_SESSION['connected']) || $_SESSION['connected'] == false) {
			$this->redirect('/');
		}
		else {
	        if(isset($_POST['content']) && $_POST['content'] != null) {
				$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
				try {
					$bdd = new PDO(DSN, DB_USERNAME, DB_PASSWORD, $pdo_options);
				}
				catch(PDOException $e) {
					echo 'Connexion Failed : ' . $e->getMessage();
					exit();
				}
				// Insert new update
				$answer = $bdd->prepare('INSERT INTO Updates(content, date, service, idMember) VALUES(:content, :date, :service, :idMember)');
				$answer->execute(array(
									'content'	=>	$_POST['content'],
									'date'		=>	date('Y-m-d'),
									'service'	=>  'text',
									'idMember'	=>	$_SESSION['idMember']
									)
								);
				$answer->closeCursor();
				$this->redirect('/profile/view?id=' . $_SESSION['idMember']);
			}
		}
    }
    
	public function deleteAction() 
	{
		// If the user is not logged in
		if(!isset($_SESSION['connected']) || $_SESSION['connected'] == false) {
			$this->redirect('/');
		}
		else {
		
		}
    }
        
    /**
     * show the profile
     */
    public function viewAction()
    {
		if(isset($_GET['id']) && $_GET['id'] != null) {
			$this->profile = new Profile($_GET['id']);	
		}
    }
    
    
}

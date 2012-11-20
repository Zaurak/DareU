<?php

require_once dirname(__FILE__) . '/../lightmvc/ActionController.php';
require_once dirname(__FILE__) . '/../model/Member.php';

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
			$member = new Member($_SESSION['pseudo']);
			// Form submitted
			if(isset($_POST['pseudo'])) {
				$_SESSION['pseudo'] = $_POST['pseudo'];
				
				$member->setPseudo($_POST['pseudo']);
				$member->setDescription($_POST['description']);
				$member->setWebsite($_POST['website']);

				$member->save();
			}
			$this->pseudo	= $member->getPseudo();
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
	        // update: save
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
        // use the Profil constructor
    }
    
    
}

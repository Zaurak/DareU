<?php

require_once dirname(__FILE__) . '/../lightmvc/ActionController.php';
require_once dirname(__FILE__) . '/../model/Member.php';
require_once dirname(__FILE__) . '/../model/Members.php';

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

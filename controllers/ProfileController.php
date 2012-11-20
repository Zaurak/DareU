<?php

require_once dirname(__FILE__) . '/../lightmvc/ActionController.php';

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
        	// member save
        	// update save
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

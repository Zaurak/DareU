<?php

require_once dirname(__FILE__) . '/../lightmvc/ActionController.php';
require_once dirname(__FILE__) . '/../model/Member.php';
require_once dirname(__FILE__) . '/../model/Members.php';
require_once dirname(__FILE__) . '/../model/Profile.php';
require_once dirname(__FILE__) . '/../model/Comment.php';

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
				// Insert new update
				$update = new Update();
				$update->setContent($_POST['content']);
				$update->setDate(date('Y-m-d H-i-s'));
				$update->setService('text');
				$update->setIdMember($_SESSION['idMember']);

				$update->save();
				$this->redirect('/profile/view?id=' . $_SESSION['idMember']);
			}
		}
    }

	public function commentAction()
	{
		// If the user is not logged in
		if(!isset($_SESSION['connected']) || $_SESSION['connected'] == false) {
			$this->redirect('/');
		}
		else {
			if(isset($_GET['idMember']) && isset($_GET['idUpdate'])) {
				if($_GET['idMember'] != null && $_GET['idUpdate'] != null) {
	        		if(isset($_POST['comment']) && $_POST['comment'] != null) {

						$comment = new Comment();
						$comment->setContent($_SESSION['username'] . ' : ' . $_POST['comment']);
						$comment->setDate(date('Y-m-d H-i-s'));
						$comment->setIdUpdate($_GET['idUpdate']);
						$comment->setIdMember($_GET['idMember']);

						$comment->save();
						$this->redirect('/profile/view?id=' . $_GET['idMember']);
					}
					else {
						$this->message = 'Post';
					}
				}
				else {
						$this->message .= ' null';
				}
			}
			else {
			}
				$this->message .= ' Get';
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

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
     * Add an update 
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
			}

			if(isset($_FILES['image']) && !$_FILES['image']['error']) {
				if($_FILES['image']['size'] > 500000) {
					$this->message = 'Error : The file cannot weight more than 500Ko.';
				}
				else if( !in_array(substr(strrchr($_FILES['image']['name'],'.'),1), array('png', 'jpg'))) {
					$this->message = 'Error : The file isn\'t an image (png and jpg only).';
				}
				else {
					if(move_uploaded_file($_FILES['image']['tmp_name'], dirname(__FILE__).'/../img/update/'.$_FILES['image']['name'])) {
						// Insert new update
						$update = new Update();
						$update->setContent(dirname(__FILE__).'/../img/update/'.$_FILES['image']['name']);
						$update->setDate(date('Y-m-d H-i-s'));
						$update->setService('image');
						$update->setIdMember($_SESSION['idMember']);
	
						$update->save();
					}
				}
			}
			else {
				if(!isset($_FILES['image']))
					$this->message = 'no image';
				if($_FILES['image']['error'] > 0)
					$this->message = 'error';
			}
		}
		$this->redirect('/profile/view?id=' . $_SESSION['idMember']);
    }
	
	// Create a new comment to an update
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
						$comment->setIdAuthor($_SESSION['idMember']);

						$comment->save();
						$this->redirect('/profile/view?id=' . $_GET['idMember']);
					}
					else {
						$this->message = 'You can\'t send en empty comment\n';
					}
				}
				else {
						$this->message .= 'Url parameters can\'t be null\n';
				}
			}
			else {
				$this->message .= 'Missing url parameters';
			}
		}
		
	}
		
	/**
	 * Delete a comment
	 */
	public function deleteCommentAction() {
		if(isset($_SESSION['connected']) && $_SESSION['connected'] == true) {
			if(isset($_GET['idComment']) && $_GET['idComment'] != null) {
				$comment = new Comment($_GET['idComment']);
				$id = $comment->getIdMember();
				if($comment->getIdAuthor() == $_SESSION['idMember']) {
					Comment::deleteComment($comment->getIdComment());
					$this->redirect('/profile/view?id='.$id);
				}
			}
		}
		else {
			$this->redirect('/');
		}
	}
    
	/**
	 * Delete an update
	 */
	public function deleteAction() 
	{
		// If the user is not logged in
		if(!isset($_SESSION['connected']) || $_SESSION['connected'] == false) {
			$this->redirect('/');
		}
		else {
			if(isset($_GET['idUpdate']) && $_GET['idUpdate'] != null) {
				$update = new Update($_GET['idUpdate']);
				if($update->getIdMember() == $_SESSION['idMember']) {
					foreach($update->getComments() as $comment) {
						Comment::deleteComment($comment->getIdComment());
					}
					Update::deleteUpdate($update->getIdUpdate());
					$this->redirect('/profile/view?id='.$_SESSION['idMember']);
				}
			}
		}
    }
        
    /**
     * show the profile
     */
    public function viewAction()
    {
		// Only the members can watch each others walls
		if(isset($_SESSION['connected']) && $_SESSION['connected'] == true) {
			if(isset($_GET['id']) && $_GET['id'] != null) {
				$this->profile = new Profile($_GET['id']);	
			}
		}
		else {
			$this->redirect('/');
		}
    }
    
    
}

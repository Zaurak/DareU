<?php

require_once dirname(__FILE__) . '/../lightmvc/ActionController.php';
require_once dirname(__FILE__) . '/../model/Member.php';
require_once dirname(__FILE__) . '/../model/Members.php';
require_once dirname(__FILE__) . '/../model/Profile.php';
require_once dirname(__FILE__) . '/../model/Comment.php';
require_once dirname(__FILE__) . '/../model/Update.php';

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
						$update->setContent('<img src="/img/update/'.$_FILES['image']['name'].'" alt="update_pic" />');
						$update->setDate(date('Y-m-d H-i-s'));
						$update->setService('image');
						$update->setIdMember($_SESSION['idMember']);
	
						$update->save();
					}
				}
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
        
	private function getUpdateArray($getUpdates) {
	$up = null;
			if($getUpdates != null) {
				$up = array();
				foreach($getUpdates as $update) {
					$up[] = array(
					 			'date' 		=> $update->getDate(),
								'content' 	=> $update->getContent(),
								'service'	=> $update->getService(),
								'idMember'  => $update->getIdMember(),
								'idUpdate'	=> $update->getIdUpdate(),
								'comment'	=> null
								);
														
					if($update->getComments() != null) {
						$up[count($up)-1]['comment'] = array();
						foreach($update->getComments() as $comment) {
							$up[count($up)-1]['comment'][] = array( 
															'date'		=> $comment->getDate(),
															'content'	=> $comment->getContent(),
															'idAuthor' 	=> $comment->getIdAuthor(),
															'idComment' => $comment->getIdComment()
															);
						}
					}
				}
			}
		return $up;
	}

    /**
     * show the profile
     */
    public function viewAction()
    {
		// Only the members can watch each others walls
		if(isset($_SESSION['connected']) && $_SESSION['connected'] == true) {
			if(isset($_GET['id']) && $_GET['id'] != null && $_GET['id'] > 0 && $_GET['id'] <= Members::getLastId()) {
				$profile = new Profile($_GET['id']);	
				$member = $profile->getMember();
				$xml = Update::getLikes($member->getUserName());
				if($xml != null) {
					$lastVimeo = Update :: getLastTimeVimeo($member->getId());
					if($lastVimeo != null) {
						foreach($xml as $v) {
							if($v->liked_on > $lastVimeo) {
								$content = 	'<a href="' . $v->url . '">' . $v->title . '</a><br />' .
											'<img src="' . $v->thumbnail_medium . '" /><br />';
								$update = new Update();
								$update->setContent($content);
								$update->setDate($v->liked_on);
								$update->setService('vimeo');
								$update->setIdMember($member->getId());
								$update->save();
							}
						}
					}
				}
				$prof = new Profile($_GET['id']);

				$retProfile = array(
							'member'  => null,
							'updates' => null
							);

				if($prof->getMember() != null) {
					$retProfile['member'] = array(
									'username' => $prof->getMember()->getUserName(),
									'image' => $prof->getMember()->getImage(),
									'idMember' => $prof->getMember()->getId()
									);				
				}
				if($prof->getUpdates() != null) {
					$retProfile['updates'] = $this->getUpdateArray($prof->getUpdates());
				}
				$this->profile = $retProfile;

			}
			else {
				$this->redirect('/');
			}
		}
		else {
			$this->redirect('/');
		}
    }

	public function updateAction()
	{
		// If the necessary datas are received
		if(	isset($_POST['idMember']) && isset($_POST['lastUpdate']) && 
			$_POST['idMember'] != null && $_POST['lastUpdate'] != null) {	
			// Don't display header & footer as the result is to be diplayed in another page
				$this->_includeTemplate = false;
			// get the updates made after the last displayed update and send them to the view
			$getUpdates = Update::getAll($_POST['lastUpdate'], $_POST['idMember']);
			if($getUpdates != null) {
				$this->updates = $this->getUpdateArray($getUpdates);
			}
		}
	}
    
    
}

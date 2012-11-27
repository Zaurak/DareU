<?php

require_once dirname(__FILE__) . '/../lightmvc/ActionController.php';
require_once dirname(__FILE__) . '/../model/Member.php';
require_once dirname(__FILE__) . '/../model/Members.php';

class MembersController extends ActionController
{
    /**
     * Simple index page which links to the main available actions
     */
    public function indexAction()
    {
        // Do nothing
    }
    
    public function signupAction()
    {	
		// If the form hasn't been filled yet
		$this->message = 'Fill the form to sign up';
		
       	if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email']) ) {
			// If all the fields haven't been filled
			if($_POST['username'] == null || $_POST['password'] == null || $_POST['email'] == null) {
				$this->message = 'All fields are mandatory';
			}
			else {
				// Test if the username is available
				if(Members::isUserNameTaken($_POST['username'])) {
					$this->message = 'UserName already taken, please choose another one';
				}
				// Test if the e-mail adress is available
				else if(Members::isMailTaken($_POST['email'])) {
					$this->message = 'E-mail already taken, please choose another one';
				}
				else {
					// Create new member with the information given in the form
					$member = new Member();
					$member->setUserName($_POST['username']);
					$member->setPassword($_POST['password']);
					$member->setEmail($_POST['email']);
					$member->setSex($_POST['sex']);
					$member->save();
					$this->message = 'Welcome aboard !';
					$this->createSession($member);
					$this->redirect('/profile/edit');
				}
			}
		}
    }
    
    public function signinAction()
    {
		// If the form hasn't been filled yet (shouldn't happen)
		$this->message = 'Fill the form in the header to sign in';
        if(isset($_POST['username']) && isset($_POST['password']) ) {
			// If all the fields haven't been filled
			if($_POST['username'] == null || $_POST['password'] == null) {
				$this->message = 'UserName or password missing';
			}
			else {
				// If the user is found 
				if(Members::signin($_POST['username'], $_POST['password'])) {
				 	$this->message = 'You successfully signed in';
					$member = new Member($_POST['username']);
					
					$this->createSession($member);
					
					$this->redirect('/profile/edit');
				}
				else {
					$_SESSION['connected'] 	= false;
					$this->message = 'Wrong username or password';
				}
			}
		}
    }
    
	private function createSession($member)
	{
		$_SESSION['connected'] 	= true;
		$_SESSION['username'] 	= $member->getUserName();
		$_SESSION['isAdmin']	= $member->isAdmin();
		$_SESSION['idMember']	= $member->getId();		
	}

    public function listAction()
    {
		// If the user is logged in and is admin
		if(	isset($_SESSION['connected']) 	&& $_SESSION['connected'] == true &&
			isset($_SESSION['isAdmin']) 	&& $_SESSION['isAdmin'] == true	) 		
		{
			// Get an array containing all the members
			$membersList = Members::getAll();
			// Create an array with the informations to show on the list of members
			foreach($membersList as $member) {
				$allMembers[] = array(
									'username' 	=> $member->getUserName(),
									'email'		=> $member->getEmail(),
									'sex'		=> $member->getSex(),
									'website'	=> $member->getWebsite()
									);
			}
			// Make the list available to the view
			$this->listMembers = $allMembers;
		}
		else
		{
			$this->redirect('/');
		}
    }
    
	public function logoutAction()
	{
		// If the user is logged, destroy the session variables and redirect to the homepage
		if(isset($_SESSION['connected'])) {
			unset($_SESSION['connected']);
			session_destroy();
			$this->redirect("/");
		}
	}

    public function deleteAction()
    {  
		// If the user is logged in and is admin
		if(	isset($_SESSION['connected']) 	&& $_SESSION['connected'] == true &&
			isset($_SESSION['isAdmin']) 	&& $_SESSION['isAdmin'] == true	) 		
		{
       		if(isset($_GET['username'])) 
			{
				$this->member = new Member($_GET['username']);
				Members::delete($this->member->getId());
			}
		}
		else
		{
			$this->redirect('/');
		}	
    }


}

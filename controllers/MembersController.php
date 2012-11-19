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
		$this->message = 'Fill the form to sign up';

       	if(isset($_POST['pseudo']) && isset($_POST['password']) && isset($_POST['email']) ) {
			if($_POST['pseudo'] == null || $_POST['password'] == null || $_POST['email'] == null) {
				$this->message = 'All fields are mandatory';
			}
			else {
				$member = new Member();
				$member->setPseudo($_POST['pseudo']);
				$member->setPassword($_POST['password']);
				$member->setEmail($_POST['email']);
				$member->setSex($_POST['sex']);
				$member->save();

				$this->message = 'Welcome aboard !';
			}
		}
    }
    
    public function signinAction()
    {
		$this->message = 'Fill the form in the header to sign in';
        if(isset($_POST['pseudo']) && isset($_POST['password']) ) {
			if($_POST['pseudo'] == null || $_POST['password'] == null) {
				$this->message = 'Pseudo or password missing';
			}
			else {
				if(Members::signin($_POST['pseudo'], $_POST['password']))
				 	$this->message = 'You successfully signed in';
				else
					$this->message = 'Wrong username or password';
			}
		}
    }
    
    public function listAction()
    {
        // use members : list
    }
    
    public function deleteAction()
    {  
       // use members: delete 
    }


}

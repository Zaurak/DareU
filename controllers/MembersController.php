<?php

require_once dirname(__FILE__) . '/../lightmvc/ActionController.php';
require_once dirname(__FILE__) . '/../model/Member.php';

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
        if(isset($_POST['']) {

		}
    }
    
    public function signinAction()
    {
        // use members : signin
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

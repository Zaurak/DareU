<?php

require_once dirname(__FILE__) . '/../lightmvc/ActionController.php';
require_once dirname(__FILE__) . '/../model/Members.php';

class IndexController extends ActionController
{
    /**
     * Simple index page which links to the main available actions
     */
    public function indexAction()
    { 
		$this->frontProfiles = Members::getFrontProfiles();
    }
    
	public function rssAction() 
	{
		$this->_includeTemplate = false; 	// to hide footer & header
	    $result = Members::getAll(10);		// Get the last 10 members

		$rss = '<?xml version="1.0" encoding="UTF-8" ?>
				<rss version="2.0">
				<channel>
			       <title>New members !</title>
				   <description>Here are the 10 newest members of dareu.com !</description>
				   <pubDate>'.date_default_timezone_set('Europe/Paris').'</pubDate>';

		foreach($result as $r)
		{
			$rss = $rss.'<item>
							<title>' . $r->getPseudo() . '</title>
							<description>' . $r->getDescription() . '</description>
							<link>' . $r->getWebsite() . '</link>
						</item>';
		}

		$rss = $rss.'</channel></rss>';
		$this->rss = $rss; // transmit it to view
	}
    
}

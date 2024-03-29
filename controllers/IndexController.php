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
	
	/**
	 * Create rss content with informations about the 10 last members
	 */
	public function rssAction() 
	{
		$this->_includeTemplate = false; 	// to hide footer & header
	    $result = Members::getAll(10);		// Get the last 10 members
		
		$rss = '<?xml version="1.0" encoding="UTF-8" ?>
				<rss version="2.0">
				<channel>
			       <title>New members !</title>
				   <description>Here are the 10 newest members of dareu.com !</description>
				   <pubDate>'.date(DATE_RSS).'</pubDate>';
		// Get informations about the members
		foreach($result as $r)
		{
			$rss = $rss.'<item>
							<title>' . $r->getUserName() . '</title>
							<description>' . $r->getDescription() . '</description>';
			
			if($r->getWebsite() != null)
				$rss = $rss.'<link>http://' . $r->getWebsite() . '</link>';

			$rss = $rss.'</item>';
		}

		$rss = $rss.'</channel></rss>';
		$this->rss = $rss; // transmit it to view
	}
    
}

<?php

/**
 * Wall of Facebook - Main Controller
 *
 * Retrieve a configurable facebook wall feed, and hand it over to Smarty.
 * Since the user must be logged in for facebook to allow this action, he or she will be presented a login link if necessary.  
 * See config file for various customizations (wof.*)
 * 
 * @uses Zend
 * @uses _Controller_Action
 * @author holzweg <flo.peter@holzweg.com> 
 */
class IndexController extends Zend_Controller_Action
{

    public function init()
    {
		// Load config
		$this->config = Zend_Registry::get( 'config' );
		
		// Initialize facebook connection
		$this->fbConnect = new Application_Model_FbConnect( $this->config->wof->appId, $this->config->wof->appSecret );
    }

	public function indexAction()
	{

		$smarty = Zend_Registry::get( 'smarty' );

		// Do we have a valid facebook user login? 
		if ( $this->fbConnect->isLoggedIn() ) { 
			// Yah, go ahead, retrieve the wall feed 
			$feed = $this->fbConnect->getFeed( $this->config->wof->pageId, $this->config->wof->feedLimit ); 
			// and pass it to Smarty! 
			$smarty->assign( 'feed', $feed['data'] ); 
		}  

		
		// Hand it all over to Smarty, et voilà
		// @kludge Currently we need to call setNoRender() in every action. There must be a better way to integrate Smarty...
		$this->_helper->viewRenderer->setNoRender( true );
		$smarty->assign( 'is_login', $this->fbConnect->isLoggedIn() );
		$smarty->assign( 'login_url', $this->fbConnect->getLoginUrl() );
		// the following line is invisible.
		$smarty->assign( 'xmas', ( date( "d" ) == '24' && date( "m" ) == '12' ) );
		$smarty->display( 'index.tpl' );

	}


}

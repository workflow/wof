<?php

/**
 * Connect to facebook and retrieve configurable wall data
 *
 * Establishes connection and authenticates with facebook using the PHP SDK (-> see http://developers.facebook.com/docs/sdks/ )
 *
 * @author holzweg <flo.peter@holzweg.com> 
 */
class Application_Model_FbConnect
{

	protected $_facebook;
	protected $_user;		// Holds current facebook user, if any. 

	public function __construct( $appId, $appSecret )
	{
		// Load PHP SDK and fetch config
		require_once( 'Facebook/facebook.php' );
		$this->config = Zend_Registry::get( 'config' );

		// Initialize APP ID and APP SECRET
		$this->_facebook = new Facebook
		(
			array
			(
				'appId'	=> $appId,
				'secret' => $appSecret
			)
		);

		// Attempt to set the current facebook user
		$this->_user = $this->_facebook->getUser();

	}

	/**
	 * isLoggedIn 
	 * 
	 * @access public
	 * @return bool 
	 */
	public function isLoggedIn()
	{
		return (bool) $this->_user;
	}

	/**
	 * Return link to facebook login 
	 * 
	 * @access public
	 * @return str
	 */
	public function getLoginUrl()
	{
		return $this->_facebook->getLoginUrl();
	}

	/**
	 * Return a raw (wall-)feed of the given facebook pageID!
	 *
	 * @todo Add caching, see below. Left it out now due to time constraints.
	 * 
	 * @param str $pageId 
	 * @param int $limit	Limit the amount of feed items returned.
	 * @access public
	 * @return str
	 */
	public function getFeed( $pageId, $limit )
	{
		try	{
			$result = $this->_facebook->api( $pageId . '/feed', array( 'limit' => (int) $limit ) );
		} catch ( FacebookApiException $e ) {
			 // @todo do something useful if pageId is invalid
			$result = $e->getResult();
			error_log( json_encode( $result ) );
			die("<h1>An Error occured and this machine is on lunch break.</h1><pre>Don't worry though, just reload the page, practice some yoga or undo your most recent config change and you should be fine.</pre>");
		}
		
		return $result;
	}

	/* @todo Caching - this did the trick a few zf versions ago, probably needs some adapting.
		
		private function loadCache($lifetime=86400)
	{
		$frontendOptions = array(
			'lifetime' => $lifetime, 
			'automatic_serialization' =>true
		);
		$backendOptions = array(
			'cache_dir' => $this->config['cachedir'], // Directory where to put the cache files
			// hashed dirs are a method of cache optimization, as soon as we hit some several thousands of cache files...
			// 'hashed_directory_umask'=>'0777',
			'cache_file_umask' => '0777',
			//            'cache_db_complete_path'=> $this->config['cachedir'].'cams_cache.db'
		); // getting a Zend_Cache_Core object
		return Zend_Cache::factory('Core', 'File', $frontendOptions, $backendOptions);
	}
	*/

}

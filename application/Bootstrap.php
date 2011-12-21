<?php

/**
 * Bootstrap for Wall of Facebook
 * 
 * @uses Zend
 * @uses _Application_Bootstrap_Bootstrap
 * @author holzweg <flo.peter@holzweg.com> 
 */
class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

	/**
	 * _initEverything 
	 *
	 * That's right.
	 * 
	 * @access protected
	 * @return void
	 */
	protected function _initEverything()
	{
		/* @deprecated, use Zend_Loader_Autoloader if needed.
		Set up autoload. 
		This is a nifty trick that allows ZF to load classes automatically so that you don't have to litter your 
		code with 'include' or 'require' statements. 
		require_once "Zend/Loader.php"; 
		Zend_Loader::registerAutoload();  */

		// Paths
		define( "ROOT_PATH", dirname( dirname( __FILE__ ) ) );
		set_include_path( get_include_path() . PATH_SEPARATOR . ROOT_PATH . '/application/configs' ); 

		// Config
		$config = new Zend_Config_Ini ( 'application.ini', 'production' );
		Zend_Registry::set( 'config', $config );

		// Smarty
		// @todo these values should be set in config instead
		// @todo caching
		require_once( 'Smarty/Smarty.class.php' );
		$smarty = new Smarty();
		$smarty->debugging = false;
		$smarty->force_compile = true;
		$smarty->caching = false;
		$smarty->compile_check = true;
		$smarty->cache_lifetime = 3600;
		$smarty->template_dir = ROOT_PATH . '/application/views/smarty_templates';
		$smarty->compile_dir = ROOT_PATH . '/application/views/smarty_templates/templates_c';
		$smarty->cache_dir = ROOT_PATH . '/application/views/smarty_templates/cache';
		$smarty->plugins_dir = array( SMARTY_DIR . 'plugins', 'resources/plugins' );
		Zend_Registry::set( 'smarty', $smarty );

		// @todo initialyze doctype, layout n' stuff

		// @todo autoloading
	}

}

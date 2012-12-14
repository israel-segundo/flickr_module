<?php
/**
 * Tweet
 *
 * PHP version 5
 *
 * @category Model
 * @package  Croogo
 * @version  1.4
 * @author   Damian Grant <codebogan@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.croogo.org
 */
class FlickrModule extends FlickrModuleAppModel {

	/**
	 * Model name
	 *
	 * @var string
	 * @access public
	 */
	public $name = 'FlickrModule';
	
	/**
	 * Model table
	 *
	 * @var string
	 * @access public
	 */
	public $useTable = false;
		
	/**
	 * Disable caching of DB sources
	 * Setting to true causes a Missing Database Table error when you visit
	 * the Create Tweet page immediately after activating this Tweet plugin.
	 *
	 * @var string
	 * @access public
	 */		
	public $cacheSources = false;	
	
}
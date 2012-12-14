<?php
/**
 * Flickr Module
 *
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
<?php
/**
 * Routes
 *
 * example_routes.php will be loaded in main app/config/routes.php file.
 */
	Croogo::hookRoutes('FlickrModule');

/**
 * Behavior
 *
 * This plugin's FlickrModule behavior will be attached whenever Node model is loaded.
 */
//	Croogo::hookBehavior('Node', 'FlickrModule.FlickrModule', array());

/**
 * Component
 *
 * This plugin's FlickrModule component will be loaded in ALL controllers.
 */
	Croogo::hookComponent('*', 'FlickrModule.FlickrModule');

/**
 * Helper
 *
 * This plugin's FlickrModule helper will be loaded via NodesController.
 */
//	Croogo::hookHelper('Nodes', 'FlickrModule.FlickrModule');

/**
 * Admin menu (navigation)
 */

    CroogoNav::add('extensions.children.flickrmodule', array(
        'title' => __('Flickr Settings'),
        'url' => array(
			'plugin' => 'flickr_module',
			'controller' => 'flickr_module',
			'action' => 'index',
		),
        'access' => array('admin'),
        'children' => array(
		    'listtweets' => array(
				'title' => __('Flickr Admin'),
				'url' => array(
					'plugin' => 'flickr_module',
					'controller' => 'flickr_module',
					'action' => 'edit',
					),
				'weight' => 10,
			),
		
		),
    ));
/**
 * Admin row action
 *
 * When browsing the content list in admin panel (Content > List),
 * an extra link called 'FlickrModule' will be placed under 'Actions' column.
 */
//	Croogo::hookAdminRowAction('Nodes/admin_index', 'FlickrModule', 'plugin:flickrmodule/controller:flickrmodule/action:index/:id');

/**
 * Admin tab
 *
 * When adding/editing Content (Nodes),
 * an extra tab with title 'FlickrModule' will be shown with markup generated from the plugin's admin_tab_node element.
 *
 * Useful for adding form extra form fields if necessary.
 */
//    Croogo::hookAdminTab('Nodes/admin_add', 'FlickrModule', 'flickrmodule.admin_tab_node');
//    Croogo::hookAdminTab('Nodes/admin_edit', 'FlickrModule', 'flickrmodule.admin_tab_node');
?>
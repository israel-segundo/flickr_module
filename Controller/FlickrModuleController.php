<?php
/**
 * Flickr Module
 *
 */
class FlickrModuleController extends FlickrModuleAppController {

    /**
     * Plugin name
     *
     * @var string
     */
    var $pluginName = 'FlickrModule';

    /**
     * Controller name
     *
     * @var string
     * @access public
     */
    public $name = 'FlickrModule';

    /**
     * Components used by the Controller
     *
     * @var array
     * @access public
     */ 
    public $components = array('Security', 'Session', 'FlickrModule.FlickrModule');

    /**
     * Models used by the Controller
     *
     * @var array
     * @access public
     */
    public $uses = array('Setting');

    public function admin_index() {
        $this->set('title_for_layout', __('Flickr Module', true));
        $this->set( 'flickr_module_settings', $this->getSettings());
    }

    public function index() {
        $this->set('title_for_layout', __('Flickr Module', true));
    }

    public function admin_store_settings(){

        $fields = array('flickr_key', 'flickr_user_id', 'user_type', 'height', 'width');

        foreach( $fields as $field){
            if( !isset( $this->data['FlickrModule'][$field]) || $this->data['FlickrModule'][$field]=='' ){
                $this->redirect($this->referer());
                exit();
            }
        }

        $message = ( $this->saveSettings($this->data['FlickrModule']) ) ? 'Settings were saved': 'Settings were NOT saved';

        $settings = $this->getSettings();
        $this->set( 'flickr_module_settings', $settings);

        $this->Session->setFlash( $message );
        $this->redirect(array('action'=>'index'));
        exit();
    }

    /**
     * Edit tweet
     *
     * @param integer $id
     */
    function admin_edit($id = null) {
        $this->set('title_for_layout', __('Flickr Module Edit Settings', true));
        $this->set( 'flickr_module_settings', $this->getSettings());
    }

}
?>
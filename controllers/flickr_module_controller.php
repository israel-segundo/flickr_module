<?php

class FlickrModuleController extends FlickrModuleAppController {

    public $name = 'FlickrModule';
    public $uses = array('Setting');

    public function admin_index() {
        $this->set('title_for_layout', __('Flickr Module', true));
        $this->set( 'flickr_module_settings', $this->getSettings());
    }

    public function index() {
        $this->set('title_for_layout', __('Flickr Module', true));
    }

    public function admin_store_settings(){

        $fields = array('flickr_key', 'flickr_user_id', 'height', 'width');

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
        $this->redirect( array( 'plugin' => 'flickr_module', 'controller' => 'flickr_module', 'action' => 'admin_index') );
        exit();
    }
}
?>
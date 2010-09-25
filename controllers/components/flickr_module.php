<?php

class FlickrModuleComponent extends Object {

    public function startup(&$controller) {
    }

    public function beforeRender(&$controller) {
        $controller->loadModel('FlickrModule.FlickrGallery');

        $settings = $controller->Setting->find('first',array('conditions'=>array('key'=>'FlickrModule.options')));

        if( !empty( $settings['Setting']['value'] ) ){
            $settings = $controller->Node->decodeData( $settings['Setting']['value'],
                                                          array('trim'=>false,'json'=>true)
                                                        );
        }
        
        $flickr_gallery =
            $controller->FlickrGallery->getRandomPicturesofUser(
                    $settings['flickr_key'],
                    $settings['flickr_user_id'],
                    $settings['number_images']
            );

        $photo_width  = $settings['width'];
        $photo_height = $settings['height'];

        if ( $flickr_gallery != false ){

            $controller->set(compact('flickr_gallery', 'photo_width', 'photo_height'));
        }
        
    }

    public function shutdown(&$controller) {
    }
    
}
?>
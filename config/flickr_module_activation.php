<?php

class FlickrModuleActivation {

    public function beforeActivation(&$controller) {
        return true;
    }

    public function onActivation(&$controller) {
       
        $controller->Croogo->addAco('FlickrModule');
        $controller->Croogo->addAco('FlickrModule/admin_index');
        $controller->Croogo->addAco('FlickrModule/admin_store_settings');
        $controller->Croogo->addAco('FlickrModule/index', array('registered', 'public'));
        $this->createBlock($controller);
        $this->resetSettings($controller);
    }

    public function beforeDeactivation(&$controller) {
        return true;
    }

    public function onDeactivation(&$controller) {
        $controller->Croogo->removeAco('FlickrModule');
        $this->removeBlock($controller);
    }

    private function createBlock(&$controller){

        $controller->loadModel('Block');
        $controller->Block->create();
        $controller->Block->set(array(
            'visibility_roles' => $controller->Node->encodeData(array("1","2","3","4","5","6")),
            'visibility_paths' => '',
            'region_id'        => 4, // Right
            'title'            => 'Flickr',
            'alias'            => 'flick_module_plugin',
            'body'             => '[element:flickr_gallery plugin="flickr_module"]',
            'show_title'       => 1,
            'status'           => 1
        ));
        $controller->Block->save();
    }

    private function removeBlock(&$controller){

        $controller->loadModel('Block');
        $block = $controller->Block->find('first', array('conditions'=>array('Block.alias'=>'flick_module_plugin')));

        if( $block ){
            $controller->Block->delete($block['Block']['id']);
        }

    }

    private function resetSettings(&$controller){

        $options = array(
            'flickr_key'        => 'c759a4a174da95e36d4e0ca6717a7f6a',
            'flickr_user_id'    => '36587311@N08',
            'number_images'     => 4,
            'height'            => 100,
            'width'             => 130

        );

        $setting = $controller->Setting->find('first',
                                              array('conditions'=>array('Setting.key'=>'FlickrModule.options')));

        $setting['Setting']['key']   = 'FlickrModule.options';
        $setting['Setting']['value'] = $controller->Node->encodeData($options,
                                                                        array('trim'=>false,'json'=>true));

        $controller->Setting->save($setting);

    }
}
?>
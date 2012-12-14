<?php
/**
 * Flickr Module
 *
 */
class FlickrModuleActivation {

    var $uses = array('Session');

    public function beforeActivation(&$controller) {
        return true;
    }

    public function onActivation(&$controller) {
       
        $controller->Croogo->addAco('FlickrModule');
        $controller->Croogo->addAco('FlickrModule/admin_index');
        $controller->Croogo->addAco('FlickrModule/admin_store_settings');
        $controller->Croogo->addAco('FlickrModule/index', array('registered', 'public'));

        $controller->Croogo->addAco('flickrmodule');
        $controller->Croogo->addAco('flickrmodule/admin_index');
        $controller->Croogo->addAco('flickrmodule/admin_store_settings');
        $controller->Croogo->addAco('flickrmodule/index', array('registered', 'public'));

        $this->createBlock($controller);
        $this->resetSettings($controller);
        
        // Main menu: add an Route link
        $mainMenu = $controller->Link->Menu->findByAlias('main');
        $controller->Link->Behaviors->attach('Tree', array(
            'scope' => array(
                'Link.menu_id' => $mainMenu['Menu']['id'],
            ),
        ));
        
        $controller->Link->save(array(
            'menu_id' => $mainMenu['Menu']['id'],
            'title' => 'Route',
            'link' => 'plugin:flickrmodule/controller:flickrmodule/action:index',
            'status' => 1,
        ));
    }

    public function beforeDeactivation(&$controller) {
        return true;
    }

    public function onDeactivation(&$controller) {
        $controller->Croogo->removeAco('FlickrModule');
        $this->removeBlock($controller);

        // Main menu: delete Tweet link
        $link = $controller->Link->find('first', array(
            'conditions' => array(
                'Menu.alias' => 'main',
                'Link.link' => 'plugin:flickrmodule/controller:flickrmodule/action:index',
            ),
        ));
        
        if (isset($link['Link']['id'])) {
            $controller->Link->delete($link['Link']['id']);
        }
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
            'body'             => '[element:flickr plugin="FlickrModule"]',
            'show_title'       => 1,
            'status'           => 1
        ));
        $controller->Block->save();
    }

    private function removeBlock(&$controller){

        $controller->loadModel('Block');
        $block = $controller->Block->find('first', array('conditions'=>array('Block.alias'=>'FlickrModulePlugin')));

        if( $block ){
            $controller->Block->delete($block['Block']['id']);
        }

    }

    private function resetSettings(&$controller){

        $options = array(
            'flickr_key'        => 'f90a3b99d0ae13d35fcc1c31ef16f3b4',
            'flickr_user_id'    => '36133189@N00',
            'user_type'         => 'group',
            'number_images'     => 4,
            'height'            => 100,
            'width'             => 130

        );

        $setting = $controller->Setting->find('first', array(
            'conditions'=>array(
                'Setting.key'=>'FlickrModule.options'
                )
            )
        );

        $setting['Setting']['key']   = 'FlickrModule.options';
        $setting['Setting']['value'] = $controller->Node->encodeData($options, array(
            'trim'=>false,
            'json'=>true
            )
        );

        $controller->Setting->save($setting);

    }
}
?>
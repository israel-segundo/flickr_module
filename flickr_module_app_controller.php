<?php
class FlickrModuleAppController extends AppController {

    public $uses = array('Setting');

    protected function saveSettings( $data= null ){

        if( $data == null){
            return false;
        }

        $settings       = $this->Setting->find('first',array('conditions'=>array('key'=>'FlickrModule.options')));

        $setting['Setting']['key']   = 'FlickrModule.options';
        $settings['Setting']['value'] = $this->Node->encodeData( $data,
                                                                    array('trim'=>false,'json'=>true)
                                                                  );
        return $this->Setting->save($settings);
    }

    protected function getSettings(){

        $plugin_setting = $this->Setting->find('first',array('conditions'=>array('key'=>'FlickrModule.options')));
        $settings       = null;

        if( !empty( $plugin_setting['Setting']['value'] ) ){

            $settings = $this->Node->decodeData( $plugin_setting['Setting']['value'],
                                                          array('trim'=>false,'json'=>true)
                                                        );
        }

        return $settings;

    }
}
?>
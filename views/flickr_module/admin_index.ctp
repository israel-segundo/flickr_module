<?php
    echo $this->Html->script('/flickr_module/js/jquery-validate/jquery.validate');
    echo $this->Html->script('/flickr_module/js/form_validation');
    
    $settings = $flickr_module_settings;
?>
<div class="example index">
    <h2><?php echo $title_for_layout; ?></h2>
    
    <div>
        <?php
            echo $form->create(null,
                    array('url' => array(
                                'plugin' => 'flickr_module', 
                                'controller' => 'flickr_module',
                                'action' => 'admin_store_settings')));

            echo $form->input('FlickrModule.flickr_key',array(
                'class' => 'required',
                'value' => $settings['flickr_key']
            ));

            echo $form->input('FlickrModule.flickr_user_id', array(
                'class' => 'required',
                'value' => $settings['flickr_user_id'],
                'type'    => 'text'
            ));

            echo $form->input('FlickrModule.number_images',array(
                'class' => 'required number',
                'value' => $settings['number_images']
            ));

            echo $form->input('FlickrModule.height',array(
                'class' => 'required number',
                'value' => $settings['height']
            ));

            echo $form->input('FlickrModule.width',array(
                'class' => 'required number',
                'value' => $settings['width']
            ));
            echo $form->submit('Send');
            echo $form->end();
        ?>
    </div>
</div>
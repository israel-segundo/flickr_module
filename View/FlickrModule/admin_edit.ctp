
<?php
    echo $this->Html->script('/flickr_module/js/jquery-validate/jquery.validate');
    echo $this->Html->script('/flickr_module/js/form_validation');
    
    $settings = $flickr_module_settings;
?>
<div class="flcikr_module index">
    <h2><?php echo $title_for_layout; ?></h2>
    
    <div>
		<?php echo $this->Form->create('flickr_module', array('url' => array('controller'=>'flickr_module', 'action'=>'admin_store_settings'))); ?>

        <?php

            echo $this->Form->input('FlickrModule.flickr_key', array(
            	'label' => 'Flickr Key',
            	'class' => 'flickr_key',
            	'value' => $settings['flickr_key']
            ));

            echo $this->Form->input('FlickrModule.flickr_user_id', array(
            	'label' => 'User ID',
            	'class' => 'flickr_user_id',
            	'value' => $settings['flickr_user_id'],
            	'type'    => 'text'
            ));

            echo $this->Form->input('FlickrModule.user_type', array(
                'options' => array(
                    'group' => 'Group',
                    'user'=> 'User'),
                'default' => $settings['user_type']
            ));

            echo $this->Form->input('FlickrModule.number_images', array(
            	'label' => 'Number of Images',
            	'class' => 'required number',
            	'value' => $settings['number_images']
            ));

            echo $this->Form->input('FlickrModule.width', array(
            	'label' => 'Width',
            	'class' => 'required number',
            	'value' => $settings['width']
            ));

            echo $this->Form->input('FlickrModule.height', array(
            	'label' => 'height',
            	'class' => 'required number',
            	'value' => $settings['height']
            ));
            
			
?>
	    <div class="actions">
	        <ul>
	        	<li><?php echo $this->Form->end(__('Save', true)); ?></li>
	            <li><?php echo $this->Html->link(__d('flickr_module','Cancel', true), array('action'=>'index')); ?></li>         
	        </ul>
	    </div>
    </div>
</div>
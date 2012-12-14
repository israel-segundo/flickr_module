
<?php
    echo $this->Html->script('/flickr_module/js/jquery-validate/jquery.validate');
    echo $this->Html->script('/flickr_module/js/form_validation');
    
    $settings = $flickr_module_settings;
?>

<div class="flickr index">
    <h2><?php echo $title_for_layout; ?></h2>
    <div class="actions">
        <ul>
            <li><?php echo $this->Html->link(__d('flickr_module','Edit Settings', true), array('action'=>'edit')); ?></li>         
        </ul>
    </div>
    <table cellspacing="0" cellpadding="0">
        <?php
            echo $this->Html->tableHeaders(array(
                'Flickr Key', 'Flcikr ID', 'Type', 'Number of Images','Width','Height'
            ));

            echo $this->Html->tableCells(array(
                array(
                    $settings["flickr_key"],
                    $settings['flickr_user_id'],
                    $settings['user_type'],
                    $settings['number_images'],
                    $settings['width'],
                    $settings['height']
                    ),
            ));
        ?>
    </table>
</div>
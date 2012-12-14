<?php

    if( !isset( $this->viewVars['flickr_gallery'] ) ){

        echo '<div id="flickr_gallery">';
        echo 'Flickr: Communication error. Check your settings.';
        echo '</div>';
    }else{

        echo $this->Html->css('/flickr_module/css/flickr_module_style');
        
        $flickr_photos  = $this->viewVars['flickr_gallery'] ;
        $photo_width    = $this->viewVars['photo_width'] ;
        $photo_height   = $this->viewVars['photo_height'] ;
?>

<div id="flickr_gallery">

    <?php foreach( $flickr_photos as $photo):?>

        <div class="flickr_image">
            <?php
                $farm_id   = $photo['farm'];
                $owner     = $photo['owner'];
                $server_id = $photo['server'];
                $photo_id  = $photo['id'];
                $secret    = $photo['secret'];
                $title     = $photo['title'];
                
                echo $this->Html->image(
                    "http://farm$farm_id.static.flickr.com/$server_id/".$photo_id."_$secret.jpg",
                     array(
                         'url'    => "http://www.flickr.com/photos/$owner/$photo_id",
                         'height' => $photo_height,
                         'width'  => $photo_width,
                         'alt'    => $title,
                         'title'  => $title
                     )
                );
            ?>
        </div>
    <?php endforeach;?>

    <div class="clear"></div>
</div>

<?php } ?>
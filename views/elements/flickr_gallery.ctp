<?php

    
    if( !isset( $this->Layout->View->viewVars['flickr_gallery'] ) ){

        echo '<div id="flickr_gallery">';
        echo 'Flickr: Communication error. Check your settings.';
        echo '</div>';
    }else{

        echo $this->Html->css('/flickr_module/css/flickr_module_style');
        
        $flickr_photos  = $this->Layout->View->viewVars['flickr_gallery'] ;
        $photo_width    = $this->Layout->View->viewVars['photo_width'] ;
        $photo_height   = $this->Layout->View->viewVars['photo_height'] ;
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
    <div class="flickr-logo">
        <?php
            echo $this->Html->image('/flickr_module/img/Flickr_logo.png', array(
                 'width'  => 50,
                 'url'    => 'http://www.flickr.com/',
                 'title'  => 'Flickr'
            ));
        ?>
    </div>
</div>

<?php } ?>
<?php

class FlickrGallery extends FlickrModuleAppModel{

    var $name     = 'FlickrGallery';
    var $useTable = false;
    
    private function get_url_contents($url){
        $crl = curl_init();
        $timeout = 5;
        curl_setopt ($crl, CURLOPT_URL,$url);
        curl_setopt ($crl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ($crl, CURLOPT_CONNECTTIMEOUT, $timeout);
        $ret = curl_exec($crl);
        curl_close($crl);
        return $ret;
    }

    public function getRandomPicturesofUser($api_key=null, $user_id=null, $number_images=null){

        if( $api_key==null || $user_id == null || $number_images==null){return false;}

        $gallery = $this->callFlickrREST($api_key, $user_id);

        if( $gallery == false ){
            return false;
        }


        $x = ((array)$gallery->photos);
        $gallery_photos = ($x['photo']);
        $random_indexes = array_rand($gallery_photos, $number_images);

        $photos = array();

        foreach( $random_indexes as $index ){
            $photo      = $gallery_photos[$index];
            $photo_attr = $photo->attributes();

            $photos[ ((string)$photo_attr['id'])] = array(
                'id'       => ((string)$photo_attr['id']),
                'owner'    => ((string)$photo_attr['owner']),
                'secret'   => ((string)$photo_attr['secret']),
                'server'   => ((string)$photo_attr['server']),
                'farm'     => ((string)$photo_attr['farm']),
                'title'    => ((string)$photo_attr['title']),
                'ispublic' => ((string)$photo_attr['ispublic']),
                'isfriend' => ((string)$photo_attr['isfriend']),
                'isfamily' => ((string)$photo_attr['isfamily'])
            );
        }
        
        return $photos;
    }

    private function callFlickrREST( $api_key=null, $user_id=null ){

        if( $api_key==null || $user_id == null){return false;}
        
        #
        # build the API URL to call
        #

        $params = array(
                'api_key'	=> $api_key,
                'method'	=> 'flickr.people.getPublicPhotos',
                'user_id'	=> $user_id
        );

        $encoded_params = array();

        foreach ($params as $k => $v){
                $encoded_params[] = urlencode($k).'='.urlencode($v);
        }

        #
        # call the API and decode the response
        #
        $url = "http://api.flickr.com/services/rest/?".implode('&', $encoded_params);
        $rsp = $this->get_url_contents($url);
        $rsp_obj = simplexml_load_string($rsp);

        #
        # display the photo title (or an error if it failed)
        #
        $attrs = $rsp_obj->attributes();

        if ( $attrs['stat'] == 'ok'){
            return $rsp_obj;
        }else{
            return false;
        }
    }
}

?>

<?php

/* the Quote Creditation field */

add_action('add_meta_boxes', 'init_event_id_metabox');
add_action('save_post', 'save_event_id_metabox');

function init_event_id_metabox()
{
    add_meta_box(   'event_id'                  // slug / html ID
                    ,'Eventbrite ID'                // label of the box
                    ,'event_id_metabox'         // callback function
                    ,'event'                   // which post-type to show it on
                    ,'normal'                   // where in the ui ('normal','advanced','side')
                    ,'high');                   // priority ('high','low')
}

function event_id_metabox($post)
{
	$custom = get_post_custom($post->ID);
	$event_id = $custom['event_id'][0];

    wp_nonce_field( plugin_basename(__FILE__), 'event_id_metabox_nonce' ); // Use nonce for verification
    ?>
    <p><input name="event_id" type="text" style="width:100%; height:2em; font-family:inherit; font-size:2em" value="<?php echo $event_id;?>"/></p>
    <p style="font-size:1.2em"><input name="get_eventbrite" type="checkbox" /> get data from Eventbrite?</p>
    <?php
}

function save_event_id_metabox($post_id)
{   
    if ( !wp_verify_nonce( $_POST['event_id_metabox_nonce'], plugin_basename(__FILE__) )) return $post_id;

    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return $post_id;
    
    if ( !current_user_can( 'edit_post', $post_id ) ) return $post_id;    
    
    saveMeta('event_id',$post_id); // see custom-functions.php

    if ($_POST['eventbrite'])
    {
        $r = saveMetaData('eventbrite_data',$post_id,$_POST['eventbrite']);  
        if (!$r[1]) {
            PreDump($r[0]);
            PreDump($d);
            die("didn't save eventbrite data!");
        }
        $_POST['eventbrite'] = '';
    }
}

add_filter( 'wp_insert_post_data' , 'getAPIData' , '99' );

function getAPIData($data)
{
    if ($_POST['get_eventbrite'] == 'on')
    {        
        // get rid of trigger var in case it crops up again somewhere.
        $_POST['get_eventbrite'] = NULL;
        
        // grab the data from Eventbrite.
        // $url = 'http://vimeo.com/api/v2/video/'.$_POST['event_id'].'.php';
        $url = 'https://www.eventbrite.com/json/event_get?id='.$_POST['event_id'].'&app_key=NjM5OTI4ZDE2ZTQx&user_key=12942229449724844271';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $api_data = curl_exec($ch);        
        
        /*
        $options = array(
            'http' => array(
                'header' => 'Connection: close'
            )
        );
        $ctx = stream_context_create($options);
        //$data = file_get_contents($url,false,$ctx);
        
        $data = file_get_contents($url,NULL, NULL, 0, round(rand(1,4)));        
        $find = 'Content-Length: ';
        foreach($http_response_header as $h)
        {
            if (strstr($h, $find)) $len = substr($h,strlen($find));
        }   
        
        if ($len) $data = file_get_contents($url,NULL, NULL, 0, $len);
        else {
            PreDump($http_response_header);
            die("Couldn't get a content length");
        }
        */

        $d = json_decode($api_data,true);

        // update the post with data got from Eventbrite.
        $data['post_title'] = $d['event']['title'];
        $data['post_content'] = str_replace("\r\n","\r\n\r\n",strip_tags(trim($d['event']['description'])));        
        $data['post_date'] = $d['event']['start_date']; // 'post_date' => [ Y-m-d H:i:s ]
        $data['post_date_gmt'] = $d['event']['start_date']; // 'post_date' => [ Y-m-d H:i:s ]
        
        // wipe description, don't need it saving here.
        $d['event']['description'] = '';

        // enocde the data nicely to go into MySQL.
        $json = json_encode($d);        
        $base = base64_encode($json);
        
        $_POST['eventbrite'] = $base;
    }
    return $data;
}

?>
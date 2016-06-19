<?php

/* the Quote Creditation field */

add_action('add_meta_boxes', 'init_video_id_metabox');
add_action('save_post', 'save_video_id_metabox');

function init_video_id_metabox()
{
    add_meta_box(   'video_id'                  // slug / html ID
                    ,'Vimeo ID'                 // label of the box
                    ,'video_id_metabox'         // callback function
                    ,'video'                   // which post-type to show it on
                    ,'normal'                   // where in the ui ('normal','advanced','side')
                    ,'high');                   // priority ('high','low')
}

function video_id_metabox($post)
{
	$custom = get_post_custom($post->ID);
	$video_id = $custom['video_id'][0];

    wp_nonce_field( plugin_basename(__FILE__), 'video_id_metabox_nonce' ); // Use nonce for verification
    ?>
    <p><input name="video_id" type="text" style="width:100%; height:2em; font-family:inherit; font-size:2em" value="<?php echo $video_id;?>"/></p>
    <p style="font-size:1.2em"><input name="get_vimeo" type="checkbox" /> get data from Vimeo?</p>
    <?php
}

function save_video_id_metabox($post_id)
{   
    if ( !wp_verify_nonce( $_POST['video_id_metabox_nonce'], plugin_basename(__FILE__) )) return $post_id;

    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return $post_id;
    
    if ( !current_user_can( 'edit_post', $post_id ) ) return $post_id;

    if ($_POST['get_vimeo'] == 'on')
    {
        $url = 'http://vimeo.com/api/v2/video/'.$_POST['video_id'].'.php';
        $data = file_get_contents($url);
        $d = unserialize($data);
        
        $news['ID'] = $post_id;
        $newp['post_title'] = $d[0]['title'];
        $newp['post_content'] = $d[0]['description'];
        
        $_POST['get_vimeo'] = NULL;
        
        wp_update_post($newp);
        saveMetaData('vimeo_data',$post_id,$data);  
    }
    
    saveMeta('video_id',$post_id); // see custom-functions.php
}

?>
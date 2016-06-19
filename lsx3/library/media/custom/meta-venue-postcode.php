<?php

add_action('add_meta_boxes', 'init_venue_postcode_metabox');
add_action('save_post', 'save_venue_postcode_metabox');

function init_venue_postcode_metabox()
{
    add_meta_box(   'venue_postcode'                  // slug / html ID
                    ,'Postcode'                // label of the box
                    ,'venue_postcode_metabox'         // callback function
                    ,'venue'                   // which post-type to show it on
                    ,'normal'                   // where in the ui ('normal','advanced','side')
                    ,'high');                   // priority ('high','low')
}

function venue_postcode_metabox($post)
{
	$custom = get_post_custom($post->ID);
	$venue_postcode = $custom['venue_postcode'][0];

    wp_nonce_field( plugin_basename(__FILE__), 'venue_postcode_metabox_nonce' ); // Use nonce for verification
    ?>
    <p><input name="venue_postcode" type="text" style="width:100%; height:2em; font-family:inherit; font-size:2em" value="<?php echo $venue_postcode;?>"/></p>
    <?php
}

function save_venue_postcode_metabox($post_id)
{   
    // security
    if ( !wp_verify_nonce( $_POST['venue_postcode_metabox_nonce'], plugin_basename(__FILE__) )) return $post_id;
    // not on autosave
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return $post_id;
    // permissions
    if ( !current_user_can( 'edit_post', $post_id ) ) return $post_id;    
    // save it.
    saveMeta('venue_postcode',$post_id); // see custom-functions.php
}

?>
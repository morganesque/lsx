<?php

add_action('add_meta_boxes', 'init_venue_latlong_metabox');
add_action('save_post', 'save_venue_latlong_metabox');

function init_venue_latlong_metabox()
{
    add_meta_box(   'venue_latlong'                  // slug / html ID
                    ,'Global Position in Latitudinal & Longitudinal degrees from the Prime Meridian in Greenwich'                // label of the box
                    ,'venue_latlong_metabox'         // callback function
                    ,'venue'                   // which post-type to show it on
                    ,'normal'                   // where in the ui ('normal','advanced','side')
                    ,'high');                   // priority ('high','low')
}

function venue_latlong_metabox($post)
{
	$custom = get_post_custom($post->ID);
	$venue_lat = $custom['venue_lat'][0];
	$venue_long = $custom['venue_long'][0];

    wp_nonce_field( plugin_basename(__FILE__), 'venue_latlong_metabox_nonce' ); // Use nonce for verification
    ?>
    <p>Lat<input name="venue_lat" type="text" style="width:100%; height:2em; font-family:inherit; font-size:2em" value="<?php echo $venue_lat;?>"/></p>
    <p>Long<input name="venue_long" type="text" style="width:100%; height:2em; font-family:inherit; font-size:2em" value="<?php echo $venue_long;?>"/></p>
    <?php
}

function save_venue_latlong_metabox($post_id)
{   
    // security
    if ( !wp_verify_nonce( $_POST['venue_latlong_metabox_nonce'], plugin_basename(__FILE__) )) return $post_id;
    // not on autosave
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return $post_id;
    // permissions
    if ( !current_user_can( 'edit_post', $post_id ) ) return $post_id;    
    // save it.
    saveMeta('venue_long',$post_id); // see custom-functions.php
    saveMeta('venue_lat',$post_id); // see custom-functions.php
}

?>
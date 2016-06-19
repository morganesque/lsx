<?php

add_action('add_meta_boxes', 'init_event_venue_metabox');
add_action('save_post', 'save_event_venue_metabox');

function init_event_venue_metabox()
{
    add_meta_box(   'event_venue'                  // slug / html ID
                    ,'Venue'                // label of the box
                    ,'event_venue_metabox'         // callback function
                    ,'event'                   // which post-type to show it on
                    ,'normal'                   // where in the ui ('normal','advanced','side')
                    ,'high');                   // priority ('high','low')
}

function event_venue_metabox($post)
{
    $venues = new WP_Query( array( 'post_type'=>'venue', 'posts_per_page' => -1) );
    
	$custom = get_post_custom($post->ID);
	$event_venue = $custom['event_venue'][0];
    wp_nonce_field( plugin_basename(__FILE__), 'event_venue_metabox_nonce' ); // Use nonce for verification
    
    echo '<select style="font-family:inherit; font-size:2em" name="event_venue">';
    foreach($venues->posts as $v)
    {
        $sel = ($event_venue == $v->ID) ? ' selected="selected"' : '' ;
        echo '<option value="'.$v->ID.'"'.$sel.'>'.$v->post_title.'</option>';
    }
    echo '</select>';
}

function save_event_venue_metabox($post_id)
{   
    // security
    if ( !wp_verify_nonce( $_POST['event_venue_metabox_nonce'], plugin_basename(__FILE__) )) return $post_id;
    // not on autosave
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return $post_id;
    // permissions
    if ( !current_user_can( 'edit_post', $post_id ) ) return $post_id;    
    // save it.
    saveMeta('event_venue',$post_id); // see custom-functions.php
}

?>
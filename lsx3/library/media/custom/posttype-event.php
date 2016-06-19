<?php

/*
    In which all the custom-post-type stuff for the Event pages will be kept.
*/

add_action('init', 'event');

function event() 
{
    $labels = array(
        'name' => _x('Events', 'post type general name'),
        'singular_name' => _x('Event', 'post type singular name'),
        'add_new' => _x('Add New Event', 'news'),
        'add_new_item' => __('Add New Event'),
        'edit_item' => __('Edit Event'),
        'new_item' => __('New Event'),
        'view_item' => __('View Event'),
        'search_items' => __('Search Events'),
        'not_found' =>  __('No Event found'),
        'not_found_in_trash' => __('No Event in Trash'), 
        'parent_item_colon' => ''
      );
      
	$args = array(
    	'labels' => $labels,
    	'public' => true,
    	'show_ui' => true,
    	'menu_position' => 4,
    	'capability_type' => 'post',
    	'hierarchical' => false,
        'query_var' => true,
        '_builtin' => false,
    	'supports' => array('title','editor','comments'),
    	'taxonomies' => array('category'),
    	'has_archive' => true,
    	'rewrite' => true
    );

	register_post_type('event',$args);
}

include_once (THEMEMEDIA.'/custom/meta-event-id.php');
include_once (THEMEMEDIA.'/custom/meta-event-venue.php');
include_once (THEMEMEDIA.'/custom/meta-eventbrite-data.php');
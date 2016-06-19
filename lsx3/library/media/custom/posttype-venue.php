<?php

/*
    In which all the custom-post-type stuff for the Venue pages will be kept.
*/

add_action('init', 'venue');

function venue() 
{
    $labels = array(
        'name' => _x('Venues', 'post type general name'),
        'singular_name' => _x('Venue', 'post type singular name'),
        'add_new' => _x('Add New Venue', 'news'),
        'add_new_item' => __('Add New Venue'),
        'edit_item' => __('Edit Venue'),
        'new_item' => __('New Venue'),
        'view_item' => __('View Venue'),
        'search_items' => __('Search Venues'),
        'not_found' =>  __('No Venue found'),
        'not_found_in_trash' => __('No Venue in Trash'), 
        'parent_item_colon' => ''
      );
      
	$args = array(
    	'labels' => $labels,
    	'public' => true,
    	'show_ui' => true,
    	'menu_position' => 5,
    	'capability_type' => 'post',
    	'hierarchical' => false,
        'query_var' => true,
        '_builtin' => false,
    	'supports' => array('title','editor','comments'),
    	'taxonomies' => array(),
    	'has_archive' => true,
    	'rewrite' => true
    );

	register_post_type('venue',$args);
}

include_once (THEMEMEDIA.'/custom/meta-venue-address.php');
include_once (THEMEMEDIA.'/custom/meta-venue-postcode.php');
include_once (THEMEMEDIA.'/custom/meta-venue-latlong.php');
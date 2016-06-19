<?php

/*
    In which all the custom-post-type stuff for the Video pages will be kept.
*/

add_action('init', 'video');

function video() 
{
    $labels = array(
        'name' => _x('Videos', 'post type general name'),
        'singular_name' => _x('Video', 'post type singular name'),
        'add_new' => _x('Add New Video', 'news'),
        'add_new_item' => __('Add New Video'),
        'edit_item' => __('Edit Video'),
        'new_item' => __('New Video'),
        'view_item' => __('View Video'),
        'search_items' => __('Search Videos'),
        'not_found' =>  __('No Video found'),
        'not_found_in_trash' => __('No Video in Trash'), 
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
    	'supports' => array('title','editor','thumbnail','comments'),
    	'taxonomies' => array('category'),
    	'has_archive' => true,
    	'rewrite' => true
    );

	register_post_type('video',$args);
}

include_once (THEMEMEDIA.'/custom/meta-video-id.php');
include_once (THEMEMEDIA.'/custom/meta-vimeo-data.php');
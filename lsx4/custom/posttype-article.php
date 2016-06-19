<?php

/*
    In which all the custom-post-type stuff for the Article pages will be kept.
*/

add_action('init', 'article');

function article() 
{
    $labels = array(
        'name' => _x('Articles', 'post type general name'),
        'singular_name' => _x('Article', 'post type singular name'),
        'add_new' => _x('Add New Article', 'news'),
        'add_new_item' => __('Add New Article'),
        'edit_item' => __('Edit Article'),
        'new_item' => __('New Article'),
        'view_item' => __('View Article'),
        'search_items' => __('Search Articles'),
        'not_found' =>  __('No Article found'),
        'not_found_in_trash' => __('No Article in Trash'), 
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

	register_post_type('article',$args);
}

include_once ('meta-article-byline.php');
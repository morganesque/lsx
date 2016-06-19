<?php
    define( 'THEME', get_bloginfo( 'template_url' ), true );
    define( 'CSS', THEME . '/_/css', true );
	define( 'IMAGES', THEME . '/_/images', true );
	define( 'JS', THEME . '/_/js', true );
	define( 'FRAGPATH', THEME . '/frags', true );
		
	// include all the custom post type stuff.
	require_once ('custom/posttype-event.php');
    require_once ('custom/posttype-video.php');
    require_once ('custom/posttype-venue.php');
    require_once ('custom/posttype-article.php');
    
    // include all the extra functions / classes etc.
    require_once ('extensions/colour-utils.php');
    require_once ('extensions/twitter-search.php');
    require_once ('extensions/helper_functions.php');
    require_once ('extensions/theme-specific.php');

    // make sure videos get post-thumbnails.
    add_theme_support( 'post-thumbnails', array('video'));

    // Translations can be filed in the /languages/ directory
    load_theme_textdomain( 'html5reset', TEMPLATEPATH . '/languages' );

    $locale = get_locale();
    $locale_file = TEMPLATEPATH . "/languages/$locale.php";
    if ( is_readable($locale_file) )
    require_once($locale_file);
	
	// Add RSS links to <head> section
	automatic_feed_links();
	
	// Load jQuery
	if ( !function_exists(core_mods) ) {
		function core_mods() {
			if ( !is_admin() ) {
				wp_deregister_script('jquery');
				wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"), false);
				wp_enqueue_script('jquery');
				wp_enqueue_script('jquery-ui', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.10/jquery-ui.min.js', 'jquery');
			}
		}
		core_mods();
	}

	// Clean up the <head>
	function removeHeadLinks() {
    	remove_action('wp_head', 'rsd_link');
    	remove_action('wp_head', 'wlwmanifest_link');
    }
    add_action('init', 'removeHeadLinks');
    remove_action('wp_head', 'wp_generator');
    
    if (function_exists('register_sidebar')) {
    	register_sidebar(array(
    		'name' => __('Sidebar Widgets','html5reset' ),
    		'id'   => 'sidebar-widgets',
    		'description'   => __( 'These are widgets for the sidebar.','html5reset' ),
    		'before_widget' => '<div id="%1$s" class="widget %2$s">',
    		'after_widget'  => '</div>',
    		'before_title'  => '<h2>',
    		'after_title'   => '</h2>'
    	));
    }
    
    // add_theme_support( 'post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'audio', 'chat', 'video')); // Add 3.1 post format theme support.

function tomDisplayComment($comment, $args, $depth)
{    
    $GLOBALS['comment'] = $comment;
    
    $time = get_comment_time();
    $col1 = ColourUtils::stringtorgba($time, 0.42);
    
    $link = esc_url( get_comment_link( $comment->comment_ID ) );
    $col2 = ColourUtils::stringtorgba($link, 0.42);
    ?>
    <li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
        <div class="comment-author vcard"><?php echo get_avatar( $comment->comment_author_email, 100 ); ?></div>
        <div class="comment-meta">
            <p class='date'><?php 
                    comment_date('jS'); 
                    // echo ' <span class="long">';
                    // comment_date('F');
                    // echo '</span>'; 
                    // echo ' <span class="short">';
                    comment_date(' M ');
                    // echo '</span>'; 
                    comment_date('Y') 
                ?></p>
            <p class="time" style="background-color:<?php echo $col1; ?>"><?php echo $time ?></p>
            <p class="link" style="background-color:<?php echo $col2; ?>"><a href="<?php echo $link ?>">permalink</a></p>
        </div>
        <div class="text">
            <h4><?php echo get_comment_author_link() ?></h4>
            <?php comment_text() ?>
        </div>
    <?
}

?>
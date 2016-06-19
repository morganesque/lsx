<?php
require_once (THEMEMEDIA.'/custom/posttype-event.php');
require_once (THEMEMEDIA.'/custom/posttype-video.php');
require_once (THEMEMEDIA.'/custom/posttype-venue.php');
require_once (THEMEMEDIA.'/custom/posttype-article.php');

add_theme_support( 'post-thumbnails', array('video'));

// featured images in posts.
// add_theme_support('post-thumbnails', array('post'));

/*
    useful function because saving meta box data is always the same.
*/
function saveMeta($mkey,$post_id)
{
    $data = $_POST[$mkey];    
    if (is_array($data)) $data = base64_encode(serialize($data));
    saveMetaData($mkey,$post_id,$data);
}

function saveMetaData($mkey,$post_id,$data)
{       
    if (get_post_meta($post_id, $mkey) == "")
    
        return array('add',add_post_meta($post_id, $mkey , $data));
        
    elseif ($data != get_post_meta($post_id, $mkey, true))  
    
        return array('update',update_post_meta($post_id, $mkey, $data));  
        
    elseif ($data == "")  
    
        return array('delete',delete_post_meta($post_id, $mkey, get_post_meta($post_id, $mkey, true)));
        
    return array('none',true);
}

/*
    The old PreDump function from way back when.
*/
function PreDump($data)
{
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
}

/*
    This is a very handy function I got from somewhere which spits out the current template being used.
*/
function get_template_name () 
{
    $db = debug_backtrace();
	foreach ( $db as $called_file ) 
	{
		foreach ( $called_file as $index ) 
		{
			if ( !is_array($index[0]) AND (strstr($index[0],'/themes/') OR strstr($index[0],'\\themes\\')) AND !strstr($index[0],'footer.php') ) {			    
				$template_file = $index[0] ;
			}
		}
	}
	if ($template_file)
	{
    	$template_contents = file_get_contents($template_file) ;
    	preg_match_all("(Template Name:(.*)\n)siU",$template_contents,$template_name);
    	$template_name = trim($template_name[1][0]);
    	if ( !$template_name ) { $template_name = '(default)' ; }
    	$template_file = array_pop(explode('/themes/', basename($template_file)));
    	return $template_file . ' > '. $template_name ;
    }
}

/*
    Always doing this so here's a quick function to make it easier.
    The array you get has a key = the attachment "title" so it's good
    for grouping attachments based on their titles (which is sometimes handy).
*/
function getPostAttachements($postid)
{
    $attachments = get_posts('post_type=attachment&post_parent='.$postid.'&orderby=menu_order&order=ASC&numberposts=-1');	
	$atts = array();
    foreach($attachments as $a) 
    {
        $mime = split('/',$a->post_mime_type);
        if ($mime[0] == 'image') $atts[$a->post_title][] = wp_get_attachment_image_src($a->ID,'full');
        if ($mime[0] == 'video') $atts[$a->post_title][] = wp_get_attachment_url($a->ID);   
    }
    return $atts;
}

/*
    This is all stuff to simplify the interface for Editor users.
*/
if ( is_user_logged_in() ) 
{
    global $table_prefix;
    $current_user = wp_get_current_user();
    
    $k = $table_prefix.'capabilities';
	$userRole = ($current_user->data->$k);
	
	$role = key($userRole);
	unset($userRole);

    if ($role=='editor') 
    {
        /*
            removing some of the menu items that aren't needed
        */
        add_action('admin_head', 'remove_profile_submenu');
        function remove_profile_submenu() 
        {            
            global $menu;
            unset($menu[2]);
            unset($menu[4]);
            unset($menu[25]);
            unset($menu[15]);
            unset($menu[10]);
            unset($menu[59]);
            unset($menu[70]);
            unset($menu[75]);
            
            $menu[20][4] .=  " menu-top-last";
            $menu[6][4] .=  " menu-icon-users";
            
            /*
                changing the logo in at the top and removing a couple of header items.
            */
            ?>
            <style type="text/css">
            /* Change the logo image at the top */
            #header-logo{
            background:url(<?php echo IMAGES; ?>/admin-logo.png) left center no-repeat;
            width:32px;
            height:32px;
            }
            .update-nag {display:none;} /* remove the Update Now message */
            #favorite-actions {display:none;} /* remove the favourites drop down menu thing */
            </style>
            <?php
        }        
        
        /*
            trying to stop people hitting the dashboard.
        */
        add_action('admin_menu', 'profile_redirect');
        function profile_redirect() 
        {
            $result = stripos($_SERVER['REQUEST_URI'], 'index.php');
            $result = ($_SERVER['REQUEST_URI'] == '/wp-admin/');

            if ($result!==false) 
            {
                wp_redirect(get_option('siteurl') . '/wp-admin/edit.php');
            }
        } 
    
        /*
            Change the Posts to be called News.
        */
        add_action( 'admin_menu', 'change_post_menu_label' );
        function change_post_menu_label() {
        	global $menu;
        	global $submenu;
        	$menu[5][0] = 'News';
        	$submenu['edit.php'][5][0] = 'News';
        	$submenu['edit.php'][10][0] = 'Add News';
            unset($submenu['edit.php'][15]); 
            unset($submenu['edit.php'][16]); //[0] = 'News Tags';
        	echo '';
        }
    
        /*
            change the Posts to be called News.
        */
        add_action( 'init', 'change_post_object_label' );
        function change_post_object_label() {
        	global $wp_post_types;
        	$labels = &$wp_post_types['post']->labels;
        	$labels->name = 'News';
        	$labels->singular_name = 'News';
        	$labels->add_new = 'Add News';
        	$labels->add_new_item = 'Add News';
        	$labels->edit_item = 'Edit News';
        	$labels->new_item = 'News';
        	$labels->view_item = 'View News';
        	$labels->search_items = 'Search News';
        	$labels->not_found = 'No News found';
        	$labels->not_found_in_trash = 'No News found in Trash';
        }
    } 
       
}

/*
    Remove a load of things from pages and posts which I don't need.
*/
add_action('init', 'change_post_type_supports');
function change_post_type_supports()
{
    /*
    remove_post_type_support('post', 'excerpt');
    remove_post_type_support('post', 'author');
    remove_post_type_support('post', 'trackbacks');
    remove_post_type_support('post', 'custom-fields');
    remove_post_type_support('post', 'comments');
    remove_post_type_support('post', 'revisions');
    
    remove_post_type_support('page', 'author');
    remove_post_type_support('page', 'custom-fields');
    remove_post_type_support('page', 'comments');
    remove_post_type_support('page', 'revisions');
    */
}

/*
    Change the WYSIWYG editor a bit
    - - - - - - - - - - - - - - - -     
*/
add_filter('tiny_mce_before_init', 'change_mce_options');
function change_mce_options( $init ) 
{
     $init['theme_advanced_blockformats'] = 'p,address,pre,code,h3,h4,h5,h6';
     $init['theme_advanced_disable'] = 'forecolor';
     // $init['theme_advanced_styles'] = "Disclaimer=disclaimer";
     $init['theme_advanced_buttons2_add_before'] = "styleselect";
     $init['content_css'] = CSS."/admin.css?".time(); 
     return $init;
}

/*
    Add custom post types to the RSS feed
    - - - - - - - - - - - - - - - - - - -
*/
function myfeed_request($qv) {
	if (isset($qv['feed']) && !isset($qv['post_type']))
		$qv['post_type'] = array('post', 'video', 'event');
	return $qv;
}
add_filter('request', 'myfeed_request');

/*
    Add new rewrite rules
    - - - - - - - - - - -
*/
add_filter('rewrite_rules_array', 'add_rewrite_rules');

function add_rewrite_rules($aRules) {
    $aNewRules = array(
        'events/?$' => 'index.php?post_type=event'
        ,'videos/?$' => 'index.php?post_type=video'
        ,'news/?$' => 'index.php?post_type=article'
        );
    $aRules = $aNewRules + $aRules;
    return $aRules;
}

function doBack($string, $alpha)
{
    return 'background-color:'.ColourUtils::stringtorgba($string,$alpha);
}

function doBackNum($num, $max, $alpha)
{
    return 'background-color:'.ColourUtils::num2rgba($num,$max,$alpha);
}

function lsx_get_gravatar($email, $size)
{
    $md5 = md5($email);
    $id = substr(ord($md5),-1);
    return '<img src="http://www.gravatar.com/avatar/'.$md5.'?s='.$size.'&d='.get_bloginfo("template_url").'/images/avatars/'.$id.'.png" />';
}

add_filter('framework_comment_meta_format', 'my_framework_comment_meta_format', 10, 1);
function my_framework_comment_meta_format($meta_format)
{
    // '%date% at %time% | %link% %edit%'
    ob_start();    
    ?>
        <p class="date">%date%</p>
        <p class="time" style="<?php echo doBack('ztime',0.22);?>">%time%</p>
        <p class="link" style="<?php echo doBack('link',0.22);?>">%link%</p>
        <div>%edit%</div>
    <?php
    $meta_format = ob_get_contents();
    ob_end_clean();
    return $meta_format;
}

?>
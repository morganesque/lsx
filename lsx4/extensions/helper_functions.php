<?php

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

function get_template_name() 
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
    Wrapper functions for getting colours with the ColourUtils class.
*/
function doBack($string, $alpha)
{
    return 'background-color:'.ColourUtils::stringtorgba($string,$alpha);
}

function doBackNum($num, $max, $alpha)
{
    return 'background-color:'.ColourUtils::num2rgba($num,$max,$alpha);
}

/*
    Gets your gravatar for display on the site (includes a backup for people without).
*/
function lsx_get_gravatar($email, $size)
{
    $md5 = md5($email);
    $id = substr(ord($md5),-1);
    return '<img src="http://www.gravatar.com/avatar/'.$md5.'?s='.$size.'&d='.get_bloginfo("template_url").'/images/avatars/'.$id.'.png" />';
}

?>
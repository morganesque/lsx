<?php

/* the Quote Creditation field */

add_action('add_meta_boxes', 'init_vimeo_data_metabox');

function init_vimeo_data_metabox()
{
    add_meta_box(   'vimeo_data'                  // slug / html ID
                    ,'Vimeo Data'                 // label of the box
                    ,'vimeo_data_metabox'         // callback function
                    ,'video'                   // which post-type to show it on
                    ,'normal'                   // where in the ui ('normal','advanced','side')
                    ,'high');                   // priority ('high','low')
}

function vimeo_data_metabox($post)
{
	$custom = get_post_custom($post->ID);
	$vimeo_data = unserialize(unserialize($custom['vimeo_data'][0]));
	echo '<dl>';
	$leave  = array('id','title','description');
	if ($vimeo_data)
    foreach($vimeo_data[0] as $k=>$v)
    {
        if (in_array($k,$leave)) continue;
        echo '<dt style="float:left; font-weight:bold; width:25%; text-align:right; padding-right:1%">'.$k.'</dt>';
        echo '<dd style="overflow:auto">'.$v  .'</dd>';
    }
    echo '</dl>';
}

?>
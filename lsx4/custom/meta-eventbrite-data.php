<?php

/* the Quote Creditation field */

add_action('add_meta_boxes', 'init_eventbrite_data_metabox');

function init_eventbrite_data_metabox()
{
    add_meta_box(   'eventbrite_data'                  // slug / html ID
                    ,'Eventbrite Data'                 // label of the box
                    ,'eventbrite_data_metabox'      // callback function
                    ,'event'                        // which post-type to show it on
                    ,'normal'                   // where in the ui ('normal','advanced','side')
                    ,'high');                   // priority ('high','low')
}

function eventbrite_data_metabox($post)
{
	$custom = get_post_custom($post->ID);
	$eventbrite_data = json_decode(base64_decode($custom['eventbrite_data'][0]),true);
	
	echo '<dl>';
    	if ($eventbrite_data) outputDLItems($eventbrite_data['event']);
    echo '</dl>';
}

function outputDLItems($array)
{
    $leave  = array('id','title','description');

    foreach($array as $k=>$v)
    {
        if (is_array($v))
        {
            echo '<hr style="clear:both"/>';
            echo '<dt>'.$k.'</dt>';
            outputDLItems($v);
            echo '<hr/>';
        } else {
            if (in_array($k,$leave)) continue;
            echo '<dt style="clear:left;float:left; font-weight:bold; width:25%; text-align:right; padding-right:1%">'.$k.'</dt>';
            if ($v == '') $v = '&nbsp;';
            echo '<dd style="overflow:auto">'.$v  .'</dd>';
        }
    }

}

?>
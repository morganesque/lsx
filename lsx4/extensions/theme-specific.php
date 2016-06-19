<?php


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
function add_rewrite_rules($aRules) {
    $aNewRules = array(
        'events/?$' => 'index.php?post_type=event'
        ,'videos/?$' => 'index.php?post_type=video'
        ,'articles/?$' => 'index.php?post_type=article'
        ,'barcamp/?$' => 'index.php?category_name=barcamp'
        ,'lsxcafe/?$' => 'index.php?category_name=lsxcafe'
        ,'ignite/?$' => 'index.php?category_name=ignite'
        ,'girlgeek/?$' => 'index.php?category_name=girlgeek'
        ,'tedx/?$' => 'index.php?category_name=tedx'
        ,'wepublish/?$' => 'index.php?category_name=wepublish'
        );
        
    
        
    $aRules = $aNewRules + $aRules;
    return $aRules;
}
add_filter('rewrite_rules_array', 'add_rewrite_rules');


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
add_filter('framework_comment_meta_format', 'my_framework_comment_meta_format', 10, 1);
?>
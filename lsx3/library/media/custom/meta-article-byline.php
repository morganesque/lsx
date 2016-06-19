<?php

/* the Quote Creditation field */

add_action('add_meta_boxes', 'init_article_byline_metabox');
add_action('save_post', 'save_article_byline_metabox');

function init_article_byline_metabox()
{
    add_meta_box(   'article_byline'                  // slug / html ID
                    ,'By line'                // label of the box
                    ,'article_byline_metabox'         // callback function
                    ,'article'                   // which post-type to show it on
                    ,'normal'                   // where in the ui ('normal','advanced','side')
                    ,'high');                   // priority ('high','low')
}

function article_byline_metabox($post)
{   
	$custom = get_post_custom($post->ID);
	$article_byline = $custom['article_byline'][0];

    wp_nonce_field( plugin_basename(__FILE__), 'article_byline_metabox_nonce' ); // Use nonce for verification
    ?>
    <p><input name="article_byline" type="text" style="width:100%; height:2em; font-family:inherit; font-size:2em" value="<?php echo $article_byline;?>"/></p>
    <?php
}

function save_article_byline_metabox($post_id)
{   
    if ( !wp_verify_nonce( $_POST['article_byline_metabox_nonce'], plugin_basename(__FILE__) )) return $post_id;

    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return $post_id;
    
    if ( !current_user_can( 'edit_post', $post_id ) ) return $post_id;    
    
    saveMeta('article_byline',$post_id); // see custom-functions.php
}



?>
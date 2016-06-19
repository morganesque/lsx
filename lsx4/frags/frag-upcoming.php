<div class="m-upcoming r-mod">
<?php

$title = "upcoming";

$query_opts = array( 
     'post_type'=>'event '
    ,'posts_per_page' => 10
    ,'orderby' => 'date'
    ,'order' => 'ASC'
    ,'post_status' => 'future'
);

wp_reset_query();
if (is_page())
{
    $query_opts['category_name'] = $post->post_name;
    $title = 'upcoming '.$post->post_title.' events';
}

if (is_single())
{
    $up_cats = get_the_category($post->ID);
    $nup = array();
    foreach($up_cats as $c) $nup[] = $c->term_id;
    $query_opts['category__in'] = $nup;
}

$upcoming = new WP_Query($query_opts);

$col = ColourUtils::stringtorgba('upcoming', 0.76);

if(count($upcoming->posts))
{
    echo '<h3 class="tk-tachyon" style="background-color:'.$col.'">'.$title.'</h3>';

    foreach($upcoming->posts as $post)
    {
        $datetime = strtotime($post->post_date_gmt);    
        
        $venue_id = get_post_meta($post->ID, 'event_venue', true);
        $venue = get_post($venue_id);
    
        $cats = '';
        foreach(get_the_category($post->ID) as $c) $cats.=$c->slug;
    
        ?>
            <a href="<?php echo get_permalink($post->ID) ?>" class="item">                
                <p class="date bold"><?php echo date('jS',$datetime); ?> <span class="long"><?php echo date('F',$datetime); ?></span><span class="short"><?php echo date('M',$datetime); ?></span> <?php echo date('Y',$datetime); ?></p>
                <p class="name"><?php echo $post->post_title; ?></p>
                <p class="venue"><span style="color:<?php echo ColourUtils::stringtorgba($venue->post_title,0.42); ?>">@</span>&nbsp;<?php echo $venue->post_title; ?></p>  
            </a>
        <?php
    }
} else {
    echo '<p>No related upcoming events.</p>';
}

?>
</div><!-- #lsx-upcoming -->
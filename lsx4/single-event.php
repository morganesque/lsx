<?php get_header(); ?>

<?php

the_post();

$venue_id = get_post_meta($post->ID, 'event_venue', true);
if ($venue_id) $venue = get_post($venue_id);

$lat = get_post_meta($venue->ID, 'venue_lat', true);
$long = get_post_meta($venue->ID, 'venue_long', true);
$address = get_post_meta($venue->ID, 'venue_address', true);
$postcode = get_post_meta($venue->ID, 'venue_postcode', true);

$datetime = strtotime($post->post_date_gmt);

?>

<section id="content" class="clearfix">
    
    <div class="left">
    
        <article>
            <h2><?php the_title(); ?></h2>
    
            <div id="map_canvas" data-lat="<?php echo $lat; ?>" data-long="<?php echo $long; ?>">
                <div>
                    <div id="map_info">
                        <?php if($venue): ?>
                            <p class="date">
                                <?php echo $venue->post_title; ?><br />
                                <?php echo $address; ?><br />
                                <?php echo $postcode; ?>
                            </p>
                        <?php endif; ?>
                    </div>
                </div>    
            </div>
        
            <!-- <span class="comment-count"><a href="<?php comments_link(); ?>"><?php comments_number( 'Leave a Comment', '1 Comment', '% Comments' ); ?></a></span> -->		
		
    		<?php comments_template( '', true ); ?>
		</article>
    
    </div><!-- #left -->

    <div class="right">  
        <?php include ( TEMPLATEPATH . '/frags/frag-search.php' ); ?>          
        <?php include ( TEMPLATEPATH . '/frags/frag-icons.php' ); ?>          
        <?php include ( TEMPLATEPATH . '/frags/frag-upcoming.php' ); ?>
        <?php include ( TEMPLATEPATH . '/frags/frag-twitter.php' ); ?>    
    </div><!-- #right -->
    
</section>

<?php get_footer(); ?>


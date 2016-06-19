<?php
/**
 * Template: Single.php
 *
 * @package WPFramework
 * @subpackage Template
 */

get_header();

the_post();

$venue_id = get_post_meta($post->ID, 'event_venue', true);
if ($venue_id) $venue = get_post($venue_id);

$lat = get_post_meta($venue->ID, 'venue_lat', true);
$long = get_post_meta($venue->ID, 'venue_long', true);
$address = get_post_meta($venue->ID, 'venue_address', true);
$postcode = get_post_meta($venue->ID, 'venue_postcode', true);

$datetime = strtotime($post->post_date_gmt);

?>

<div id="body" class="mod">

    <div id="left">
        
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
		
	    <?php if ( framework_get_terms( 'tags' ) ) { ?>
        <span class="meta-sep">|</span>
        <span class="entry-tags">Tagged <?php echo framework_get_terms( 'tags' ); ?></span>
        <?php } ?>
		
		<?php comments_template( '', true ); ?>
    
    </div><!-- #left -->

    <div id="right">  
        <h3><?php echo date('g:ia<\b\r />jS F Y',$datetime)?></h3>          
        <article>
        <?php the_content(); ?>
        </article>
    </div><!-- #right -->

</div><!-- #body -->

<?php get_footer(); ?>
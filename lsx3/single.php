<?php
/**
 * Template: Single.php
 *
 * @package WPFramework
 * @subpackage Template
 */

get_header();
?>

<div id="middle" class="single">
    
	<header><h1 class="tk-tachyon">article</h1></header>
    
    <article>
    <?php while ( have_posts() ) : the_post(); ?>
        
        <h2><?php the_title(); ?></h2>
        
        <p class="byline">
            <span class="author vcard">Written by <?php printf( '<a class="bg-gre" href="' . get_author_posts_url( $authordata->ID, $authordata->display_name ) . '" title="' . sprintf( 'View all posts by %s', $authordata->display_name ) . '">&nbsp;' . get_the_author() . '&nbsp;</a>' ) ?></span>
		<span class="published">on <abbr class="published-time bg-yel" title="<?php the_time( get_option('date_format') .' - '. get_option('time_format') ); ?>">&nbsp;<?php the_time( get_option('date_format') ); ?>&nbsp;</abbr></span>
		</p>
        
        <section>
        <?php the_content(); ?>
        </section>
        
        
        <!-- <span class="comment-count"><a href="<?php comments_link(); ?>"><?php comments_number( 'Leave a Comment', '1 Comment', '% Comments' ); ?></a></span> -->
		
	    <?php if ( framework_get_terms( 'tags' ) ) { ?>
        <span class="meta-sep">|</span>
        <span class="entry-tags">Tagged <?php echo framework_get_terms( 'tags' ); ?></span>
        <?php } ?>
		
		<?php comments_template( '', true ); ?>
		
	<?php endwhile; ?>
    </article>
    
</div><!-- #middle -->

<?php get_footer(); ?>
<?php
/**
 * Template: Single.php
 *
 * @package WPFramework
 * @subpackage Template
 */

get_header();
?>

<div id="body" class="mod">

    <div id="left">
    
        <article>
        <?php while ( have_posts() ) : the_post(); ?>

            <?php
            $custom = get_post_custom($post->ID);
            $by = trim($custom['article_byline'][0]); 
            if (!$by) $by = get_the_author();
            $bycol = ColourUtils::string2hex($by); 

            $when = get_the_time(get_option('date_format'));
            $whencol = ColourUtils::string2hex($when); 
            ?>

            <h2><?php the_title(); ?></h2>

            <p class="byline">Written by
                <span class="author" style="background-color:<?php echo $bycol; ?>">&nbsp;<?php echo $by; ?>&nbsp;</span>            
    		    <span class="published">on <abbr class="published-time" style="background-color:<?php echo $whencol; ?>" title="<?php the_time( get_option('date_format') .' - '. get_option('time_format') ); ?>">&nbsp;<?php echo $when ?>&nbsp;</abbr></span>
    		</p>

            <section>
            <?php the_content(); ?>
            </section>


            <!-- <span class="comment-count"><a href="<?php comments_link(); ?>"><?php comments_number( 'Leave a Comment', '1 Comment', '% Comments' ); ?></a></span> -->

    	    <?php if ( framework_get_terms( 'tags' ) ) { ?>
            <span class="meta-sep">|</span>
            <span class="entry-tags">Tagged <?php echo framework_get_terms( 'tags' ); ?></span>
            <?php } ?>

    	<?php endwhile; ?>
        </article>
        
        <?php comments_template( '', true ); ?>
    
    </div><!-- #left -->

    <div id="right">            
        <?php // include ( TEMPLATEPATH . '/frag-about.php' ); ?>
        <?php include ( TEMPLATEPATH . '/frag-upcoming.php' ); ?>
        <?php include ( TEMPLATEPATH . '/frag-twitter.php' ); ?>    
    </div><!-- #right -->

</div><!-- #body -->

<?php get_footer(); ?>
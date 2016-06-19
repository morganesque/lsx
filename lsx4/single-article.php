<?php get_header(); ?>

<section id="content" class="clearfix">
    
    <div class="reading">
    
        <article>
            <?php while ( have_posts() ) : the_post(); ?>

                <?php
                $custom = get_post_custom($post->ID);

                $by = trim($custom['article_byline'][0]); 
                if (!$by) $by = get_the_author();

                $when = get_the_time(get_option('date_format'));
                ?>

                <h2><?php the_title(); ?></h2>

                <p class="byline">Written by
                    <span class="author" style="<?php echo doBack($by, 0.42); ?>">&nbsp;<?php echo $by; ?>&nbsp;</span>            
        		    <span class="published">on <abbr class="published-time" style="<?php echo doBack($when, 0.42); ?>" title="<?php the_time( get_option('date_format') .' - '. get_option('time_format') ); ?>">&nbsp;<?php echo $when ?>&nbsp;</abbr></span>
        		</p>

                <section>
                <?php the_content(); ?>
                </section>


        	<?php endwhile; ?>
		    
    		<?php comments_template( '', true ); ?>
		</article>
				
    
    </div><!-- #reading -->
    
</section>

<?php get_footer(); ?>


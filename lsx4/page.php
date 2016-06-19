<?php get_header(); ?>

<section id="content" class="clearfix">
    
    <div class="left">
    
		<article class="post" id="post-<?php the_ID(); ?>">

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


			<?php the_content(); ?>


            <?php comments_template(); ?>

		</article>
    
    </div><!-- #left -->

    <div class="right">  
        <?php include ( TEMPLATEPATH . '/frags/frag-search.php' ); ?>          
        <?php include ( TEMPLATEPATH . '/frags/frag-icons.php' ); ?>          
        <?php include ( TEMPLATEPATH . '/frags/frag-about.php' ); ?>
        <?php include ( TEMPLATEPATH . '/frags/frag-upcoming.php' ); ?>
        <?php include ( TEMPLATEPATH . '/frags/frag-twitter.php' ); ?>    
    </div><!-- #right -->
    
</section>

<?php get_footer(); ?>
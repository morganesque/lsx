<?php get_header(); ?>

<section id="content" class="clearfix">
    
    <div class="left">
    
        <div class="index">    
            <?php // include ( TEMPLATEPATH . '/frags/frag-hero.php' ); ?>
            <?php        
                wp_reset_query();
                query_posts(array('order' => DESC,  'post_type' => array('article', 'event', 'video'), 'posts_per_page' => 10));
                include ( TEMPLATEPATH . '/frags/frag-index.php' );    
            ?>
        </div><!-- #index -->
    
    </div><!-- #left -->

    <div class="right">  
        <?php include ( TEMPLATEPATH . '/frags/frag-subs.php' ); ?>          
        <?php include ( TEMPLATEPATH . '/frags/frag-search.php' ); ?>          
        <?php include ( TEMPLATEPATH . '/frags/frag-icons.php' ); ?>          
        <?php include ( TEMPLATEPATH . '/frags/frag-about.php' ); ?>
        <?php include ( TEMPLATEPATH . '/frags/frag-upcoming.php' ); ?>
        <?php include ( TEMPLATEPATH . '/frags/frag-twitter.php' ); ?>    
    </div><!-- #right -->
    
</section>

<?php get_footer(); ?>
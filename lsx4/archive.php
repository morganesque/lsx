<?php get_header(); ?>
<section id="content" class="clearfix">
    
    <div class="left">
    
        <div class="index">    
            <?php // include ( TEMPLATEPATH . '/frags/frag-hero.php' ); ?>
            <?php                
            
                if ($wp_query->query['category_name'] != NULL)
                {
                    $args = array_merge( $wp_query->query, array( 'post_type' => array('post', 'event', 'video','article') ) );
                    query_posts($args);
                }
                
                include ( TEMPLATEPATH . '/frags/frag-index.php' );    
            ?>
        </div><!-- #index -->
    
    </div><!-- #left -->

    <div class="right">  
        <?php include ( TEMPLATEPATH . '/frags/frag-search.php' ); ?>          
        <?php include ( TEMPLATEPATH . '/frags/frag-icons.php' ); ?>          
        <?php include ( TEMPLATEPATH . '/frags/frag-upcoming.php' ); ?>
        <?php include ( TEMPLATEPATH . '/frags/frag-twitter.php' ); ?>    
    </div><!-- #right -->
    
</section>

<?php get_footer(); ?>
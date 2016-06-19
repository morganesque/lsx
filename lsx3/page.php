<?php get_header(); ?>

<div id="body" class="mod">

    <div id="left">
    
        <section id="index">

            <?php

            wp_reset_query();
            query_posts(array(
                'order' => DESC,  
                'post_type' => array('post', 'event', 'video'), 
                'posts_per_page' => 10,
                'category_name' => $post->post_name,
                ));            
            include ( TEMPLATEPATH . '/frag-index.php' );

            ?>
        </section>
    
    </div><!-- #left -->

    <div id="right">            
        <?php include ( TEMPLATEPATH . '/frag-about.php' ); ?>
        <?php include ( TEMPLATEPATH . '/frag-upcoming.php' ); ?>
        <?php include ( TEMPLATEPATH . '/frag-twitter.php' ); ?>    
    </div><!-- #right -->

</div><!-- #body -->

<?php get_footer(); ?>
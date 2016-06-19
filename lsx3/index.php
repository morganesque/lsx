<?php get_header(); ?>

<div id="body" class="mod">

    <div id="left">
    
        <div id="hero">
            <?php include ( TEMPLATEPATH . '/frag-hero.php' ); ?>
        </div>
    
        <section id="index">    
            <?php        
                wp_reset_query();
                query_posts(array('order' => DESC,  'post_type' => array('article', 'event', 'video'), 'posts_per_page' => 5));
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
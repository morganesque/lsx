<div id="left">

</div><!-- #left -->

<header>
    
    <?php include ( TEMPLATEPATH . '/frag-title.php' ); ?>
    <?php include ( TEMPLATEPATH . '/frag-about.php' ); ?>
	
</header>

<div id="middle">
    


    <section id="index">
    
        <?php
        
        wp_reset_query();
        query_posts(array('order' => DESC,  'post_type' => array('post', 'event', 'video'), 'posts_per_page' => 10));
        include ( TEMPLATEPATH . '/frag-index.php' );
    
        ?>
    </section>
    
</div><!-- #middle -->

<div id="right">
    <?php include ( TEMPLATEPATH . '/frag-icons.php' ); ?>

</div>

    <?php include ( TEMPLATEPATH . '/frag-helpers.php' ); ?>
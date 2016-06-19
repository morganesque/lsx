<?php get_header(); ?>

<?php
// foreach($wp_query as $k=>$val) PreDump($k);
?>

<div id="body" class="mod">
<?php if ($wp_query->query_vars['post_type'] == 'video'): ?>
    
    <div id="only" class="mod">

        <section id="index">
            <?php
        
            wp_reset_query();
            rewind_posts();
            include ( TEMPLATEPATH . '/frag-index-video.php' );
    
            ?>
        </section>
    
    </div><!-- #only -->
    
<?php else: ?>

    <div id="left">

        <section id="index">
    
            <?php
        
            wp_reset_query();
            rewind_posts();
            include ( TEMPLATEPATH . '/frag-index.php' );
    
            ?>
        </section>
    
    </div><!-- #left -->

    <div id="right">

    </div>

<?php endif; ?>
</div><!-- #body -->
<?php get_footer(); ?>
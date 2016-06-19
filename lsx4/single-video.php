<?php get_header(); ?>

<?php
$custom = get_post_custom($post->ID);
$vtmp = unserialize(unserialize($custom['vimeo_data'][0]));
$video = $vtmp[0];
?>

<section id="content" class="clearfix">
    
    <div class="left">
    
        <article>
            <div id="video">
                <?php
                    $width = 100;
                    $ratio = $video['height']/$video['width'];
                    $height = $width * $ratio;
                ?>
                <iframe class="video" data-ratio="<?php echo $ratio; ?>" src="http://player.vimeo.com/video/<?php echo $custom['video_id'][0]; ?>" width="<?php echo $width; ?>%" height="340" frameborder="0"></iframe>
            </div>
		    
		    <h2><?php the_title(); ?></h2>
		    
    		<?php comments_template( '', true ); ?>
		</article>
				
    
    </div><!-- #left -->

    <div class="right">  
        <?php include ( TEMPLATEPATH . '/frags/frag-search.php' ); ?>          
        <?php include ( TEMPLATEPATH . '/frags/frag-icons.php' ); ?>          
        <?php include ( TEMPLATEPATH . '/frags/frag-upcoming.php' ); ?>
        <?php include ( TEMPLATEPATH . '/frags/frag-twitter.php' ); ?>    
    </div><!-- #right -->
    
</section>

<?php get_footer(); ?>


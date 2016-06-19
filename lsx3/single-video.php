<?php get_header(); ?>

<?php
$custom = get_post_custom($post->ID);
$vtmp = unserialize(unserialize($custom['vimeo_data'][0]));
$video = $vtmp[0];

?>

<div id="body" class="mod">

    <div id="left">
    
        <div id="video">
            <?php
                $width = 100;
                $ratio = $video['height']/$video['width'];
                $height = $width * $ratio;
            ?>
            <iframe class="video" data-ratio="<?php echo $ratio; ?>" src="http://player.vimeo.com/video/<?php echo $custom['video_id'][0]; ?>" width="<?php echo $width; ?>%" height="340" frameborder="0"></iframe>
        </div>
        
        <div id="comments">            
            <?php comments_template( '', true ); ?>
        </div>
    
    </div><!-- #left -->

    <div id="right">            
        <article>
            <?php while ( have_posts() ) : the_post(); ?>

                <h2><?php the_title(); ?></h2>

                <section>
                <?php the_content(); ?>
                </section>

                <?php
                    // PreDump($video);    
                ?>

            <?php endwhile; ?>
        </article>
    </div><!-- #right -->

</div><!-- #body -->

<?php get_footer(); ?>
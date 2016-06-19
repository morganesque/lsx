<?php

$t = query_posts(array('order' => DESC,  'post_type' => array('video'), 'posts_per_page' => 1));
while(have_posts()): the_post();

    $out = '';
    $string = $post->post_title;
    for($i = 0; $i < strlen($string); $i++) $out.= base_convert(ord($string[$i]),10,2);
    $out = substr($out,0,200);
    $out = str_replace('1','X',$out);

    $custom = get_post_custom($post->ID);
    $vtmp = unserialize(unserialize($custom['vimeo_data'][0]));
    $video = $vtmp[0];
    
    $slugs = array();
    $cats = get_the_category($post->ID);
    foreach($cats as $c) $slugs[] = $c->slug;
    
    ?>
    <h2 class="tk-tachyon reg">featured video
        <div class="circle" style="<?php echo doBack($string,0.42); ?>"></div>
        <div class="circle" style="<?php echo doBack(join('',$slugs),0.42); ?>"></div>
        <div class="circle" style="<?php echo doBack('video',0.42); ?>"></div>
        </h2>
    <div id="video">
        <?php
            $width = 100;
            $ratio = $video['height']/$video['width'];
            $height = $width * $ratio;
        ?>
        <iframe class="video" data-ratio="<?php echo $ratio; ?>" src="http://player.vimeo.com/video/<?php echo $custom['video_id'][0]; ?>" width="<?php echo $width; ?>%" height="340" frameborder="0"></iframe>
    </div>
    <p class="tk-tachyon reg bin"><?php echo $out; ?></p>
    
    <?php
    
    $HERO_ID = $post->ID;

endwhile;

?>
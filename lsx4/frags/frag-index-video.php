<?php
/*
    This is a frag of the list of index items used on 
    the main home page and on other index pages.
    
    In order to use this you should first call a new 
    query_posts() in order to set up the content for 
    this to while() through.
    
    i.e. (from the home page)
    <code>
    
    wp_reset_query();
    query_posts(array('order' => DESC,  'post_type' => array('post', 'event', 'video'), 'posts_per_page' => 10));
    
    </code>
*/

while(have_posts()): the_post();

    $date = split(' ',date("jS F M", strtotime($post->post_date)));

    $cats = array();
    foreach(get_the_category() as $c) $cats[] = $c->slug;    

    // $cols = array('bg-pnk','bg-blu','bg-lbl','bg-trq','bg-gre','bg-yel','bg-red');

    $custom = get_post_custom($post->ID);
    
    $v_tmp = unserialize(unserialize($custom['vimeo_data'][0]));
    $vimeo = $v_tmp[0];
    
    $vimeo['duration'] = array('seconds'=>$vimeo['duration']);
    $vimeo['duration']['mins'] = (int) floor($vimeo['duration']['seconds']/60);
    $vimeo['duration']['secs'] = (int) floor($vimeo['duration']['seconds']%60);
    if ($vimeo['duration']['secs'] < 10) $vimeo['duration']['secs'] = '0'.$vimeo['duration']['secs'];
    $vimeo['duration']['nice'] = $vimeo['duration']['mins'].':'.$vimeo['duration']['secs'];
    
    $out = '';
    $string = $post->post_title;
    
    for($i = 0; $i < strlen($string); $i++) $out.= base_convert(ord($string[$i]),10,2);
    
    $out = substr($out,0,200);
    $out = str_replace('1','X',$out);
    
    ?>
        <div class="index-item mod video">
            <!-- <a href="<?php the_permalink(); ?>" class="image" style="background-image:url(<?php echo $vimeo['thumbnail_medium'] ?>);"></a>             -->
            <a href="<?php the_permalink(); ?>" class="image"><img src="/cache/getImage.php?url=<?php echo $vimeo['thumbnail_large'] ?>"/></a>
            <div class="text">
                    <h4><?php the_title(); ?></h4>
                    <!-- <?php the_excerpt(); ?> -->
            </div><!-- .text -->
            <div class="meta mod">                
                <p class="date bold"><?php echo $date[0]; ?> <span class="long"><?php echo $date[1]; ?></span><span class="short"><?php echo $date[2]; ?></span></p>                
                <?php 
                if (!empty($cats))
                foreach ($cats as $c): ?>                    
                    <p class="cat bold mod" style="<?php echo doBack($c,0.76); ?>" ><a href="/<?php echo $c; ?>/"><?php echo $c; ?></a></p>
                <?php endforeach; ?>
                <p class="duration bold" style="color:white; <?php echo doBackNum($vimeo['duration']['seconds'],7200,0.76); ?>">length: <?php echo $vimeo['duration']['nice'] ?></p>
                <p class="plays bold" style="color:white; <?php echo doBackNum($vimeo['stats_number_of_plays'],200,0.76); ?>">played: <?php echo $vimeo['stats_number_of_plays'] ?></p>
                <p class="cat bold mod" style="<?php echo doBack('play now',0.76); ?>"><a href="<?php the_permalink(); ?>">play now</a></p>
            </div>            

            <!-- <p class="tk-tachyon reg bin"><?php echo $out; ?></p> -->
        </div>
        
<?php endwhile; ?>

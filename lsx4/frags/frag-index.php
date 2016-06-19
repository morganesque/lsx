<?php
/*
    This is a frag of the list of index items used on 
    the main home page and on other index pages.
    
    In order to use this you should first call a new 
    query_posts() in order to set up the content for 
    this to while through.
    
    i.e. (from the home page)
    <code>
    
    wp_reset_query();
    query_posts(array('order' => DESC,  'post_type' => array('post', 'event', 'video'), 'posts_per_page' => 10));
    
    </code>
*/

while(have_posts()): the_post();
    
    if ($post->ID == $HERO_ID) continue;

    $date = split(' ',date("jS F M", strtotime($post->post_date)));

    $cats = array();
    foreach(get_the_category() as $c) $cats[] = $c->slug;    

    switch($post->post_type)
    {
        case "article": $type = 'article'; $col = 'bg-lbl'; $cta = 'Read more'; break;
        case "event": $type = 'event'; $col = 'bg-pnk'; $cta = 'Find out more'; break;
        case "video": $type = 'video'; $col = 'bg-gre'; $cta = 'Watch the video'; break;
    }

    // $cols = array('bg-pnk','bg-blu','bg-lbl','bg-trq','bg-gre','bg-yel','bg-red');
            
    $src = null; $class = ''; $image = '';
    $attachments = get_posts('post_type=attachment&post_parent='.$post->ID.'&orderby=menu_order&order=ASC&numberposts=-1');	
    
    foreach($attachments as $a)
    {
        if ($a->post_title == 'index') 
        {
            $src = wp_get_attachment_image_src($a->ID,'large');
        }
    }   
             
    if ($src) 
    {
        $image = '<img src="'.$src[0].'" alt="" width="100%"/>';
        $class = 'with-image';
    }
    
    $out = '';
    $string = $post->post_title;
    
    for($i = 0; $i < strlen($string); $i++) $out.= base_convert(ord($string[$i]),10,2);
    
    $out = substr($out,0,200);
    $out = str_replace('1','X',$out);
    
    ?>
        <div class="index-item <?php echo $class; ?>">
            <?php if ($src): ?>
            <div class="index-item-image">
                <?php echo $image; ?>
                <h4><?php the_title(); ?></h4>
            </div>
            <?php endif; ?>
            <div class="meta">                
                <p class="date bold"><?php echo $date[0]; ?> <span class="long"><?php echo $date[1]; ?></span><span class="short"><?php echo $date[2]; ?></span></p>
                <?php 
                if (!empty($cats))
                foreach ($cats as $c): ?>                    
                    <p class="cat bold mod" style="<?php echo doBack($c,0.42); ?>" ><a href="/<?php echo $c; ?>/"><?php echo $c; ?></a></p>
                <?php endforeach; ?>
                <p class="type bold" style="<?php echo doBack($type,0.21); ?>"><?php echo $type; ?></p>
            </div>            
            <div class="text">
                <?php if (!$src): ?><h4><?php the_title(); ?></h4><?php endif; ?>
                    <?php the_excerpt(); ?>                
                <div style="background-color:<?php echo ColourUtils::stringtorgba($cta.join('',$cats),0.76); ?>" class="readmore tk-museo-sans"><a href="<?php the_permalink(); ?>"><?php echo $cta; ?></a></div>                            
            </div><!-- .text -->            
            <p class="tk-tachyon reg bin"><?php echo $out; ?></p>
        </div>
    <?php
endwhile;

?>

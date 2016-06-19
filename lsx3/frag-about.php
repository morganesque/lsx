<?php

wp_reset_query();

$title = $post->post_title;
$name = $post->post_name;

if (is_home()) {
    query_posts(array('pagename'=>'lsx','post_type' => 'page')); if (have_posts()) the_post();    
    $title = 'LSx';
    $name = 'home';
    $col = "rgba(0,0,0,0.62)";
} else {
    $col = ColourUtils::stringtorgba($name,0.62); 
}


?>
<div id="about-content" style="background-color:<?php echo $col; ?>">
    <article>
    <h4>what is <?php echo $title; ?>?</h4>
    <?php 
    the_content(); 
    ?>
    </article>
</div>
<div id="about-tab" class="little-caps">
    <a href="#" class="a-down">what is <?php echo $title; ?>?</a>
</div>
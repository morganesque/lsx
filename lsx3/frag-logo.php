<?php
wp_reset_query();

$_404 = '404';
$title = get_the_title();

if (is_404()) $title = $_404;

if (is_home()) $title = '';

if (is_archive()) $title = $post->post_type.'s';

if (is_page()) {}

if (is_single()) $title = $post->post_type;

if ($title) $title = ' : <span>'.$title.'</span>';

?>
<!-- <h1 class="tk-tachyon reg"><?php echo $title ?></h1> -->

<img id="owl" src="<?php echo IMAGES; ?>/owl/owl.png" height="144" />
<h1 class="tk-tachyon reg"><a href="/"><span style="color:rgba(150,0,0,0.42)">L</span><span style="color:rgba(0,150,0,0.42)">S</span><span style="color:rgba(0,0,150,0.62)">x</span><?php echo $title; ?></a></h1>
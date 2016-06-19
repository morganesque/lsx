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

<?php
    // PreDump($post->post_name);
?>

<a class="lsx-logo">
    
    <?php if($post->post_name == 'about'): ?>
        <span class="tk-tachyon reg sub-head">about</span>
    <?php endif; ?>
    
    <?php if($post->post_name == 'contact'): ?>
        <span class="tk-tachyon reg sub-head">contact</span>
    <?php endif; ?>
    
    <?php if($post->post_name == 'tedx'): ?>
        <span class="tk-tachyon reg sub-head">tedx</span>
    <?php endif; ?>
    
    <img id="owl" src="<?php echo IMAGES; ?>/logos/lsx.png" height="240" />    
    
    <?php if($post->post_type == 'article'): ?>
        <span class="tk-tachyon reg sub-head">articles</span>
    <?php endif; ?>
    
    <?php if($post->post_type == 'video'): ?>
        <span class="tk-tachyon reg sub-head">videos</span>
    <?php endif; ?>
    
    <?php if($post->post_type == 'event'): ?>
        <span class="tk-tachyon reg sub-head">events</span>
    <?php endif; ?>
</a>
<!-- <h1 class="tk-tachyon reg"><a href="/"><span style="color:rgba(150,0,0,0.42)">L</span><span style="color:rgba(0,150,0,0.42)">S</span><span style="color:rgba(0,0,150,0.62)">x</span><?php echo $title; ?></a></h1> -->
<!DOCTYPE html>

<!--[if lt IE 7 ]> <html class="ie ie6 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]>    <html class="ie ie7 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]>    <html class="ie ie8 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9 ]>    <html class="ie ie9 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 9]><!--><html class="no-js" <?php language_attributes(); ?>><!--<![endif]-->
<!-- the "no-js" class is for Modernizr. -->

<head id="www-lsx-co" data-template-set="lsx-theme" profile="http://gmpg.org/xfn/11">

    <?php include (TEMPLATEPATH . '/frags/frag-meta.php' ); ?>

    <!-- TYPEKIT STUFF -->
    <script type="text/javascript" src="http://use.typekit.com/vtd7eag.js"></script>
    <script type="text/javascript">try{Typekit.load();}catch(e){}</script>
    <!-- / TYPEKIT STUFF -->
        
    <!-- CSS -->
    <?php include ( TEMPLATEPATH . '/frags/frag-css.php' ); ?>
    
    <!-- all our JS is at the bottom of the page, except for Modernizr. -->
    <script src="<?php bloginfo('template_directory'); ?>/_/js/modernizr-1.7.min.js"></script>
    
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

    <?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

    <?php wp_head(); ?>
    
</head>

<body <?php body_class('greyback'); ?>>
    
<div id="page">

        <header id="header">                
            <?php include ( TEMPLATEPATH . '/frags/frag-logo.php' ); ?>            
        </header>
        
        <?php include ( TEMPLATEPATH . '/frags/frag-nav.php' ); ?>
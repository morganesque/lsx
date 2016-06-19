<!DOCTYPE html>

<!--[if IEMobile 7 ]><html class="no-js iem7" manifest="default.appcache?v=1"><![endif]-->
<!--[if lt IE 7 ]><html class="no-js ie6" lang="en"><![endif]-->
<!--[if IE 7 ]><html class="no-js ie7" lang="en"><![endif]-->
<!--[if IE 8 ]><html class="no-js ie8" lang="en"><![endif]-->
<!--[if (gte IE 9)|(gt IEMobile 7)|!(IEMobile)|!(IE)]><!--><html class="no-js" lang="en"><!--<![endif]-->

<head profile="<?php get_profile_uri(); ?>">
	
	<meta charset="utf-8" />
	
	<!-- This prevents the conditional comments below from holding up the page load
		 www.phpied.com/conditional-comments-block-downloads/ -->
	<!--[if IE]><![endif]-->	
	
	<title>LSx</title>	
	<meta name="description" content="A platform for Leeds' tech culture; projects, people, places &amp; events." />	
	<meta name="author" content="Tom Morgan - Morganesque.com" />
	<meta name="copyright" content="Copyright Your Name Here <?php the_time( 'Y' ); ?>. All Rights Reserved." />
	<meta name="DC.title" content="LSX" />
	<meta name="DC.subject" content="A platform for Leeds' tech culture; projects, people, places &amp; events." />
	<meta name="DC.creator" content="Tom Morgan - Morganesque.com" />	
		
	<meta name="google-site-verification" content="" /><!-- Speaking of Google, don't forget to set your site up: http://google.com/webmasters -->
	
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo( 'name' ); ?> RSS Feed" href="<?php bloginfo( 'rss2_url' ); ?>" />
	<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo( 'rss_url' ); ?>" />
	<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo( 'atom_url' ); ?>" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	
	<link rel="apple-touch-icon" href="<?php echo IMAGES; ?>/custom_icon.png"/>
	<link rel="shortcut icon" href="<?php echo IMAGES; ?>/favicon.png"/>	
	<link rel="shortcut icon" href="<?php echo IMAGES; ?>/favicon.ico">

	<meta name="viewport" content="width=device-width, user-scalable=no" />
	
    <!-- TYPEKIT STUFF -->
    <script type="text/javascript" src="http://use.typekit.com/vtd7eag.js"></script>
    <script type="text/javascript">try{Typekit.load();}catch(e){}</script>
    <!-- / TYPEKIT STUFF -->
    
    <?php include ( TEMPLATEPATH . '/frag-css.php' ); ?>
	
	<!-- The following is STRONGLY OPTIONAL, but useful if you really need to kick IE in the pants.
		 There are different flavors; pick the one right for your project: http://code.google.com/p/ie7-js/ -->
	<!--[if lt IE 8]>
	<script src="http://ie7-js.googlecode.com/svn/version/2.0(beta3)/IE8.js"></script>
	<![endif]-->
		
	<!-- MODERNIZR: http://www.modernizr.com/ -->
	<script src="<?php echo JS; ?>/modernizr-1.6.min.js"></script>
	
	<link type="text/plain" rel="author" href="/humans.txt" />
</head>

<body id="lsx.co" class="<?php semantic_body(); ?>">

<?php include ( TEMPLATEPATH . '/editbar.php' ); ?>

<div id="main">
    
    <header>                
        <?php include ( TEMPLATEPATH . '/frag-logo.php' ); ?>
        <?php include ( TEMPLATEPATH . '/frag-nav.php' ); ?>
        <?php include ( TEMPLATEPATH . '/frag-icons.php' ); ?>
    </header>

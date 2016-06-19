
    <div id="prefooter">
        &nbsp;
    </div>

	<footer class="mod">
		<div id="footer">
		    
		    <div id="foot-logo">
		        <img id="owl" src="<?php echo IMAGES; ?>/owl/owl.png" height="144" />
                <p class="tk-tachyon reg"><a href="/">LSx</a></p>
                <p class="copyright">&copy; Copyright <a href="<?php bloginfo( 'url' ); ?>">LSx</a> <?php echo date('Y'); ?>.<br />All Rights Reserved.</p>
                <ul id="foot-subs">
		            <?php
                    $nav = array(
                        'welovetechnology'=>'We &hearts; Technology',
                        'dotnorth'=>'Dotnorth',
                        'lsxpresents'=>'LSx Presents',
                        'girlgeek'=>'GirlGeek',        
                        'ignite'=>'Ignite',
                        'wepublish'=>'WePublish',        
                        'opencoffee'=>'OpenCoffee',        
                        'tedx'=>'TEDx',
                        'barcamp'=>'BarCamp',                            
                        'openleeds'=>'OpenLeeds',                            
                        'festival'=>'Festival',                            
                    );

                    foreach($nav as $key=>$val)
                    {
                        echo '<li style="background-color:'.ColourUtils::stringtorgba($key,0.30).'"><a href="/'.$key.'/">'.$val.'</a></li>';
                    }
                    ?>
                </ul>
		    </div>
		    
		    <div id="foot-nav">
		        <ul>
                    <!-- <li class="filler"><div>&nbsp;</div></li> -->
                    <?php
                    $nav = array(
                        ''=>'Home',
                        'events'=>'Events',
                        'videos'=>'Videos',
                        'news'=>'News',
                        'about'=>'About Us',        
                        'contact'=>'Contact',        
                    );

                    foreach($nav as $key=>$val)
                    {
                        if ($key) $key = $key.'/';
                        echo '<li class="tk-tachyon bold"><a href="/'.$key.'">'.$val.'</a></li>';
                    }

                    ?>                       
                </ul>
		    </div>
		    
		    <div id="foot-about">
		        <p><?php
		        wp_reset_query();
		        query_posts(array('pagename'=>'lsx','post_type' => 'page')); if (have_posts()) the_post();
		        the_content();
		        ?></p>
		    </div>
		    
		    <div id="foot-logos">
		        <img src="<?php echo IMAGES; ?>/logos/carbon.png" />
		        <img src="<?php echo IMAGES; ?>/logos/kilo75.png" />
		        <img src="<?php echo IMAGES; ?>/logos/ntileeds.png" />
		        <img src="<?php echo IMAGES; ?>/logos/morganesque.png" />
		    </div>
		</div>
		<?php wp_footer(); ?>
	</footer>
	
</div><!-- #main -->

<div id="top-bar">
    <p><a href="#">Fly my pretty! Fly!</a></p>
    <div class="counter">1</div>
</div>

<!-- jQuery -->	
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
<script>!window.jQuery && document.write(unescape('%3Cscript src="js/libs/jquery-1.5.1.js"%3E%3C/script%3E'))</script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.10/jquery-ui.min.js" type="text/javascript" charset="utf-8"></script>

<!-- Google Maps -->
<script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>

<!-- Local JS file -->
<?php include ( TEMPLATEPATH . '/frag-js.php' ); ?>

<!--[if (lt IE 9) & (!IEMobile)]>
<script src="<?php echo JS; ?>/DOMAssistantCompressed-2.8.js"></script>
<script src="<?php echo JS; ?>/selectivizr-1.0.1.js"></script>
<script src="<?php echo JS; ?>/respond.min.js"></script>
<![endif]-->

<!-- this is a variation of the official analytics snippet: http://mathiasbynens.be/notes/async-analytics-snippet 
	 replace XXXXXX-XX with your site's ID and uncomment to put this into effect
<script>
var _gaq = [['_setAccount', 'UA-XXXXXX-XX'], ['_trackPageview']];
(function(d, t) {
var g = d.createElement(t),
s = d.getElementsByTagName(t)[0];
g.async = true;
g.src = '//www.google-analytics.com/ga.js';
s.parentNode.insertBefore(g, s);
})(document, 'script');
</script> -->

</body>
</html>
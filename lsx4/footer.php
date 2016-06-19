		<footer id="footer" class="source-org vcard copyright">
			<small>&copy;<?php echo date("Y"); echo " "; bloginfo('name'); ?></small>
		</footer>

	</div>

	<?php wp_footer(); ?>


<!-- here comes the javascript -->

<!-- jQuery is called via the Wordpress-friendly way via functions.php -->

<!-- this is where we put our custom functions -->
<?php include ( TEMPLATEPATH . '/frags/frag-js.php' ); ?>

<!-- Google Maps -->
<script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>

<!-- Asynchronous google analytics; this is the official snippet.
	 Replace UA-XXXXXX-XX with your site's ID and uncomment to enable.
	 
<script>

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-XXXXXX-XX']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
-->

<div id="resp">
    <div class="m320">320</div>
    <div class="m480">480</div>
    <div class="m768">768</div>
    <div class="m960">960</div>
    <div class="m1240">1280</div>
    <div class="wf-name"><?php echo get_template_name(); ?></div>
</div>
	
</body>

</html>

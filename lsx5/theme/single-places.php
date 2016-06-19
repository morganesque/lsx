<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<?php
		$id = $post->ID;
		$events = types_child_posts('events'); // var_dump($events);
	?>

	<p class="type">place</p>
	<h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>

	<section class="entry-content cf" itemprop="articleBody"><?php the_content(); ?></section>

	<?php
	
	echo '<h2>Events</h2>';
	echo '<ul>';
	foreach($events as $event)
	{
		$eid = $event->ID;
		$event_name = $event->post_title;
		$event_url = get_permalink($eid);

		$event_start = types_render_field( "start", array("post_id"=>$eid));
		$event_end = types_render_field( "end", array("post_id"=>$eid));

		echo '<li><a href="'.$event_url.'">'.$event_name.'</a> on '.$event_start.'</li>';
	}
	echo '</ul>';
	?>	

	<?php echo do_shortcode('[wp_geo_map]'); ?>

<?php endwhile; endif; ?>

<?php get_footer(); ?>

<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<?php

		$id = $post->ID;
		// $meta = get_post_meta($id);
		// echo '<pre>';var_dump($meta); echo '</pre>';
		$event_start = types_render_field( "start", array("shoutput" => "raw"));
		// echo '<p>Start: '.date('r',$start).'</p>';

		$event_end = types_render_field( "end", array("output" => "raw"));
		// echo '<p>End: '.date('r',$end).'</p>';

		$talks = types_child_posts('talks'); // var_dump($talks);

		$pid = wpcf_pr_post_get_belongs($id,'places');
		$place = get_post($pid);
		$place_name = $place->post_title;
		$place_url = get_permalink($pid);
		// echo '<pre>';var_dump($place); echo '</pre>';

	?>

	<p class="type">event</p>
	<h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>

	<p>at <a href="<?php echo $place_url; ?>"><?php echo $place_name; ?></a> on <?php echo $event_start; ?></p>

	<section class="entry-content cf" itemprop="articleBody"><?php the_content(); ?></section>

	<?php
	
	echo '<h2>Talks</h2>';
	echo '<ul>';
	foreach($talks as $talk)
	{
		$id = $talk->ID;
		$talk_name = $talk->post_title;
		$talk_url = get_permalink($id);

		$pid = wpcf_pr_post_get_belongs($id,'people');
		$person = get_post($pid);
		$person_url = get_permalink($pid);
		$person_name = $person->post_title;

		echo '<li><a href="'.$talk_url.'">'.$talk_name.'</a> by <a href="'.$person_url.'">'.$person_name.'</a></li>';
	}
	echo '</ul>';

	?>	

<?php endwhile; endif; ?>

<?php get_footer(); ?>

<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<?php
		$id = get_the_ID();
		$eid = wpcf_pr_post_get_belongs($id,'events');
		$pid = wpcf_pr_post_get_belongs($id,'people');

		$person = get_post($pid);
		$person_name = $person->post_title;
		$person_url = get_permalink($person->ID);

		$event = get_post($eid);
		$event_name = $event->post_title;
		$event_url = get_permalink($event->ID);
		$event_date = types_render_field('start',array("post_id"=>$eid));
	?>

	<p class="type">talk</p>
	<h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>

	<p>by <a href="<?php echo $person_url; ?>"><?php echo $person_name; ?></a> at <a href="<?php echo $event_url ?>"><?php echo $event_name ?></a> on <?php echo $event_date ?></p>

	<section class="entry-content cf" itemprop="articleBody"><?php the_content(); ?></section>

	<?php
	$t = types_render_field( "video", array("output" => "raw"));
	// $t = types_render_field( "video", array("output" => "html"));
	echo do_shortcode('[fve]'.$t.'[/fve]');
	?>

<?php endwhile; endif; ?>

<?php get_footer(); ?>

<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<?php
		$id = get_the_ID();
		$talks = types_child_posts('talks');
		$talks_num = count($talks);

		$thumb_id = get_post_thumbnail_id($id);
		$thumb = wp_get_attachment_image_src($thumb_id, 'medium');
	?>

	<p class="type">people</p>
	<h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>
	<div class="img-container"><img src="<?php echo $thumb[0]; ?>" width="100%" /></div>
	<section class="entry-content cf" itemprop="articleBody"><?php the_content(); ?></section>

	<h2>Talks</h2>
	<p><?php the_title(); ?> has given the following talk<?php echo ($talks_num>1) ? 's' : '';?></p>
	<ul>
		<?php


		foreach($talks as $talk)
		{
			$id = $talk->ID;
			$talk_name = $talk->post_title;
			$talk_url = get_permalink($id);

			$eid = wpcf_pr_post_get_belongs($id,'events');
			$event = get_post($eid);
			$event_name = $event->post_title;
			$event_url = get_permalink($event->ID);
			$event_date = types_render_field('start',array("post_id"=>$eid));

			?>
			<li>
				<a href="<?php echo $talk_url; ?>"><?php echo $talk_name; ?></a> at 
				<a href="<?php echo $event_url ?>"><?php echo $event_name ?></a> on <?php echo $event_date ?>
			</li>
			<?php
		}
		?>
	</ul>

<?php endwhile; endif; ?>

<?php get_footer(); ?>

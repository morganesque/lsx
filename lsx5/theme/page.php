<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>

	<p class="byline vcard">
		<?php printf( __( 'Posted <time class="updated" datetime="%1$s" pubdate>%2$s</time> by <span class="author">%3$s</span>', 'bonestheme' ), get_the_time('Y-m-j'), get_the_time(get_option('date_format')), get_the_author_link( get_the_author_meta( 'ID' ) )); ?>
	</p>

	<section class="entry-content cf" itemprop="articleBody"><?php the_content(); ?></section>

<?php endwhile; endif; ?>

<?php get_footer(); ?>

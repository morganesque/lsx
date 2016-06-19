<?php

	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		This post is password protected. Enter the password to view comments.
	<?php
		return;
	}
?>

<?php if ( have_comments() ) : ?>
    <div class="comments">
	
    	<h2><?php comments_number('No Responses', 'One Response', '% Responses' );?></h2>

    	<div class="navigation">
    		<div class="next-posts"><?php previous_comments_link() ?></div>
    		<div class="prev-posts"><?php next_comments_link() ?></div>
    	</div>

    	<ol class="commentlist">
    		<?php 
    		$args = array(
                'walker'            => null,
                // 'max_depth'         => ,
                'style'             => 'ul',
                'callback'          => 'tomDisplayComment',
                'end-callback'      => null,
                'type'              => 'all',
                // 'page'              => ,
                // 'per_page'          => ,
                'avatar_size'       => 48,
                'reverse_top_level' => null,
                // 'reverse_children'  =>  
                );
                wp_list_comments($args); 
            ?>
    	</ol>

    	<div class="navigation">
    		<div class="next-posts"><?php previous_comments_link() ?></div>
    		<div class="prev-posts"><?php next_comments_link() ?></div>
    	</div>
	
	</div>
	
 <?php else : // this is displayed if there are no comments so far ?>

	<?php if ( comments_open() ) : ?>
		<!-- If comments are open, but there are no comments. -->

	 <?php else : // comments are closed ?>
		<p>Comments are closed.</p>

	<?php endif; ?>
	
<?php endif; ?>

<?php if ( comments_open() ) : ?>

<div class="respond greyback">

	<h2><?php comment_form_title( 'Leave a Reply', 'Leave a Reply to %s' ); ?></h2>

	<div class="cancel-comment-reply">
		<?php cancel_comment_reply_link(); ?>
	</div>

	<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
		<p>You must be <a href="<?php echo wp_login_url( get_permalink() ); ?>">logged in</a> to post a comment.</p>
	<?php else : ?>

	<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" class="commentform">

        <div class="clearfix">
			<textarea name="comment" class="comment" cols="58" rows="20" tabindex="4"></textarea>
		</div>

		<?php if ( is_user_logged_in() ) : ?>

			<p>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">Log out &raquo;</a></p>

		<?php else : ?>

			<div class="clearfix">
				<input type="text" class="sl-input" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
				<label for="author">Name</label>
			</div>

			<div class="clearfix">
				<input type="text" class="sl-input" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
				<label for="email">Email</label>
			</div>

			<div class="clearfix">
				<input type="text" class="sl-input" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" size="22" tabindex="3" />
				<label for="url">Website</label>
			</div>

		<?php endif; ?>

		<!--<p>You can use these tags: <code><?php echo allowed_tags(); ?></code></p>-->

		<div class="clearfix">
			<input name="submit" type="submit" id="submit" class="button" tabindex="5" value="Submit Comment" />
			<?php comment_id_fields(); ?>
		</div>
		
		<?php do_action('comment_form', $post->ID); ?>

	</form>

	<?php endif; // If registration required and not logged in ?>
	
</div>

<?php endif; ?>
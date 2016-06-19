<?php
    if ( !empty( $_SERVER[ 'SCRIPT_FILENAME' ] ) && 'comments.php' == basename( $_SERVER[ 'SCRIPT_FILENAME' ] ) )
	die ( 'Please do not load this page directly. Thanks!' );
?>

<?php 
    if ( post_password_required() )
    {        
	    echo '<p class="password-protected alert">This post is password protected. Enter the password to view comments.</p>';
        return; 
    }
?>

<?php
?>

<?php if ( have_comments() ) : // If comments exist for this entry, continue ?>
    <div id="comments">
        <?php if ( ! empty( $comments_by_type['comment'] ) ): ?>
        	<?php framework_discussion_title( 'comment' ); ?>
            <?php // framework_discussion_rss(); ?>
            <ol class="comment-list">
        		<?php wp_list_comments(array(
                'type' => 'comment',
                'callback' => 'framework_comments_callback',
                'end-callback' => 'framework_comments_endcallback' )); ?>
            </ol><!-- .comment-list -->
        <?php endif; ?>

        <?php if ( ! empty( $comments_by_type['pings'] ) ): ?>
        	<?php framework_discussion_title( 'pings' ); ?>
            <ol class="pings-list">
        		<?php wp_list_comments(array(
                'type' => 'pings',
                'callback' => 'framework_pings_callback',
                'end-callback' => 'framework_pings_endcallback' )); ?>
            </ol><!-- .pings-list -->
        <?php endif ?>
    </div><!-- #comments -->
<?php endif; ?>

<?php if ( comments_open() ) : // show comment form ?>
<div id="respond">

    <div class="cancel-comment-reply"><?php cancel_comment_reply_link( 'Cancel Reply' ); ?></div>
    
    <h3 id="leave-a-reply" class="tk-tachyon reg"><?php comment_form_title( 'Leave a Reply', 'Leave a Reply to %s' ); ?></h3> 
        
    <?php if ( get_option( 'comment_registration' ) && !is_user_logged_in() ) : ?>
	<p id="login-req" class="alert">You must be <a href="<?php echo get_option( 'siteurl' ); ?>/wp-login.php?redirect_to=<?php echo urlencode( get_permalink() ); ?>">logged in</a> to post a comment.</p>
    <?php else : ?>
	
	<form id="comment-form" method="post" action="<?php echo get_option( 'siteurl' ); ?>/wp-comments-post.php">
		
		<?php if ( is_user_logged_in() ) : global $current_user; // If user is logged-in, then show them their identity ?>

            <a class="logged" style="<?php echo doBack($user_identity,0.42); ?>" href="<?php echo get_option( 'siteurl' ); ?>/wp-admin/profile.php">Logged in as <?php echo $user_identity; ?></a>
            <a class="logged" style="<?php echo doBack('logout',0.42); ?>" href="<?php echo wp_logout_url( get_permalink() ); ?>" title="Log out of this account">Log out &raquo;</a></p>
        
        	<div id="form-section-comment" class="mod">
            	<textarea name="comment" id="comment" tabindex="4" rows="10" cols="65" placeholder="Your comment here"></textarea>
            	<p id="allowed-tags"><a href="#">ALLOWED TAGS<br /><span class="allowed-tags"><?php echo allowed_tags('<br />'); ?></span></a></p>
            </div>
        
            <div id="form-section-author" class="mod">
                <input name="author" id="author" type="text" placeholder="Your name" value="<?php echo $current_user->user_nicename; ?>" tabindex="1" <?php if ( $req ) echo "aria-required='true'"; ?> />
                <label for="author"<?php if ( $req ) echo ' class="required"'; ?>>Name</label>
            </div>
        
            <div id="form-section-email" class="mod">
                <input class="email" name="email" id="email" placeholder="e.g. you@domain.com" type="email" value="<?php echo $current_user->user_email; ?>" tabindex="2" <?php if ( $req ) echo "aria-required='true'"; ?> />
                <label for="email"<?php if ( $req ) echo ' class="required"'; ?>>Email</label>
            </div>
		
            <div id="form-section-url" class="mod">
                <input name="url" id="url" type="text" value="<?php echo $current_user->user_url; ?>" tabindex="3" />
                <label for="url">Website</label>
            </div>
		
		<?php else : // If user isn't logged-in, ask them for their details ?>
        
        	<div id="form-section-comment" class="mod">
            	<textarea name="comment" id="comment" tabindex="4" rows="10" cols="65" placeholder="Your comment here"></textarea>
            	<p id="allowed-tags"><a href="#">ALLOWED TAGS<br /><span class="allowed-tags"><?php echo allowed_tags('<br />'); ?></span></a></p>
            </div>
        
            <div id="form-section-author" class="mod">
                <input name="author" id="author" type="text" placeholder="e.g. Roberta Crivens" alue="<?php echo $comment_author; ?>" tabindex="1" <?php if ( $req ) echo "aria-required='true'"; ?> />
                <label for="author"<?php if ( $req ) echo ' class="required"'; ?>>Name</label>
            </div>
        
            <div id="form-section-email" class="mod">
                <input name="email" id="email" type="text" placeholder="e.g. you@domain.com" value="<?php echo $comment_author_email; ?>" tabindex="2" <?php if ( $req ) echo "aria-required='true'"; ?> />
                <label for="email"<?php if ( $req ) echo ' class="required"'; ?>>Email</label>
            </div>
		
            <div id="form-section-url" class="mod">
                <input name="url" id="url" type="text" placeholder="e.g. www.lsx.co" value="<?php echo $comment_author_url; ?>" tabindex="3" />
                <label for="url">Website</label>
            </div>
        
		<?php endif; // if ( is_user_logged_in() ) ?>
        
        <div id="form-section-actions" class="mod">
			<button name="submit" id="submit" type="submit" tabindex="5">Go for it!</button>
			<?php comment_id_fields(); ?>
        </div>

	<?php do_action( 'comment_form', $post->ID ); // Available action: comment_form ?>
    </form><!-- #comment-form -->
    
	<?php endif; // If registration required and not logged in ?>
</div><!-- #repond -->
<?php endif; // ( comments_open() ) ?>
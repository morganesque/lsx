<?php if ( is_user_logged_in() ): ?>
<div id="editBar">
    <p>
        <a href="/wp-admin" class="admin">Wordpress Admin</a>
        <?php if ( current_user_can( 'edit_post', $post->ID ) ): ?><?php edit_post_link( 'Edit this page', '', '' ); ?><?php endif; ?>
        <a><?php echo get_template_name(); ?></a>
        <!-- <a href="/wp-content/themes/wordsandpics/library/media/js/session.php?destroy=1">Clear Session</a> -->
        <a id="width-monitor">0</a>
        <a id="scroll-monitor">0</a>
    </p>
</div>	
<?php endif; ?>
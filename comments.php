<?php // Do not delete these lines
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
	die ('Please do not load this page directly. Thanks!');
if ( post_password_required() ) { ?>
	<p class="nocomments">This post is password protected. Enter the password to view comments.</p>
<?php
	return;
}

// add a microid to all the comments
function comment_add_microid($classes) {
	$c_email=get_comment_author_email();
	$c_url=get_comment_author_url();
	if (!empty($c_email) && !empty($c_url)) {
		$microid = 'microid-mailto+http:sha1:' . sha1(sha1('mailto:'.$c_email).sha1($c_url));
		$classes[] = $microid;
	}
	return $classes;	
}
add_filter('comment_class','comment_add_microid');

//Change date format
function change_comment_date($datestring, $dateformat) {
global $comment;
return mysql2date('F j y', $comment->comment_date);
}
add_filter('get_comment_date','change_comment_date',10,2);

// show the comments
if ( have_comments() ) : ?>
	<h3 class="comments-header"><?php comments_number('0 Comments','1 Comment','% Comments'); ?></h3>
	<p class="smallrss"><?php comments_rss_link('Subscribe to the Comments'); ?></p>
		<ol id="comments">
			<?php wp_list_comments(array('avatar_size'=>64, 'reply_text'=>'Reply', 'type'=>'comment')); ?>
		</ol>
		
		<div class="comments-navigation clearfix">
			<div class="alignleft"><?php previous_comments_link() ?></div>
			<div class="alignright"><?php next_comments_link() ?></div>
		</div>
		
	<h3 class="comments-header">Trackbacks / Pingbacks</h3>
	<a href="#" class="show_trackbacks">show trackbacks</a>
		<ol id="trackbacks">
			<?php wp_list_comments('type=pings'); ?>
		</ol>
 <?php else : // this is displayed if there are no comments so far ?>

	<?php if ('open' == $post->comment_status) : ?>
		<h3 class="comments-header">No Comments Yet</h3>
		<p>Be the first to comment.</p>
	<?php else : ?>
		<h3 class="comments-header">Comments Closed</h3>
		<p id="comments-closed">Sorry, comments for this entry are closed at this time.</p>
	<?php endif;
endif; 

if ('open' == $post-> comment_status) : 

// show the form
?>
<div id="respond">
	<h3 class="comments-header"><?php comment_form_title( 'Leave a Reply', 'Leave a Reply to %s' ); ?></h3>

<div id="cancel-comment-reply">
	<small><?php cancel_comment_reply_link(); ?></small>
</div>

<?php if ( get_option('comment_registration') && !$user_ID ) : ?>

<p>You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">logged in</a> to post a comment.</p>

<?php else : ?>

<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

	<?php comment_id_fields(); ?>
	<input type="hidden" name="redirect_to" value="<?php echo htmlspecialchars($_SERVER["REQUEST_URI"]); ?>" />

	<p><small><strong>XHTML:</strong> You can use these tags: <?php echo allowed_tags(); ?></small></p>

	<div class="span-8">
		<label for="comment">Comment</label>
	    <textarea name="comment" id="comment" rows="5" cols="30"></textarea>
	</div>

	<?php if (get_option("comment_moderation") == "1") { ?>
	 <p><small><strong>Please note:</strong> Comment moderation is enabled and may delay your comment. There is no need to resubmit your comment.</small></p>
	<?php } ?>


<?php if ( $user_ID ) : ?>

<p class="loggedin">Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>.
<a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">Logout &raquo;</a></p>


<?php else : ?>
	
	<div class="span-6 last">
		<label for="author">Name<?php if ($req) _e(' <span class="required">(required)</span>'); ?></label>
        <input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" />
        
		<label for="email">E-mail<?php if ($req) _e(' <span class="required">(required)</span>'); ?></label>
        <input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" />
        
        <label for="url">Website</label>
        <input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" />
    </div>

<?php endif; ?>

<button type="submit" name="submit" id="sub">Submit Comment</button>
<?php do_action('comment_form', $post->ID); ?>


</div>

</form>

<?php 
endif;

endif;
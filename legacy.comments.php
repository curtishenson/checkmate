<?php if (!empty($post->post_password) && $_COOKIE['wp-postpass_'.COOKIEHASH]!=$post->post_password) : ?>
    <p class="comments-locked"><?php _e('Enter your password to view comments.', 'checkmate'); ?></p>
<?php return; endif; ?>

<?php if ($comments) : ?>
	
<?php 

    /* Author values for author highlighting */
    /* Enter your email and name as they appear in the admin options */
    $author = array(
            "highlight" => "highlight",
            "email" => "YOUR EMAIL HERE",
            "name" => "YOUR NAME HERE"
    ); 

    /* Count the totals */
    $numPingBacks = 0;
    $numComments  = 0;

    /* Loop throught comments to count these totals */
    foreach ($comments as $comment) {
        if (get_comment_type() != "comment") { $numPingBacks++; }
        else { $numComments++; }
    }
    
    /* Used to stripe comments */
    $thiscomment = 'odd'; 
?>

<?php 

    /* This is a loop for printing comments */
    if ($numComments != 0) : ?>

    <h3 class="comments-header"><?php comments_number(__('0 Comments', 'checkmate'),___('1 Comment', 'checkmate'),__('% Comments', 'checkmate')); ?></h3>
	<p class="smallrss"><?php comments_rss_link(__('Subscribe to the Comments', 'checkmate')); ?></p>
    <ol id="comments">

    <?php foreach ($comments as $comment) : ?>
    <?php if (get_comment_type()=="comment") : ?>
    
        <li id="comment-<?php comment_ID(); ?>" class="<?php 
        
        /* Highlighting class for author or regular striping class for others */
        
        /* Get current author name/e-mail */
        $this_name = $comment->comment_author;
        $this_email = $comment->comment_author_email;
        
        /* Compare to $author array values */
        if (strcasecmp($this_name, $author["name"])==0 && strcasecmp($this_email, $author["email"])==0)
            $author["highlight"]; 
        else 
            _e($thiscomment); 
        
        ?>">
            <div class="comment-meta">
<?php /* If you want to use gravatars, they go somewhere around here */ ?>
                <span class="comment-author"><?php comment_author_link() ?></span>, 
                <span class="comment-date"><?php comment_date() ?></span>:
				<span class="comment-edit"><?php edit_comment_link('Edit Comment'); ?></span>
            </div>
            <div class="comment-text clearfix">
				<?php
				if (function_exists('get_avatar')) {
				 	echo get_avatar( get_comment_author_email(), '64');
				 } ?>
                <?php comment_text(); ?>
            </div>
        </li>
        
    <?php if('odd'==$thiscomment) { $thiscomment = 'even'; } else { $thiscomment = 'odd'; } ?>
    
    <?php endif; endforeach; ?>
    
    </ol>
    
    <?php endif; ?>
    
<?php else : 

    /* No comments at all means a simple message instead */ 
?>

    <h3 class="comments-header"><?php _e('No Comments Yet', 'checkmate'); ?></h3>
    
<?php endif; ?>

<?php if (comments_open()) : ?>
	
	<p><?php _e('Be the first to comment.', 'checkmate'); ?></p>

    <div id="comments-form">
    
    <h3 class="comments-header"><?php _e('Leave a comment', 'checkmate'); ?></h3>
    
    <?php if (get_option('comment_registration') && !$user_ID ) : ?>
        <p class="comments-blocked">You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=
        <?php the_permalink(); ?>">logged in</a> to post a comment.</p>
		</div>
    <?php else : ?>

    <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

    <?php if ($user_ID) : ?>
    <div class="span-6">
	
    	<p>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php">
        <?php echo $user_identity; ?></a>. 
        <a href="<?php 
					if (function_exists('wp_logout_url')) :
						echo wp_logout_url(get_permalink()); 
					else:
						echo get_option('siteurl') . "/wp-login.php?action=logout";
					endif;
				?>" title="Log out of this account"><?php _e('Logout', 'checkmate'); ?></a></p>

		<button type="submit" name="submit" id="sub"><?php _e('Submit Comment', 'checkmate'); ?></button>
	    <input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
	
	</div>
    
    <?php else : ?>
	
    <div class="span-6">
		<label for="author"><?php _e('Name', 'checkmate'); ?><?php if ($req) _e(' <span class="required">(required)</span>', 'checkmate'); ?></label>
        <input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" />
        
		<label for="email"><?php _e('E-mail', 'checkmate'); ?><?php if ($req) _e(' <span class="required">(required)</span>', 'checkmate'); ?></label>
        <input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" />
        
        <label for="url"><?php _e('Website', 'checkmate'); ?></label>
        <input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" />

		<button type="submit" name="submit" id="sub"><?php _e('Submit Comment', 'checkmate'); ?></button>
        <input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
    </div>

    <?php endif; ?>

	<div class="span-8 last">
		<label for="comment"><?php _e('Comment', 'checkmate'); ?></label>
        <textarea name="comment" id="comment" rows="5" cols="30"></textarea>
   	</div>
       
    <?php do_action('comment_form', $post->ID); ?>

    </form>
    </div>

<?php endif; // If registration required and not logged in ?>

<?php else : // Comments are closed ?>
    <p id="comments-closed"><?php _e('Sorry, comments for this entry are closed at this time.', 'checkmate'); ?></p>
<?php endif; ?>

<?php if (pings_open()) : ?>
    <p class="respond"><span id="trackback-link">
        <a href="<?php trackback_url() ?>" rel="trackback"><?php _e('Get a Trackback link', 'checkmate'); ?></a>
    </span></p>
<?php endif; ?>

<?php

    /* This is a loop for printing pingbacks/trackbacks if there are any */
    if ($numPingBacks != 0) : ?>

    <h3 class="comments-header"><a class="show_trackbacks" href="#"><?php _e($numPingBacks); ?> <?php _e('Trackbacks/Pingbacks', 'checkmate'); ?></a></h3>
	<p><a class="show_trackbacks" href="#"><?php _e('Click to show or hide trackbacks', 'checkmate'); ?></a></p>
    <ol id="trackbacks">
    
<?php foreach ($comments as $comment) : ?>
<?php if (get_comment_type()!="comment") : ?>

    <li id="comment-<?php comment_ID() ?>" class="<?php _e($thiscomment); ?>">
    <?php comment_type(__('Comment', 'checkmate'), __('Trackback', 'checkmate'), __('Pingback', 'checkmate')); ?>: 
    <?php comment_author_link(); ?> on <?php comment_date(); ?>
    </li>
    
    <?php if('odd'==$thiscomment) { $thiscomment = 'even'; } else { $thiscomment = 'odd'; } ?>
    
<?php endif; endforeach; ?>

    </ol>

<?php endif; ?>
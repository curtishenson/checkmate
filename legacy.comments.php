<?php if (!empty($post->post_password) && $_COOKIE['wp-postpass_'.COOKIEHASH]!=$post->post_password) : ?>
    <p class="comments-locked">Enter your password to view comments.</p>
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

    <h3 class="comments-header"><?php comments_number('0 Comments','1 Comment','% Comments'); ?></h3>
	<p class="smallrss"><?php comments_rss_link('Subscribe to the Comments'); ?></p>
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
            _e($author["highlight"]); 
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

    <h3 class="comments-header">No Comments Yet</h3>
    
<?php endif; ?>

<?php if (comments_open()) : ?>
	
	<p>Be the first to comment.</p>

    <div id="comments-form">
    
    <h3 class="comments-header">Leave a comment</h3>
    
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
				?>" title="Log out of this account">Logout</a></p>

		<button type="submit" name="submit" id="sub">Submit Comment</button>
	    <input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
	
	</div>
    
    <?php else : ?>
	
    <div class="span-6">
		<label for="author">Name<?php if ($req) _e(' <span class="required">(required)</span>'); ?></label>
        <input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" />
        
		<label for="email">E-mail<?php if ($req) _e(' <span class="required">(required)</span>'); ?></label>
        <input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" />
        
        <label for="url">Website</label>
        <input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" />

		<button type="submit" name="submit" id="sub">Submit Comment</button>
        <input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
    </div>

    <?php endif; ?>

	<div class="span-8 last">
		<label for="comment">Comment</label>
        <textarea name="comment" id="comment" rows="5" cols="30"></textarea>
   	</div>
       
    <?php do_action('comment_form', $post->ID); ?>

    </form>
    </div>

<?php endif; // If registration required and not logged in ?>

<?php else : // Comments are closed ?>
    <p id="comments-closed">Sorry, comments for this entry are closed at this time.</p>
<?php endif; ?>

<?php if (pings_open()) : ?>
    <p class="respond"><span id="trackback-link">
        <a href="<?php trackback_url() ?>" rel="trackback">Get a Trackback link</a>
    </span></p>
<?php endif; ?>

<?php

    /* This is a loop for printing pingbacks/trackbacks if there are any */
    if ($numPingBacks != 0) : ?>

    <h3 class="comments-header"><a class="show_trackbacks" href="#"><?php _e($numPingBacks); ?> Trackbacks/Pingbacks</a></h3>
	<p><a class="show_trackbacks" href="#">Click to show or hide trackbacks</a></p>
    <ol id="trackbacks">
    
<?php foreach ($comments as $comment) : ?>
<?php if (get_comment_type()!="comment") : ?>

    <li id="comment-<?php comment_ID() ?>" class="<?php _e($thiscomment); ?>">
    <?php comment_type(__('Comment'), __('Trackback'), __('Pingback')); ?>: 
    <?php comment_author_link(); ?> on <?php comment_date(); ?>
    </li>
    
    <?php if('odd'==$thiscomment) { $thiscomment = 'even'; } else { $thiscomment = 'odd'; } ?>
    
<?php endif; endforeach; ?>

    </ol>

<?php endif; ?>
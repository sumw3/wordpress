<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
	if ( post_password_required() ) { ?>
		<p class="nocomments">This post is password protected. Enter the password to view comments.</p>
	<?php
		return;
	}
$countComments = 0;
$countPings = 0;
if($post->comment_count > 0) {
	$comments_list = array();
	$pings_list = array();
	foreach($comments as $comment) {
		if('comment' == get_comment_type()) $comments_list[++$countComments] = $comment;
		else $pings_list[++$countPings] = $comment;
	}
}
?>
<!-- You can start editing here. -->
	<?php if ( have_comments() ) : ?>
			<div class="comments_title">
				<h3 id="comments"><?php comments_number(__('No Comments', 'yotheme'), __('1 Comment', 'yotheme'), __('% Comments'), 'yotheme'); ?></h3>
				<span><?php comments_rss_link(__('<abbr title="Really Simple Syndication">RSS</abbr> feed for comments on this post.', 'yotheme')); ?></span>
			</div>
			<ol class="commentlist" id="thecomments">
					<?php if (function_exists('wp_list_comments')) { wp_list_comments('type=comment&callback=yotheme_comment&max_depth=1000'); } ?>
			</ol>
			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<div class="comment-page"><?php paginate_comments_links(); ?></div>
			<?php endif; ?>
	<?php else : // this is displayed if there are no comments so far
	?>
		<?php if ('open' == $post->comment_status) : ?>
			<!-- If comments are open, but there are no comments. -->
			<p class="nocontent"><?php _e('No comments yet.', 'yotheme'); ?></p>
		<?php else : // comments are closed
		?>
			<!-- If comments are closed. -->
			<p class="nocontent"><?php _e('Sorry, the comment form is closed at this time.', 'yotheme'); ?></p>
		<?php endif; ?>
	<?php endif; ?>
	<?php if ('open' == $post->comment_status) : ?>
		<div id="respond">
			<div class="cancel-comment-reply">
					<?php cancel_comment_reply_link(); ?>
			</div>
			<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
					<p class="nocontent"><?php printf(__('You must be <a href="%s">logged</a> in to post a comment.', 'yotheme'), get_option('siteurl').'/wp-login.php?redirect_to='.urlencode(get_permalink())) ?></p>
			<?php else : ?>
					<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform" name="comment_form">
				<?php if ( $user_ID ) : ?>
						<p class="signed"><?php printf(__('Logged in as %s | ', 'yotheme'), '<a href="'.get_option('siteurl').'/wp-admin/profile.php">'.$user_identity.'</a>'); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="<?php _e('Log out of this account', 'yotheme') ?>"><?php _e('Logout &raquo;', 'yotheme'); ?></a></p>
				<?php else : ?>
					<div class="authorinfo">
						<input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" title="<?php _e('Name', 'yotheme'); ?> <?php if ($req) _e('(required)'); ?>" />
						<label for="author"><small><?php _e('Name:', 'yotheme'); ?></small></label>
						<input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" title="<?php _e('E-mail', 'yotheme');?><?php _e('(will not be published)', 'yotheme') ?> <?php if ($req) _e('required', 'yotheme'); ?>" />
						<label for="email"><small><?php _e('E-mail:', 'yotheme');?></small></label>
						<input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" title="<?php _e('Website', 'yotheme'); ?>" />
						<label for="url"><small><?php _e('Website:', 'yotheme'); ?></small></label>
					</div>
				<?php endif; ?>
						<?php if(function_exists('cs_print_smilies')) {?><p><?php cs_print_smilies(); ?></p><?php } ?>
						<p><textarea name="comment" id="comment" cols="100%" rows="10" tabindex="4" onkeydown="if(event.ctrlKey&amp;&amp;event.keyCode==13){document.getElementById('submit').click();return false};"></textarea></p>
						<p><input name="submit" type="submit" id="submit" tabindex="5" value="<?php echo attribute_escape(__('Submit Comment', 'yotheme')); ?>" /> <?php _e ('[Ctrl + Enter]', 'yotheme'); ?> <?php comment_id_fields(); ?></p>
						<?php do_action('comment_form', $post->ID); ?>
					</form>
			<?php endif; // If registration required and not logged in
			?>
		</div><!--end respond-->
	<?php endif; // if you delete this the sky will fall on your head
	?>
	<?php if($countPings > 0) : ?>
		<div class="trackbacks-pingbacks">
			<h3><?php _e('Trackbacks and Pingbacks', 'yotheme'); ?></h3>
			<ul id="pinglist">
				<?php foreach($pings_list as $comment) : 
						if('pingback' == get_comment_type()) $pingtype = 'Pingback';
						else $pingtype = 'Trackback';
				?>
				<li id="comment-<?php echo $comment->comment_ID ?>"<?php comment_class(); ?>>
					<?php comment_author_link(); ?> - <?php echo $pingtype; ?> on <?php echo mysql2date('Y/m/d/ H:i', $comment->comment_date); ?>
				</li>
				<?php endforeach; ?>
			</ul>
		</div>
	<?php endif; ?>
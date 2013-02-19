<?php
  /**
  *@desc A single blog post See page.php is for a page layout.
  */

  get_header();
?>
<section id="body">
<?php
  if (have_posts()) : while (have_posts()) : the_post();
  ?>

<article>
	
	<div class="title">
		<h2><?php the_title(); ?></h2>
		<div>
			By <strong><?php the_author(); ?></strong> | <?php the_time(__('F jS, Y', 'yotheme')); ?> | <?php _e('under', 'yotheme'); ?> <?php the_category(', '); ?> | <?php 
			if (!comments_open()) {
				_e( 'Comments are closed.', 'yotheme');
			} else {
				comments_popup_link(__('Leave a comment', 'yotheme'), __('1 Comment', 'yotheme'), __('% Comments', 'yotheme'));
			}
			?>
		</div>
	</div>
	
	<div class="content"><?php the_content(); ?></div>
	
	<?php wp_link_pages('before=<div id="page-links">&after=</div>&next_or_number=next&nextpagelink='.__("Next page", "yotheme").'&previouspagelink='.__("Previous page", "yotheme")); ?>
	
	<?php the_tags('<div class="tags">'.__('<strong>Tags</strong>: ', 'yotheme'), ', ', '</div>'); ?>

</article>

<div id="postnavi">
	<span class="prev"><strong><?php _e('Previous: ', 'yotheme'); ?></strong><?php if (get_previous_post()) : ?><?php previous_post_link('%link') ?><?php else: ?><?php _e('Boss, already the oldest post!', 'yotheme'); ?><?php endif; ?></span>
	<span class="next"><strong><?php _e('Next: ', 'yotheme') ?></strong><?php if (get_next_post()) : ?><?php next_post_link('%link') ?><?php else: ?><?php _e('Dude, already the newest post!', 'yotheme'); ?><?php endif; ?></span>
</div>

	<?php

  comments_template();

  endwhile;
?>
</section>
<?php else: ?>

<p class="nocontent"><?php _e('Sorry, no posts matched your criteria.', 'yotheme'); ?></p>

<?php
  endif;
get_sidebar();
get_footer();
?>
<?php

  /**
  *@desc A page. See single.php is for a blog post layout.
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
		<div class="sprite">
			<strong><?php the_author(); ?></strong> <?php _e('wrote on', 'yotheme'); ?> <?php the_time(__('F jS, Y', 'yotheme')); ?> | <?php 
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

</article>

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
<?php
get_header();
if (have_posts()):
?>

<section id="body">

<?php
while (have_posts()) : the_post();
?>

<article>
	
	<div class="title">
		<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
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
	
	<div class="content"><?php the_content(__('Read more', 'yotheme')); ?></div>

</article>

<?php comments_template(); // Get wp-comments.php template ?>

<?php endwhile; ?>

<?php  if ( $wp_query->max_num_pages > 1 ) : ?>
<nav id="pagenavi">
    <?php par_pagenavi(5); ?>
</nav>
<?php endif; ?>

</section>

<?php else: ?>

<p class="nocontent"><?php _e('Sorry, no posts matched your criteria.', 'yotheme'); ?></p>

<?php
endif;
?>

<?php
get_sidebar();
get_footer();
?>
<?php
  get_header();
?>
<section id="body">
<article>
	<div class="title">
		<h2><?php _e('Welcome to 404 error page!', 'yotheme'); ?></h2>
	</div>
	<div class="content">
		<div class="img_404"><img src="<?php bloginfo('template_url'); ?>/images/404.jpg" alt="404" /></div>
		<div class="text_404">
			<p><?php _e("Welcome to this customized error page. You've reached this page because you've clicked on a link that does not exist. This is probably our fault... but instead of showing you the basic '404 Error' page that is confusing and doesn't really explain anything, we've created this page to explain what went wrong.", 'yotheme'); ?></p>
			<p><?php _e("You can either (a) click on the 'back' button in your browser and try to navigate through our site in a different direction, or (b) click on the following link to go to homepage.", 'yotheme'); ?></p>
		<p><a href="<?php bloginfo('url'); ?>/"><?php _e('Back to homepage &raquo;', 'yotheme'); ?></a></p>
		</div>
	</div>
</article>

</section>
<?php
get_sidebar();
get_footer();
?>
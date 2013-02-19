		</div>
		<footer>
			<p class="copyright"><?php _e('Copyright', 'yotheme'); ?> &copy; 2013 <a href="<?php echo home_url(); ?>" title="<?php bloginfo('description'); ?>"><strong><?php bloginfo('name'); ?></strong></a><br />Powered by <a href="http://www.wordpress.org/" target="_blank" title="Wordpress.org">WordPress</a>. Theme by <a href="http://youed.me/" target="_blank" title="yoUED.me">yoUED</a> valid <a href="http://validator.w3.org/check?uri=<?php echo home_url(); ?>&amp;doctype=HTML5" target="_blank" title="valid HTML5">HTML5</a></p>
		</footer>
	</div>
	<?php wp_footer(); ?>
<?php if (!is_singular()) { ?>
	<div id="top_foot">
		<div id="top" class="sprite"></div>
		<div id="foot" class="sprite"></div>
	</div>
<?php } else { ?>
	<div id="top_foot">
		<div id="top" class="sprite"></div>
		<div id="tocomment" class="sprite"></div>
		<div id="foot" class="sprite"></div>
	</div>
<?php } ?>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/yotheme.js"></script>
</body>
</html>
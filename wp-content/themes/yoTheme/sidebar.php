<aside>
	<ul>
		<li id="searchbox"><?php get_search_form(); ?></li>
		<?php echo SocialMedia(); ?>
<?php
  /**
  * only shown if widget sidebar not enabled
  */
    if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) :

    wp_list_bookmarks('title_after=&title_before=');
	  wp_list_categories('title_li=' . __('Categories', 'yotheme'));
    ?>
    <li id="search">
      <form id="searchform" method="get" action="<?php bloginfo('home'); ?>">
	    <div>
		    <input type="text" name="s" id="s" size="15" /><br />
		    <input type="submit" value="<?php _e('Search', 'yotheme'); ?>" />
	    </div>
	    </form>
    </li>

    <li id="archives"><?php _e('Archives:', 'yotheme'); ?>
	    <ul><?php wp_get_archives('type=monthly'); ?></ul>
    </li>

   <li id="meta"><?php _e('Meta:', 'yotheme'); ?>
	  <ul>
		  <?php wp_register(); ?>
		  <li><?php wp_loginout(); ?></li>
		  <li><a href="<?php bloginfo('rss2_url'); ?>" title="<?php _e('Syndicate this site using RSS', 'yotheme'); ?>"><?php _e('<abbr title="Really Simple Syndication">RSS</abbr>', 'yotheme'); ?></a></li>
		  <li><a href="<?php bloginfo('comments_rss2_url'); ?>" title="<?php _e('The latest comments to all posts in RSS', 'yotheme'); ?>"><?php _e('Comments <abbr title="Really Simple Syndication">RSS</abbr>', 'yotheme'); ?></a></li>
		  <li><a href="http://validator.w3.org/check/referer" title="<?php _e('This page validates as XHTML 1.0 Transitional', 'yotheme'); ?>"><?php _e('Valid <abbr title="eXtensible HyperText Markup Language">XHTML</abbr>', 'yotheme'); ?></a></li>
		  <li><a href="http://gmpg.org/xfn/"><abbr title="XHTML Friends Network">XFN</abbr></a></li>
		  <li><a href="http://wordpress.org/" title="<?php _e('Powered by WordPress, state-of-the-art semantic personal publishing platform.', 'yotheme'); ?>"><abbr title="WordPress">WP</abbr></a></li>
		  <?php wp_meta(); ?>
	  </ul>
   </li>
<?php endif; ?>

</ul>
</aside>
<br class="clr" />
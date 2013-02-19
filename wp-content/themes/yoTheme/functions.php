<?php
/*
* yoTheme, a html5 wordpress theme.
*
* @licence Apache License
* @author Ethan - http://youed.me - luo123qiu@gmail.com
* 
* Project URL http://code.google.com/p/yotheme/
*/

/* Fix Jquery ref */
if (!is_admin()) add_action("wp_enqueue_scripts", "my_jquery_enqueue", 11);
function my_jquery_enqueue() {
   wp_deregister_script('jquery');
   wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://lib.sinaapp.com/js/jquery/1.7.2/jquery.min.js", false, null);
   wp_enqueue_script('jquery');
}

/* Regist WP menu */
register_nav_menu( 'nav-menu', 'Menu');

/* Include logo.php */
include_once(TEMPLATEPATH . '/logo.php');
/* Include control.php */
require_once(TEMPLATEPATH . '/control.php');

/**
* register_sidebar()
*
*@desc Registers the markup to display in and around a widget
*/
if ( function_exists('register_sidebar') )
{
  register_sidebar(array(
    'before_widget' => '<li id="%1$s" class="widget %2$s">',
    'after_widget' => '</li>',
    'before_title' => '<h3>',
    'after_title' => '</h3>',
  ));
}
/* Language support */
function theme_init(){
	load_theme_textdomain('yotheme', get_template_directory() . '/languages');
}
add_action ('init', 'theme_init');

/* Pagenavi */
function par_pagenavi($range = 9){
	global $paged, $wp_query;
	if ( !$max_page ) {$max_page = $wp_query->max_num_pages;}
	if($max_page > 1){if(!$paged){$paged = 1;}
	if($paged != 1){echo "<a href='" . get_pagenum_link(1) . "' class='extend' title='".__('Back to the first page', 'yotheme')."'>".__('First', 'yotheme')."</a>";}
	previous_posts_link(__('Previous page', 'yotheme'));
    if($max_page > $range){
		if($paged < $range){for($i = 1; $i <= ($range + 1); $i++){echo "<a href='" . get_pagenum_link($i) ."'";
		if($i==$paged)echo " class='current'";echo ">$i</a>";}}
    elseif($paged >= ($max_page - ceil(($range/2)))){
		for($i = $max_page - $range; $i <= $max_page; $i++){echo "<a href='" . get_pagenum_link($i) ."'";
		if($i==$paged)echo " class='current'";echo ">$i</a>";}}
	elseif($paged >= $range && $paged < ($max_page - ceil(($range/2)))){
		for($i = ($paged - ceil($range/2)); $i <= ($paged + ceil(($range/2))); $i++){echo "<a href='" . get_pagenum_link($i) ."'";if($i==$paged) echo "";echo ">$i</a>";}}}
    else{for($i = 1; $i <= $max_page; $i++){echo "<a href='" . get_pagenum_link($i) ."'";
    if($i==$paged)echo " class='current'";echo ">$i</a>";}}
	next_posts_link(__('Next page', 'yotheme'));
    if($paged != $max_page){echo "<a href='" . get_pagenum_link($max_page) . "' class='extend' title='".__('Go to the last page', 'yotheme')."'>".__('Last', 'yotheme')."</a>";}}
}

/* ShortUrl */
function myUrl($atts, $content = null) {

extract(shortcode_atts(array(

"href" => 'http://'

), $atts));

return '<a target="_blank" href="'.$href.'" rel="nofollow">'.$content.'</a>';

}

add_shortcode("url", "myUrl");
/* Social media */
function SocialMedia() {
	if (get_option('yotheme_sina')||get_option('yotheme_txwb')||get_option('yotheme_renren')||get_option('yotheme_facebook')||get_option('yotheme_twitter')||get_option('yotheme_zhihu')) {
?>
		<li id="socialmedia">
			<ul>
				<?php if(get_option('yotheme_sina')) { ?><li class="sina"><a href="http://www.weibo.com/<?php echo get_option('yotheme_sina'); ?>" target="_blank" title="在新浪微博上关注我"></a></li><?php } ?>
				<?php if(get_option('yotheme_txwb')) { ?><li class="twb"><a href="http://t.qq.com/<?php echo get_option('yotheme_txwb'); ?>" target="_blank" title="在腾讯微博上关注我"></a></li><?php } ?>
				<?php if(get_option('yotheme_wangyi')) { ?><li class="wangyi"><a href="http://t.163.com/<?php echo get_option('yotheme_wangyi'); ?>" target="_blank" title="在网易微博上关注我"></a></li><?php } ?>
				<?php if(get_option('yotheme_sohu')) { ?><li class="sohu"><a href="http://<?php echo get_option('yotheme_sohu'); ?>.t.sohu.com/" target="_blank" title="在搜狐微博上关注我"></a></li><?php } ?>
				<?php if(get_option('yotheme_renren')) { ?><li class="renren"><a href="http://www.renren.com/<?php echo get_option('yotheme_renren'); ?>" target="_blank" title="和我成为人人好友"></a></li><?php } ?>
				<?php if(get_option('yotheme_douban')) { ?><li class="douban"><a href="http://www.douban.com/people/<?php echo get_option('yotheme_douban'); ?>" target="_blank" title="在豆瓣上找到我！"></a></li><?php } ?>
				<?php if(get_option('yotheme_facebook')) { ?><li class="fb"><a href="http://www.facebook.com/<?php echo get_option('yotheme_facebook'); ?>" target="_blank" title="查看我的Facebook主页"></a></li><?php } ?>
				<?php if(get_option('yotheme_twitter')) { ?><li class="twitter"><a href="http://www.twitter.com/<?php echo get_option('yotheme_twitter'); ?>" target="_blank" title="在Twitter上关注我"></a></li><?php } ?>
				<?php if(get_option('yotheme_flickr')) { ?><li class="flickr"><a href="http://www.flickr.com/photos/<?php echo get_option('yotheme_flickr'); ?>" target="_blank" title="查看我的Flickr相册"></a></li><?php } ?>
				<?php if(get_option('yotheme_picasa')) { ?><li class="picasa"><a href="http://picasaweb.google.com/<?php echo get_option('yotheme_picasa'); ?>" target="_blank" title="查看我的Picasa相册"></a></li><?php } ?>
				<?php if(get_option('yotheme_zhihu')) { ?><li class="zhihu"><a href="http://www.zhihu.com/people/<?php echo get_option('yotheme_zhihu'); ?>" target="_blank" title="看看我的知乎"></a></li><?php } ?>
			</ul>
		</li>
<?php
	}
}
/* Comments */
function yotheme_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment;
	global $commentcount;
	$page = ( !empty($in_comment_loop) ) ? get_query_var('cpage') : get_page_of_comment( $comment->comment_ID, $args );
	$cpp=get_option('comments_per_page');
	if(!$commentcount) { 
		if ($page > 1) {
		$commentcount = $cpp * ($page - 1);
		} else {
		$commentcount = 0;
		}
	}
?>

<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
	<div id="comment-<?php comment_ID(); ?>">
		<?php echo get_avatar($comment,$size='32',$default='<path_to_url>' ); ?>
		<div class="cite">
			<strong id="comment_author">
					<?php echo get_comment_author_link(); ?>
			</strong>
			<?php _e(' Says:', 'yotheme'); ?><br />
			<span><?php if(!$parent_id = $comment->comment_parent) {printf(__('#%1$s', 'yotheme'), ++$commentcount);} ?> <a href="#comment-<?php comment_ID() ?>"><?php _e('At', 'yotheme'); ?> <?php comment_date(__('F jS, Y', 'yotheme')) ?> <?php comment_time() ?></a> <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?> <?php edit_comment_link(__('(Edit)'),'  ','') ?></span>
		</div>
		<?php if ($comment->comment_approved == '0') : ?>
		<p class="waiting"><?php _e('Your comment is awaiting moderation.') ?></p>
		<?php endif; ?>
		<?php comment_text() ?>
	</div>

<?php } ?>
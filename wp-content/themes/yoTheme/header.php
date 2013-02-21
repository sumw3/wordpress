<!DOCTYPE HTML>
<html>
<head>
<?php
if (is_home() || is_page()) {
    $description = get_option('yotheme_ds');
    $keywords = get_option('yotheme_kw');
}
elseif (is_single()) {
    $description1 = get_post_meta($post->ID, "description", true);
    $description2 = mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 200, "…");
    // 填写自定义字段description时显示自定义字段的内容，否则使用文章内容前200字作为描述
    $description = $description1 ? $description1 : $description2;
    // 填写自定义字段keywords时显示自定义字段的内容，否则使用文章tags作为关键词
    $keywords = get_post_meta($post->ID, "keywords", true);
    if($keywords == '') {
        $tags = wp_get_post_tags($post->ID);    
        foreach ($tags as $tag ) {
            $keywords = $keywords . $tag->name . ", ";    
        }
        $keywords = rtrim($keywords, ', ');
    }
}
elseif (is_category()) {
    $description = category_description();
    $keywords = single_cat_title('', false);
}
elseif (is_tag()){
    $description = tag_description();
    $keywords = single_tag_title('', false);
}
$description = trim(strip_tags($description));
$keywords = trim(strip_tags($keywords));
?>
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<meta name="keywords" content="<?php echo $keywords; ?>" /> 
	<meta name="description" content="<?php echo $description; ?>" />
	<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'yotheme'), max( $paged, $page ) );

	?></title>
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" media="all" />
	<link rel="icon" href="<?php bloginfo('url'); ?>/favicon.ico" type="image/x-icon" />
	<link rel="shortcut icon" href="<?php bloginfo('url'); ?>/favicon.ico" type="image/x-icon" />
	<!--[if IE 6]>
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/DD_belatedPNG_0.0.8a.js"></script>
	<script type="text/javascript">
		DD_belatedPNG.fix('#logo, .rssfeed, img');
	</script>
	<![endif]-->
	<!--[if lte IE 9]>
	    <script src="<?php bloginfo('template_directory'); ?>/js/html5shiv.js" type="text/javascript"></script>
		<script src="<?php bloginfo('template_directory'); ?>/js/selectivizr-min.js" type="text/javascript"></script>
	<![endif]-->
	<link rel="alternate" type="application/rss+xml" title="RSS 2.0 - all posts" href="<?php if(get_option('yotheme_feed')) { echo get_option('yotheme_feed'); } else { bloginfo('rss2_url'); } ?>" />
	<link rel="alternate" type="application/rss+xml" title="RSS 2.0 - all comments" href="<?php echo home_url(); ?>/comments/feed/" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<?php wp_get_archives('type=monthly&format=link'); ?>
	<?php wp_head(); ?>
	<?php if ( is_singular() ){ ?>
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/comments-ajax.js"></script>
	<?php } ?>
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "//hm.baidu.com/hm.js?b3aed42fb5d721831fc522114e9a41ea";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>
</head>
<body style="background:<?php if(get_option('yotheme_bg')) {echo "url(".get_option('yotheme_bg').")";} else {echo "#000";} ?>;">
	<div id="container">
		<header>
			<div id="logo"><a href="<?php echo home_url(); ?>" title="<?php bloginfo('description'); ?>"><h1><?php bloginfo('name'); ?></h1><span id="desc"><?php bloginfo('description'); ?></span></a></div>
			<nav id="mainmenu">
			<?php wp_nav_menu(); ?>
			</nav>
			<a href="<?php if(get_option('yotheme_feed')) { echo get_option('yotheme_feed'); } else { bloginfo('rss2_url'); } ?>" target="_blank" title="<?php _e('Subscribe', 'yotheme'); ?>" class="rssfeed"><? _e('Subscribe', 'yotheme'); ?></a>
		</header>
		<div id="wrapper">
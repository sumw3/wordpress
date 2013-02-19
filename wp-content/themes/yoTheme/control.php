<?php
//via wange.im
$themename = "yoTheme";
$shortname = "yotheme";
$options = array (
    array("name" => "Google CSE ID(<a href='https://www.google.com/cse/' target='_blank' title='获取Coogle自定义搜索'>这是什么？</a>)","id" => $shortname."_cse","type" => "text","msg" => ""),
	array("name" => "GA ID(<a href='https://www.google.com/analytics/' target='_blank' title='获取Google Analytics'>这是什么？</a>)","id" => $shortname."_ga","type" => "text","msg" => ""),
	array("name" => "Twitter","id" => $shortname."_twitter","type" => "text","msg" => "如：http://twitter.com/<span style='color:red'>UED_Ethan</span>，这里填写 UED_Ethan 即可，下同例。"),
	array("name" => "Facebook","id" => $shortname."_facebook","type" => "text","msg" => "例：http://www.facebook.com/<span style='color:red'>youed</span>"),
	array("name" => "Flickr","id" => $shortname."_flickr","type" => "text","msg" => "例：http://www.flickr.com/photos/<span style='color:red'>qiunet</span>/"),
	array("name" => "Picasa","id" => $shortname."_picasa","type" => "text","msg" => "例：http://picasaweb.google.com/<span style='color:red'>luo123qiu</span>"),
	array("name" => "新浪微博","id" => $shortname."_sina","type" => "text","msg" => "例：http://weibo.com/<span style='color:red'>youed</span>"),
	array("name" => "腾讯微博","id" => $shortname."_txwb","type" => "text","msg" => "例：http://t.qq.com/<span style='color:red'>UED_Ethan</span>"),
	array("name" => "网易微博","id" => $shortname."_wangyi","type" => "text","msg" =>"例：http://t.163.com/<span style='color:red'>youed</span>"),
	array("name" => "搜狐微博","id" => $shortname."_sohu","type" => "text","msg" =>"例：http://<span style='color:red'>youed</span>.t.sohu.com/"),
	array("name" => "人人网","id" => $shortname."_renren","type" => "text","msg" => "例：http://www.renren.com/<span style='color:red'>UED_Ethan</span>"),
	array("name" => "知乎","id" => $shortname."_zhihu","type" => "text","msg" => "例：http://www.zhihu.com/people/<span style='color:red'>youed</span>"),
	array("name" => "豆瓣","id" => $shortname."_douban","type" => "text","msg" => "你可以在豆瓣账号基本设置中找到它"),
	array("name" => "自定义Feed地址","id" => $shortname."_feed","type" => "text","msg" => ""),
	array("name" => "背景图片","id" => $shortname."_bg","type" => "text","msg" => "<span style='color:red'>/images/bg.jpg</span>、<span style='color:red'>http://youed.me/images/bg.jpg</span> 两种URL格式均可，另外你还可以设置纯颜色。"),
	array("name" => "关键词","id" => $shortname."_kw","type" => "text","msg" => "填写您的站点关键词，SEO必备"),
	array("name" => "站点描述","id" => $shortname."_ds","type" => "text","msg" => "填写您的站点描述")
);
function yotheme_add_admin() {
    global $themename, $shortname, $options;
    if ( $_GET['page'] == basename(__FILE__) ) {
        if ( 'save' == $_REQUEST['action'] ) {
            foreach ($options as $value) {
            update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }
            foreach ($options as $value) {
            if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }
            header("Location: themes.php?page=control.php&saved=true");
            die;
        } else if( 'reset' == $_REQUEST['action'] ) {
            foreach ($options as $value) {
                delete_option( $value['id'] );
                update_option( $value['id'], '' );
            }
            header("Location: themes.php?page=control.php&reset=true");
            die;
        }
    }
    add_theme_page(__('Options', 'yotheme'), __('Options', 'yotheme'), 'edit_themes', basename(__FILE__), 'yotheme_admin');
}
function yotheme_admin() {
    global $themename, $shortname, $options;
    if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.__("Settings saved.", "yotheme").'</strong></p></div>';
    if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.__("Already reset to default.", "yotheme").'</strong></p></div>';
?>
    <style type="text/css">
    th{text-align:left; font-size:12px;}
	form {padding:0; margin:0;}
	.submit {margin:0; padding:5px 0;}
    </style>
    <div class="wrap">
        <h2><?php _e('Options', 'yotheme'); ?></h2>
        <form method="post">
            <div class="submit" style="padding:0;">
                <input style="font-size:12px !important;" name="save" type="submit" value="<?php _e('Save options', 'yotheme'); ?>" />   
                <input type="hidden" name="action" value="save" />
            </div>
			<hr />
            <table class="optiontable" >
                <?php foreach ($options as $value) { ?>
                        <tr align="left">
                            <th scope="row"><?php echo $value['name']; ?>:</th>
                            <td>
                                <input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo get_settings( $value['id'] ); } ?>" size="50" /> <?php echo $value['msg']; ?>
                            </td>
                        </tr>
                    <?php } ?>
            </table>
            <hr />
            <div class="submit">
                <input style="font-size:12px !important;" name="save" type="submit" value="<?php _e('Save options', 'yotheme'); ?>" />   
                <input type="hidden" name="action" value="save" />
            </div>
        </form>
        <form method="post" class="defaultbutton">
            <div class="submit">
                <input style="font-size:12px !important;" name="reset" type="submit" value="<?php _e('Load default', 'yotheme'); ?>" />
                <input type="hidden" name="action" value="reset" />
            </div>
        </form>
    </div>
    <?php
}
add_action('admin_menu', 'yotheme_add_admin');
?>
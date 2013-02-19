<?php
//* HEAD
define('HEADER_IMAGE', '%s/images/yologo.png');
define('HEADER_IMAGE_WIDTH', 200);
define('HEADER_IMAGE_HEIGHT', 80);
define('NO_HEADER_TEXT', true );
define('HEADER_TEXTCOLOR', '#FFF');
function admin_header_style() { ?>
<style type="text/css">
#headimg{
background: #fff url(<?php header_image(); ?>) no-repeat 0 0;
color: #333;
float: left;
margin: 0;
padding: 0;
height: <?php echo HEADER_IMAGE_HEIGHT; ?>px;
width: <?php echo HEADER_IMAGE_WIDTH; ?>px;
clear:both;
}
.wrap {
clear:both;
}
#uploadForm {
margin:0!important;
}
</style>
<?php }
function header_style() { ?>
<style type="text/css">
#logo{
background: url(<?php header_image(); ?>) left center no-repeat;
float: left;
margin:15px 0 0 0;
height: <?php echo HEADER_IMAGE_HEIGHT; ?>px;
width: 300px;
}
<?php
if(get_header_image()) {
$display=' display:none;';
}
?>
#logo h1 {font-size:2.3em; font-weight:bold!important; height:35px; word-wrap:normal; overflow:hidden; margin-top:5px; <?php echo $display; ?>}
#logo a {color:#CCC; display:block; width:300px; height:<?php echo HEADER_IMAGE_HEIGHT; ?>px;}
#logo a:hover {text-decoration:none;}
#desc {color:#666; line-height:20px;<?php echo $display; ?>}
#logo:hover h1 a {color:white;}/* without IE6 */
#logo:hover #desc {color:#AAA;}/* without IE6 */
</style>
<?php }
if ( function_exists('add_custom_image_header') ) {
add_custom_image_header('header_style', 'admin_header_style');
}
?>
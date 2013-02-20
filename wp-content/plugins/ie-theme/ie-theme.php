<?php
/*
Plugin Name: IE主题
Plugin URI: http://www.izt.me
Description: Select a theme for IE browser...
Version: 1.0.0
Author: 爱主题
Author URI: http://www.izt.me

*/


function ie_init(){
	global $ie, $iever;
    $ie = get_option("ie");
    $ie['purl']=WP_PLUGIN_URL.'/'.str_replace(basename(__FILE__),"",plugin_basename(__FILE__));
    $ie['path']=WP_PLUGIN_DIR.'/'.str_replace(basename(__FILE__),"",plugin_basename(__FILE__));
    
    if( preg_match("/msie.{0,1}([0-9]{1,2}).([0-9]{1,3})/i",$_SERVER["HTTP_USER_AGENT"],$ver) )
	    $iever = $ver[1];  
	    else $iever=0;
}


function ie_decide_theme() { 
	global $iever, $ie;	
	
	$th=get_theme(get_current_theme());
	$dir=stripslashes(str_replace($th['Theme Root'],"",$th['Template Dir']));
	if(!$ie["theme"]) return $dir; 
    if($iever>0 and $iever <=$ie['version']) {
		$th=get_theme($ie['theme']);
		$dir=stripslashes(str_replace($th['Theme Root'],"",$th['Template Dir']));
    	return $dir;
    	} 
	return $dir;
}

function add_ie_stylesheet(){ 
	global $iever, $ie;
	$ieStyleFile = $ie['path']."ie.css";
    $ieStyleUrl = $ie['purl'].'ie.css';
       
        if ( file_exists($ieStyleFile) ) {
            wp_register_style('ie', $ieStyleUrl);
            wp_enqueue_style( 'ie');
		} 
		wp_enqueue_script("jquery");

} 

// ------------- admin options menu ---------------------

function ie_admin_menu(){
	add_options_page('IE THEME', 'IE主题', 'administrator', 'ie', 'ie_options_menu');
}

function ie_options_menu() {
global $ie;
    $ie = get_option("ie"); 
	if ($_POST["action"] == "saveconfiguration") {
				$ie=ie_update_options($_POST['ie']);
				update_option('ie',$ie);
				echo '<div class="updated"><p><strong>设置保存成功！</strong></p></div>';
	}
	
	echo ('
		<div class="wrap">
		<form method="post" name="ieset">'.screen_icon().'
			<h2>IE主题设置</h2>
		
	');

	echo ('

		<table>
		<tr>
		<td>IE版本 <= </td>
		<td><select name="ie[version]">
			<option value="6"');
		if ($ie['version']==6) echo('selected="selected" ');
		echo('>6</option>
			<option value="7"');
		if ($ie['version']==7) echo('selected="selected" ');
		echo('>7</option>
			<option value="8"');
		if ($ie['version']==8) echo('selected="selected" ');
		echo('>8</option>
			<option value="9"');
		if ($ie['version']==9) echo('selected="selected" ');
		echo('>9</option>
			<option value="10"');
		if ($ie['version']==10) echo('selected="selected" ');
		echo('>10</option>
			<option value="999"');
		if ($ie['version']==999) echo('selected="selected" ');
		echo('>所有版本</option>
		
		</td>
		</tr>

		
		<tr>
		<td>IE主题:</td>
		<td><select name="ie[theme]"><option value="">不开启</option>');
		
		$th=get_themes();
		foreach($th as $name => $values){
			echo ('<option ');
			
			if ($name==$ie['theme']) echo('selected="selected" ');
			
			echo('value="'.$name.'">'.$name.'</option>');
			
			}	

	echo('</select></td>
		</tr>');
	echo ('	</table>
		<input type="hidden" name="action" value="saveconfiguration">
		<input type="submit" class="button-primary" value="保存">
		</form></fieldset></div>');    

}
function ie_update_options($options){
	global $ie;

	while (list($option, $value) = each($options)) {
		if( get_magic_quotes_gpc() ) { 
		$value = stripslashes($value);
		}
		$ie[$option] =$value;
	}

return $ie;
}

add_action('admin_menu', 'ie_admin_menu'); 
add_filter('template', 'ie_decide_theme'); 
add_filter('stylesheet', 'ie_decide_theme'); 
add_action('plugins_loaded', 'ie_init'); 
?>
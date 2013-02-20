<?php
$wpconfig = realpath("../../../wp-config.php");
if (!file_exists($wpconfig))  {
	echo "Could not found wp-config.php. Error in path :\n\n".$wpconfig ;	
	die;	
}
require_once($wpconfig);
require_once(ABSPATH.'/wp-admin/admin.php');
global $wpdb;
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Code Colorer</title>
<!-- 	<meta http-equiv="Content-Type" content="<?php// bloginfo('html_type'); ?>; charset=<?php //echo get_option('blog_charset'); ?>" /> -->
	<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/utils/form_utils.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-content/plugins/codecolorer-tinymce-button/tinymce.js"></script>
	<base target="_self" />
</head>
		<body id="link" onload="tinyMCEPopup.executeOnLoad('init();');document.body.style.display='';" style="display: none">
<!-- <form onsubmit="insertLink();return false;" action="#"> -->
	<form name="cctb" action="#">
		<table border="0" cellpadding="4" cellspacing="0">
         <tr>
			<td nowrap="nowrap"><label for="cctb_main"><?php _e("Select Language", 'cctb_main'); ?></label></td>
			<td><select id="cctb_lang" name="cctb_main" style="width: 200px">
			<option value="abap"><?php _e("abap", 'cctb_main'); ?></option>	<option value="actionscript"><?php _e("actionscript", 'cctb_main'); ?></option>
			<option value="actionscript3"><?php _e("actionscript3", 'cctb_main'); ?></option> <option value="ada"><?php _e("ada", 'cctb_main'); ?></option>
			<option value="apache"><?php _e("apache", 'cctb_main'); ?></option> <option value="applescript"><?php _e("applescript", 'cctb_main'); ?></option>
			<option value="apt_sources"><?php _e("apt_sources", 'cctb_main'); ?></option> <option value="asm"><?php _e("asm", 'cctb_main'); ?></option>
			<option value="asp"><?php _e("asp", 'cctb_main'); ?></option> <option value="autoit"><?php _e("autoit", 'cctb_main'); ?></option>
			<option value="avisynth"><?php _e("avisynth", 'cctb_main'); ?></option> <option value="bash"><?php _e("bash", 'cctb_main'); ?></option>
			<option value="basic4gl"><?php _e("basic4gl", 'cctb_main'); ?></option>	<option value="bf"><?php _e("bf", 'cctb_main'); ?></option>
			<option value="blitzbasic"><?php _e("blitzbasic", 'cctb_main'); ?></option>	<option value="bnf"><?php _e("bnf", 'cctb_main'); ?></option>
			<option value="boo"><?php _e("boo", 'cctb_main'); ?></option> <option value="c"><?php _e("c", 'cctb_main'); ?></option>
			<option value="c_mac"><?php _e("c_mac", 'cctb_main'); ?></option> <option value="caddcl"><?php _e("caddcl", 'cctb_main'); ?></option>
			<option value="cadlisp"><?php _e("cadlisp", 'cctb_main'); ?></option> <option value="cfdg"><?php _e("cfdg", 'cctb_main'); ?></option>
			<option value="cfm"><?php _e("cfm", 'cctb_main'); ?></option> <option value="cil"><?php _e("cil", 'cctb_main'); ?></option>
			<option value="cobol"><?php _e("cobol", 'cctb_main'); ?></option> <option value="cpp-qt"><?php _e("cpp-qt", 'cctb_main'); ?></option>
			<option value="cpp"><?php _e("cpp", 'cctb_main'); ?></option> <option value="csharp"><?php _e("csharp", 'cctb_main'); ?></option>
			<option value="css"><?php _e("css", 'cctb_main'); ?></option> <option value="d"><?php _e("d", 'cctb_main'); ?></option>
			<option value="delphi"><?php _e("delphi", 'cctb_main'); ?></option>	<option value="diff"><?php _e("diff", 'cctb_main'); ?></option>
			<option value="div"><?php _e("div", 'cctb_main'); ?></option> <option value="dos"><?php _e("dos", 'cctb_main'); ?></option>
			<option value="dot"><?php _e("dot", 'cctb_main'); ?></option> <option value="eiffel"><?php _e("eiffel", 'cctb_main'); ?></option>
			<option value="email"><?php _e("email", 'cctb_main'); ?></option> <option value="fortran"><?php _e("fortran", 'cctb_main'); ?></option>
			<option value="freebasic"><?php _e("freebasic", 'cctb_main'); ?></option> <option value="genero"><?php _e("genero", 'cctb_main'); ?></option>
			<option value="gettext"><?php _e("gettext", 'cctb_main'); ?></option> <option value="glsl"><?php _e("glsl", 'cctb_main'); ?></option>
			<option value="gml"><?php _e("gml", 'cctb_main'); ?></option> <option value="gnuplot"><?php _e("gnuplot", 'cctb_main'); ?></option>
			<option value="groovy"><?php _e("groovy", 'cctb_main'); ?></option> <option value="haskell"><?php _e("haskell", 'cctb_main'); ?></option>
			<option value="hq9plus"><?php _e("hq9plus", 'cctb_main'); ?></option> <option value="html4strict"><?php _e("html4strict", 'cctb_main'); ?></option>
			<option value="idl"><?php _e("idl", 'cctb_main'); ?></option> <option value="ini"><?php _e("ini", 'cctb_main'); ?></option>
			<option value="inno"><?php _e("inno", 'cctb_main'); ?></option> <option value="intercal"><?php _e("intercal", 'cctb_main'); ?></option>
			<option value="io"><?php _e("io", 'cctb_main'); ?></option>	<option value="java"><?php _e("java", 'cctb_main'); ?></option>
			<option value="java5"><?php _e("java5", 'cctb_main'); ?></option> 
			<option value="javascript"><?php _e("javascript", 'cctb_main'); ?></option>	<option value="kixtart"><?php _e("kixtart", 'cctb_main'); ?></option>
			<option value="klonec"><?php _e("klonec", 'cctb_main'); ?></option>	<option value="klonecpp"><?php _e("klonecpp", 'cctb_main'); ?></option>
			<option value="latex"><?php _e("latex", 'cctb_main'); ?></option> <option value="lisp"><?php _e("lisp", 'cctb_main'); ?></option>
			<option value="lolcode"><?php _e("lolcode", 'cctb_main'); ?></option> <option value="lotusformulas"><?php _e("lotusformulas", 'cctb_main'); ?></option>
			<option value="lotusscript"><?php _e("lotusscript", 'cctb_main'); ?></option> <option value="lscript"><?php _e("lscript", 'cctb_main'); ?></option>
			<option value="lua"><?php _e("lua", 'cctb_main'); ?></option> <option value="m68k"><?php _e("m68k", 'cctb_main'); ?></option>
			<option value="make"><?php _e("make", 'cctb_main'); ?></option>	<option value="matlab"><?php _e("matlab", 'cctb_main'); ?></option>
			<option value="mirc"><?php _e("mirc", 'cctb_main'); ?></option>	<option value="mpasm"><?php _e("mpasm", 'cctb_main'); ?></option>
			<option value="mxml"><?php _e("mxml", 'cctb_main'); ?></option>	<option value="mysql"><?php _e("mysql", 'cctb_main'); ?></option>
			<option value="nsis"><?php _e("nsis", 'cctb_main'); ?></option>	<option value="objc"><?php _e("objc", 'cctb_main'); ?></option>
			<option value="ocaml-brief"><?php _e("ocaml-brief", 'cctb_main'); ?></option> <option value="ocaml"><?php _e("ocaml", 'cctb_main'); ?></option>
			<option value="oobas"><?php _e("oobas", 'cctb_main'); ?></option> <option value="oracle11"><?php _e("oracle11", 'cctb_main'); ?></option>
			<option value="oracle8"><?php _e("oracle8", 'cctb_main'); ?></option> <option value="pascal"><?php _e("pascal", 'cctb_main'); ?></option>
			<option value="per"><?php _e("per", 'cctb_main'); ?></option> <option value="perl"><?php _e("perl", 'cctb_main'); ?></option>
			<option value="php-brief"><?php _e("php-brief", 'cctb_main'); ?></option> <option value="php"><?php _e("php", 'cctb_main'); ?></option>
			<option value="pic16"><?php _e("pic16", 'cctb_main'); ?></option> <option value="pixelbender"><?php _e("pixelbender", 'cctb_main'); ?></option>
			<option value="plsql"><?php _e("plsql", 'cctb_main'); ?></option> <option value="povray"><?php _e("povray", 'cctb_main'); ?></option>
			<option value="powershell"><?php _e("powershell", 'cctb_main'); ?></option> <option value="progress"><?php _e("progress", 'cctb_main'); ?></option>
			<option value="prolog"><?php _e("prolog", 'cctb_main'); ?></option> <option value="providex"><?php _e("providex", 'cctb_main'); ?></option>
			<option value="python"><?php _e("python", 'cctb_main'); ?></option> <option value="qbasic"><?php _e("qbasic", 'cctb_main'); ?></option>
			<option value="rails"><?php _e("rails", 'cctb_main'); ?></option> <option value="reg"><?php _e("reg", 'cctb_main'); ?></option>
			<option value="robots"><?php _e("robots", 'cctb_main'); ?></option> <option value="ruby"><?php _e("ruby", 'cctb_main'); ?></option>
			<option value="sas"><?php _e("sas", 'cctb_main'); ?></option> <option value="scala"><?php _e("scala", 'cctb_main'); ?></option>
			<option value="scheme"><?php _e("scheme", 'cctb_main'); ?></option> <option value="scilab"><?php _e("scilab", 'cctb_main'); ?></option>
			<option value="sdlbasic"><?php _e("sdlbasic", 'cctb_main'); ?></option>	<option value="smalltalk"><?php _e("smalltalk", 'cctb_main'); ?></option>
			<option value="smarty"><?php _e("smarty", 'cctb_main'); ?></option> <option value="sql"><?php _e("sql", 'cctb_main'); ?></option>
			<option value="tcl"><?php _e("tcl", 'cctb_main'); ?></option> <option value="teraterm"><?php _e("teraterm", 'cctb_main'); ?></option>
			<option value="text"><?php _e("text", 'cctb_main'); ?></option> <option value="thinbasic"><?php _e("thinbasic", 'cctb_main'); ?></option>
			<option value="tsql"><?php _e("tsql", 'cctb_main'); ?></option>	<option value="typoscript"><?php _e("typoscript", 'cctb_main'); ?></option>
			<option value="vb"><?php _e("vb", 'cctb_main'); ?></option>	<option value="vbnet"><?php _e("vbnet", 'cctb_main'); ?></option>
			<option value="verilog"><?php _e("verilog", 'cctb_main'); ?></option> <option value="vhdl"><?php _e("vhdl", 'cctb_main'); ?></option>
			<option value="vim"><?php _e("vim", 'cctb_main'); ?></option> <option value="visualfoxpro"><?php _e("visualfoxpro", 'cctb_main'); ?></option>
			<option value="visualprolog"><?php _e("visualprolog", 'cctb_main'); ?></option>	<option value="whitespace"><?php _e("whitespace", 'cctb_main'); ?></option>
			<option value="winbatch"><?php _e("winbatch", 'cctb_main'); ?></option>	<option value="xml"><?php _e("xml", 'cctb_main'); ?></option>
			<option value="xorg_conf"><?php _e("xorg_conf", 'cctb_main'); ?></option> <option value="xpp"><?php _e("xpp", 'cctb_main'); ?></option>
			<option value="yaml"><?php _e("yaml", 'cctb_main'); ?></option>	<option value="z80"><?php _e("z80", 'cctb_main'); ?></option>
            </select></td>
          </tr>
          <tr>
			<td nowrap="nowrap" valign="top"><label for="showtype"><?php _e("Show Line Number", 'cctb_main'); ?></label></td>
            <td><label><input name="showtype" id='cctb_linenumbers' type="checkbox" checked="checked" /></label></td>
          </tr>
        </table>
	<div class="mceActionPanel">
		<div style="float: left">
			    <input type="button" id="cancel" name="cancel" value="<?php _e("Cancel", 'cctb_main'); ?>" onclick="tinyMCEPopup.close();" />
		</div>

		<div style="float: right">
				<input type="submit" id="insert" name="insert" value="<?php _e("Insert", 'cctb_main'); ?>" onclick="insertCCTBcode();" />
		</div>
	</div>
</form>
</body>
</html>
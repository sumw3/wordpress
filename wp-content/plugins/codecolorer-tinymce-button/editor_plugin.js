// Docu : http://wiki.moxiecode.com/index.php/TinyMCE:Create_plugin/3.x#Creating_your_own_plugins

(function() {
	// Load plugin specific language pack
	tinymce.PluginManager.requireLangPack('cctb');
	 
	tinymce.create('tinymce.plugins.cctb', {
		
		init : function(ed, url) {
		// Register the command so that it can be invoked by using tinyMCE.activeEditor.execCommand('mceExample');

			ed.addCommand('cctb', function() {
				ed.windowManager.open({
					file : url + '/window.php',
					width : 360,
					height : 90,
					inline : 1
				}, {
					plugin_url : url // Plugin absolute URL
				});
			});

			// Register example button
			ed.addButton('cctb', {
				title : 'Code Colorer',
				cmd : 'cctb',
				image : url + '/cctb_img.png'
			});

			// Add a node change handler, selects the button in the UI when a image is selected
			ed.onNodeChange.add(function(ed, cm, n) {
				cm.setActive('cctb', n.nodeName == 'IMG');
			});
		},
		createControl : function(n, cm) {
			return null;
		},
		getInfo : function() {
			return {
					longname  : 'cctb',
					author 	  : 'Nick Remaslinnikov',
					authorurl : 'http://www.homolibere.info',
					infourl   : 'http://www.homolibere.info',
					version   : "0.1 beta"
			};
		}
	});

	// Register plugin
	tinymce.PluginManager.add('cctb', tinymce.plugins.cctb);
})();



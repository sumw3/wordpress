<?php get_header();  ?>
<div id="cse" style="width: 100%;"><?php _e('Loading from Google...', 'yotheme'); ?></div>
<script src="http://www.google.com/jsapi" type="text/javascript"></script>
<script type="text/javascript">
  google.load('search', '1', {language : 'zh-CN', style : google.loader.themes.MINIMALIST});
  google.setOnLoadCallback(function() {
    var customSearchControl = new google.search.CustomSearchControl('<?php echo get_option('yotheme_cse');?>');
    customSearchControl.setResultSetSize(google.search.Search.FILTERED_CSE_RESULTSET);
    customSearchControl.draw('cse');
		var match = location.search.match(/s=([^&]*)(&|$)/);
        if(match && match[1]){
            var search = decodeURIComponent(match[1]);
            customSearchControl.execute(search);
        }
  }, true);
</script>
<?php get_footer(); ?>
<?php get_header(); ?>
<div id="wrapper" class="w">
    <div id="settings">
        <div class="setting">
            <div class="sidebar-control"><a href="javascript:;" class="b open" status="open" title="点击关闭">打开</a>侧边栏</div>
        </div>
        <a href="javascript:;" class="setting-button">个性化设置</a>
    </div>
    <h2 class="page-title"><?php printf('搜索 %s', get_search_query()); ?></h2>
    <br class="clr" />
    <div id="container" class="w">
        <section id="page">
            <div id="cse" style="width: 100%;">稍等，正在加载Google搜索...</div>
        </section>
        <aside id="sidebar">
            <?php get_sidebar(); ?>
        </aside>
    </div>
</div>
<script src="http://www.google.com/jsapi" type="text/javascript"></script>
<script type="text/javascript">
  google.load('search', '1', {language : 'zh-CN', style : google.loader.themes.MINIMALIST});
  google.setOnLoadCallback(function() {
    var customSearchControl = new google.search.CustomSearchControl('003073151262632181152:ihdi1gewyla');
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
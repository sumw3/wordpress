<?php get_header(); ?>
<div id="wrapper" class="w">
    <div id="settings">
        <div class="setting">
            <div class="sidebar-control"><a href="javascript:;" class="b open" status="open" title="点击关闭">打开</a>侧边栏</div>
        </div>
        <a href="javascript:;" class="setting-button">个性化设置</a>
    </div>
    <?php echo slogan(); ?>
    <br class="clr" />
    <div id="container" class="w">
        <?php if (have_posts()): ?>
        <section id="page">
            <?php while (have_posts()) : the_post();?>
            <article class="alist">
                <div class="alist-time">
                    <span class="alist-year"><?php the_time('Y'); ?></span>
                    <span class="alist-date"><?php the_time('m'); ?>.<?php the_time('d'); ?></span>
                    <span class="alist-author">By <strong><?php the_author(); ?></strong></span>
                </div>
                <div class="alist-container">
                    <h2 class="alist-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
                    <div class="alist-meta">分类：<?php the_category(', '); ?> <strong>/</strong> <?php 
                    if (!comments_open()) {
                        echo "评论已关闭";
                    } else {
                        comments_popup_link('发表评论','1 条评论','% 条评论');
                    }
                    ?></div>
                    <div class="alist-content"><?php the_content('阅读全文'); ?></div>
            </article>
            <?php endwhile; ?>
            <?php  if ( $wp_query->max_num_pages > 1 ) : ?>
                <nav class="pagenavi">
                <?php par_pagenavi(5); ?>
                </nav>
            <?php endif; ?>
        </section>
        <?php else: ?>
        <div class="err404">
            <h3>哈哈，这儿啥也木有，回<a href="<?php echo home_url(); ?>" title="返回首页">首页</a>看看吧。</h3>
            <p>404</p>
        </div>
        <?php endif; ?>
        <aside id="sidebar">
            <?php get_sidebar(); ?>
        </aside>
        <br class="clr" />
    </div>
</div>
<?php get_footer(); ?>
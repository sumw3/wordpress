<?php
/*
Template Name: archive
*/

  get_header();

/*author:荒野无灯
*URL: http://www.ihacklog.com
*文章存档页面模板
*5:09 2011/9/16 优化：增加缓存，加速显示。
*使用方法：添加页面，选取本模板，内容设置为：

usejs=1;
monthorder=old;
postorder=old;
postcount=1;
commentcount=1;

*/


    class hacklog_archives
{
    // Grab all posts and filter them into an array
    function GetPosts() 
    {
        global  $wpdb;
        
        // If we have a cached copy of the filtered posts array, use that instead
        if ( $posts = wp_cache_get( 'posts', 'ihacklog-clean-archives' ) )
            return $posts;

        // 取得文章ID等
        $query="SELECT DISTINCT ID,post_date,post_date_gmt,comment_count,comment_status,post_password FROM $wpdb->posts WHERE post_type='post' AND post_status = 'publish' AND comment_status = 'open'";
        $rawposts =$wpdb->get_results( $query, OBJECT );

        // Loop through each post and sort it into a structured array
        foreach( $rawposts as $key => $post ) {
            $posts[ mysql2date( 'Y.m', $post->post_date ) ][] = $post;

            $rawposts[$key] = null; // Try and free up memory for users with lots of posts and poor server configs
        }
        $rawposts = null; // More memory cleanup

        // Store the results into the WordPress cache
        wp_cache_set( 'posts', $posts, 'ihacklog-clean-archives' );;

        return $posts;
    }

    // Generates the HTML output based on $atts array from the shortcode
    function PostList( $atts = array() ) 
    {
        global $wp_locale;
        global $hacklog_clean_archives_config;
        global $wpdb;

        $lastpost_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts 
            WHERE post_date <'" . current_time('mysql') . "' 
                AND post_status='publish' 
                    AND post_type='post' 
                        AND post_password='' 
                            ORDER BY post_date DESC LIMIT 1"
        );
        $hacklog_clean_archives_flag = get_option('hacklog_clean_archives_flag', 0 );
        if( !$hacklog_clean_archives_flag )
        {
            add_option('hacklog_clean_archives_flag',$hacklog_clean_archives_flag);
        }
        
        
        //check if there is cached data
        $hacklog_clean_archives_cached_data = get_option('hacklog_clean_archives_cached_data', '' );
        // if there is cached data AND the data has not been expired ,use it
        if(!empty($hacklog_clean_archives_cached_data) && $hacklog_clean_archives_flag == $lastpost_id )
        {
            $html = $hacklog_clean_archives_cached_data;
        }
        else
        {
        // Set any missing $atts items to the defaults
        $atts = shortcode_atts(array(
            'usejs'        => $hacklog_clean_archives_config['usejs'],
            'monthorder'   => $hacklog_clean_archives_config['monthorder'],
            'postorder'    => $hacklog_clean_archives_config['postorder'],
            'postcount'    => '1',
            'commentcount' => '1',
        ), $atts);

        $atts=array_merge(array('usejs'=>1,'monthorder'   =>'new','postorder'    =>'new'),$atts);

            // Get the big array of all posts
            $posts = $this->GetPosts();

        // Sort the months based on $atts
        ( 'new' == $atts['monthorder'] ) ? krsort( $posts ) : ksort( $posts );

        // Sort the posts within each month based on $atts
        foreach( $posts as $key => $month ) {
            $sorter = array();
            foreach ( $month as $post )
                $sorter[] = $post->post_date_gmt;

            $sortorder = ( 'new' == $atts['postorder'] ) ? SORT_DESC : SORT_ASC;

            array_multisort( $sorter, $sortorder, $month );

            $posts[$key] = $month;
            unset($month);
        }


        // Generate the HTML
        $html = '<div class="car-container';
        if ( 1 == $atts['usejs'] ) $html .= ' car-collapse';
        $html .= '">'. "\n";

        if ( 1 == $atts['usejs'] ) $html .= '<a href="#" class="car-toggler">展开所有月份'."</a>\n\n";

        $html .= '<br/><ul class="car-list">' . "\n";

        $firstmonth = TRUE;
        foreach( $posts as $yearmonth => $posts ) {
            list( $year, $month ) = explode( '.', $yearmonth );

            $firstpost = TRUE;
            foreach( $posts as $post ) {
                if ( TRUE == $firstpost ) {
                    $html .= '  <li class="car-monthlist"><span class="car-yearmonth">' . sprintf( __('%1$s %2$d'), $wp_locale->get_month($month), $year );
                    if ( '0' != $atts['postcount'] ) 
                    {
                        if( ( $post_num=count($posts) ) >20 )
                            $html .= ' <span title="文章数量">(共' . $post_num . '篇文章)</span>';
                        else
                            if( $post_num <5 )
                            $html .= ' <span title="文章数量">(共' . $post_num . '篇文章)</span>';
                            else
                                $html .= ' <span title="文章数量">(共' . $post_num . '篇文章)</span>';
                    }
                    $html .= "</span>\n     <ul class='car-monthlisting'>\n";
                    $firstpost = FALSE;
                }

                $html .= '          <li>' .  mysql2date( 'd', $post->post_date ) . '日: <a target="_blank" href="' . get_permalink( $post->ID ) . '">' . get_the_title( $post->ID ) . '</a>';

                // Unless comments are closed and there are no comments, show the comment count
                if ( '0' != $atts['commentcount'] && ( 0 != $post->comment_count || 'closed' != $post->comment_status ) && empty($post->post_password) )
                    $html .= ' <span title="评论数量">(' . $post->comment_count . '条评论)</span>';

                $html .= "</li>\n";
            }

            $html .= "      </ul>\n </li>\n";
        }

        $html .= "</ul>\n</div>\n";
        
        update_option('hacklog_clean_archives_flag', $lastpost_id );
        update_option('hacklog_clean_archives_cached_data', $html );
        }

        return $html;
    }


    // Returns the total number of posts
    function PostCount() 
    {
        $num_posts = wp_count_posts( 'post' );
        return number_format_i18n( $num_posts->publish );
    }

} //end  class hacklog_archives

if(!empty($post->post_content))
{
    $all_config=explode(';',$post->post_content);
    foreach($all_config as $item)
    {
        $temp=explode('=',$item);
        $hacklog_clean_archives_config[trim($temp[0])]=htmlspecialchars(strip_tags(trim($temp[1])));
    }
}
else
{
    $hacklog_clean_archives_config=array('usejs'=>1,'monthorder'   =>'new','postorder'    =>'new'); 
}
$hacklog_archives=new hacklog_archives();
?>
<style type="text/css">.car-list{margin-left: 16px;} .car-yearmonth { cursor: pointer; } .car-monthlisting{margin-left: 24px;} .car-monthlist{margin: 20px 0;}</style>

<section id="body">
	<?php echo $hacklog_archives->PostList();?> 
</section>

<?php
get_sidebar();

function callback($buffer)
{
  $append_js=<<<EOT

    <script type="text/javascript">
        /* <![CDATA[ */
            jQuery(document).ready(function() {
                jQuery('.car-collapse').find('.car-monthlisting').hide();
                jQuery('.car-collapse').find('.car-monthlisting:first').show();
                jQuery('.car-collapse').find('.car-yearmonth').click(function() {
                    jQuery(this).next('ul').slideToggle('fast');
                });
                jQuery('.car-collapse').find('.car-toggler').click(function() {
                    if ( '展开所有月份' == jQuery(this).text() ) {
                        jQuery(this).parent('.car-container').find('.car-monthlisting').show();
                        jQuery(this).text('折叠所有月份');
                    }
                    else {
                        jQuery(this).parent('.car-container').find('.car-monthlisting').hide();
                        jQuery(this).text('展开所有月份');
                    }
                    return false;
                });
            });
        /* ]]> */
    </script>
EOT;
//$buffer=ob_get_contents();
$buffer=str_replace('</body>',$append_js.'</body>',$buffer);
  return $buffer;
}

ob_start("callback");
get_footer();
ob_end_flush();
?>
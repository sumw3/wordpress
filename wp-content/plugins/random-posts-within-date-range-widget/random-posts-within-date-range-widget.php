<?php
/*
	Plugin Name: Random Posts Within Date Range Widget
	Plugin URI: http://alexchalupka.com/projects/wordpress/random-posts-widget/
	Description: Displays random posts from within date range. 
	Author: Alex Chalupka
	Author URI: http://alexchalupka.com/
	Version: 1.2
*/

/*  Copyright 2010  Alex Chalupka  (email : lupka31@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/



/**
 * Adds function to widgets_init so that widget is loaded by WP
 */
add_action( 'widgets_init', 'random_posts_within_date_range_widget' );


/**
 * Registers widget so it is displayed and can be added to sidebars, etc.
 */
function random_posts_within_date_range_widget() {
	register_widget( 'RandomPostsWithinDateRangeWidget' );
}


/**
 * 		Class: RANDOMPOSTSWITHINDATERANGEWIDGET
 *		Random Posts Within Date Range Widget Class using WordPress Widget API
 */
class RandomPostsWithinDateRangeWidget extends WP_Widget
{
  /**
  * 	Function: CONSTRUCTOR
  *		Creates widget with settings.
  */ 
  function RandomPostsWithinDateRangeWidget()
  {
    $widget_options = array('classname' => 'RandomPostsWithinDateRangeWidget', 'description' => 'Displays random posts titles/exerpts from within date range, from all posts or within a given category.' );
    $control_options = array('width' => 300); //to change width
	$this->WP_Widget('RandomPostsWithinDateRangeWidget', 'Random Posts Within Date Range', $widget_options, $control_options);
  }

  /**
  *    Function: FORM
  *	   Displays form to change widget settings. 
  */   
	function form($instance)
	{
		$defaults = array('title' => 'Example',);
		$instance = wp_parse_args( (array) $instance, $defaults ); 

		//break up instance into separate variables for clarity
		$title = $instance['title'];
		$count = $instance['count'];
		$show_date = $instance['show_date'];
		$show_excerpt = $instance['show_excerpt'];
		$excerpt_length = $instance['excerpt_length'];

		$start_month = $instance['start_month'];
		$start_day = $instance['start_day'];
		$start_year = $instance['start_year'];

		$no_end = $instance['no_end'];
		$end_month = $instance['end_month'];
		$end_day = $instance['end_day'];
		$end_year = $instance['end_year'];

		$use_relative = $instance['use_relative'];
		$relative_months = $instance['relative_months'];
		$relative_days = $instance['relative_days'];
		$relative_years = $instance['relative_years'];

		$use_category = $instance['use_category'];
		$category = $instance['category'];
		?>	
		
		<!-- MAIN OPTIONS -->
		<p>Title: <input style="width:250px; float:right; margin-top:-2px; clear:both;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
  	
		<p>Maximum number of Posts to Display:<input style="width:60px; float:right; margin-top:-2px;" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="text" value="<?php echo esc_attr($count); ?>" /></p>
  
		<p style="margin-bottom:0; clear:both;" >
		<span style="margin: 0 10px; display:block; float:right;" ><input type="checkbox" style="margin: 0 4px 4px 4px; float:left;" class="checkbox" id="<?php echo $this->get_field_id('show_date');?>" name="<?php echo $this->get_field_name('show_date'); ?>"<?php checked( (bool) $instance['show_date'], true ); ?> /> Show Date </span>
		<span style="margin: 0 10px; display:block; float:right;" ><input type="checkbox" style="margin: 0 4px 4px 4px; float:left;" class="checkbox" id="<?php echo $this->get_field_id('show_excerpt');?>" name="<?php echo $this->get_field_name('show_excerpt'); ?>"<?php checked( (bool) $instance['show_excerpt'], true ); ?> /> Show Excerpt </span>
		</p>
  
		<p style="margin-top:10px; clear:both;" >Excerpt Length (# of words): <input style="width:100px; float:right; margin-top:-2px;" id="<?php echo $this->get_field_id('excerpt_length'); ?>" name="<?php echo $this->get_field_name('excerpt_length'); ?>" type="text" value="<?php echo esc_attr($excerpt_length); ?>" /></p>
  
		<hr style="margin-bottom:10px; clear:both;" /><!-- DATE OPTIONS -->
		
		<p style="clear:both;"><!-- START DATE -->Start Date:	
			<span id="start-date-entry" style="float:right; margin-top:-3px;">
				
				<select id="<?php echo $this->get_field_id('start_month'); ?>" name="<?php echo $this->get_field_name('start_month'); ?>" > 
						<option value="1" <?php echo ($start_month == 1) ? 'selected' : ''; ?> >January</option> 
						<option value="2" <?php echo ($start_month == 2) ? 'selected' : ''; ?> >February</option> 
						<option value="3" <?php echo ($start_month == 3) ? 'selected' : ''; ?> >March</option> 
						<option value="4" <?php echo ($start_month == 4) ? 'selected' : ''; ?> >April</option> 
						<option value="5" <?php echo ($start_month == 5) ? 'selected' : ''; ?> >May</option> 
						<option value="6" <?php echo ($start_month == 6) ? 'selected' : ''; ?> >June</option> 
						<option value="7" <?php echo ($start_month == 7) ? 'selected' : ''; ?> >July</option> 
						<option value="8" <?php echo ($start_month == 8) ? 'selected' : ''; ?> >August</option> 
						<option value="9" <?php echo ($start_month == 9) ? 'selected' : ''; ?> >September</option> 
						<option value="10" <?php echo ($start_month == 10) ? 'selected' : ''; ?> >October</option> 
						<option value="11" <?php echo ($start_month == 11) ? 'selected' : ''; ?> >November</option> 
						<option value="12" <?php echo ($start_month == 12) ? 'selected' : ''; ?> >December</option> 
				</select> 
				
				<select id="<?php echo $this->get_field_id('start_day'); ?>" name="<?php echo $this->get_field_name('start_day'); ?>" > 
					<?php for($i = 1; $i <= 31; $i++) 
							echo '<option value="'.$i.'" '.(($start_day == $i) ? 'selected' : '').'>'.$i.'</option>';
					?>
				</select> 					
					
				<select id="<?php echo $this->get_field_id('start_year'); ?>" name="<?php echo $this->get_field_name('start_year'); ?>" > 
					<?php for($i = 1970; $i <= (int)date("Y"); $i++) 
							echo '<option value="'.$i.'" '.(($start_year == $i) ? 'selected' : '').'>'.$i.'</option>';
					?>				
				</select> 
				
			</span>
		</p>
		
		<p style="clear:both;"><!-- END DATE -->End Date:
			<span id="end-date-entry" style="float:right; margin-top:-3px;">
				
				<select id="<?php echo $this->get_field_id('end_month'); ?>" name="<?php echo $this->get_field_name('end_month'); ?>" > 
						<option value="1" <?php echo ($end_month == 1) ? 'selected' : ''; ?> >January</option> 
						<option value="2" <?php echo ($end_month == 2) ? 'selected' : ''; ?> >February</option> 
						<option value="3" <?php echo ($end_month == 3) ? 'selected' : ''; ?> >March</option> 
						<option value="4" <?php echo ($end_month == 4) ? 'selected' : ''; ?> >April</option> 
						<option value="5" <?php echo ($end_month == 5) ? 'selected' : ''; ?> >May</option> 
						<option value="6" <?php echo ($end_month == 6) ? 'selected' : ''; ?> >June</option> 
						<option value="7" <?php echo ($end_month == 7) ? 'selected' : ''; ?> >July</option> 
						<option value="8" <?php echo ($end_month == 8) ? 'selected' : ''; ?> >August</option> 
						<option value="9" <?php echo ($end_month == 9) ? 'selected' : ''; ?> >September</option> 
						<option value="10" <?php echo ($end_month == 10) ? 'selected' : ''; ?> >October</option> 
						<option value="11" <?php echo ($end_month == 11) ? 'selected' : ''; ?> >November</option> 
						<option value="12" <?php echo ($end_month == 12) ? 'selected' : ''; ?> >December</option> 
				</select> 
					
				<select id="<?php echo $this->get_field_id('end_day'); ?>" name="<?php echo $this->get_field_name('end_day'); ?>" > 
					<?php for($i = 1; $i <= 31; $i++) 
							echo '<option value="'.$i.'" '.(($end_day == $i) ? 'selected' : '').'>'.$i.'</option>';
					?>				
				</select> 
				
				<select id="<?php echo $this->get_field_id('end_year'); ?>" name="<?php echo $this->get_field_name('end_year'); ?>" > 
					<?php for($i = 1970; $i <= (int)date("Y"); $i++) 
							echo '<option value="'.$i.'" '.(($end_year == $i) ? 'selected' : '').'>'.$i.'</option>';
					?>				
				</select> 

			</span>
		</p>
		
		<p><input style="margin-bottom:0;" style="margin-bottom:4px;" type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('no_end');?>" name="<?php echo $this->get_field_name('no_end'); ?>"<?php checked( (bool) $instance['no_end'], true ); ?> /> Always use current date as end point.</p>

		<!-- NOTE ABOUT DATES - Wordpress/Unix/PHP have problems/inconsistences with old dates. Not sure why anyone would have posts before then anyway -->
		
		<hr/>
		
		<p style="padding-left:0;line-height:10px; font-size:10px;color:#333; text-align:left;"> <b>NOTE:</b> Selecting relative date will override above date settings.</p>
		<p><input style="margin-bottom:4px;"  type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('use_relative');?>" name="<?php echo $this->get_field_name('use_relative'); ?>"<?php checked( (bool) $instance['use_relative'], true ); ?> /> Use time relative to current date.</p>
		<p style="line-height:0px; font-size:10px;color:#333; text-align:right;">Posts from amount of time prior to current date.</p>

		<p style="font-size:11px;">Days:
			<select id="<?php echo $this->get_field_id('relative_days'); ?>" name="<?php echo $this->get_field_name('relative_days'); ?>" > 
				<?php for($i = 0; $i <= 100; $i++) 
						echo '<option value="'.$i.'" '.(($relative_days == $i) ? 'selected' : '').'>'.$i.'</option>';
				?>				
			</select> 
		Months:
			<select id="<?php echo $this->get_field_id('relative_months'); ?>" name="<?php echo $this->get_field_name('relative_months'); ?>" > 
				<?php for($i = 0; $i <= 100; $i++) 
						echo '<option value="'.$i.'" '.(($relative_months == $i) ? 'selected' : '').'>'.$i.'</option>';
				?>				
			</select> 
		Years:
			<select id="<?php echo $this->get_field_id('relative_years'); ?>" name="<?php echo $this->get_field_name('relative_years'); ?>" > 
				<?php for($i = 0; $i <= 100; $i++) 
						echo '<option value="'.$i.'" '.(($relative_years == $i) ? 'selected' : '').'>'.$i.'</option>';
				?>				
			</select> 
		</p>
		
		<hr/><!-- CATEGORY OPTIONS -->
		
		<p><input style="margin-bottom:4px;" type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('use_category');?>" name="<?php echo $this->get_field_name('use_category'); ?>"<?php checked( (bool) $instance['use_category'], true ); ?> /> Choose only from posts in below category.</p>
	
		<p>Category:  <?php wp_dropdown_categories( array( 'name' => $this->get_field_name('category'), 'selected' => $category, 'id' => $this->get_field_id('category') ) ); ?></p>
				
	<?php
	}
	
	/**
	*  	Function: UPDATE
	*	Very straightforward. No special operations needed as of now.
	*/ 
	function update($new_instance, $old_instance)
	{
		return $new_instance;
	}
    
	/**
	*  	Function: WIDGET
	*	Displays the widget based on settings.
	*/  
	function widget($args, $instance)
	{
		//extracts before_widget,before/after_title, etc.
		extract($args, EXTR_SKIP);
	 
		//before_widget stuff (set by theme)
		echo $before_widget;
		
		
		//extract values from $instance (for clarity)
		$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
		$count = $instance['count'];
		$show_date = $instance['show_date'];
		$show_excerpt = $instance['show_excerpt'];
		global $excerpt_length;
		$excerpt_length = $instance['excerpt_length'];
		
		$start_month = $instance['start_month'];
		$start_day = $instance['start_day'];
		$start_year = $instance['start_year'];
		
		$no_end = $instance['no_end'];
		$end_month = $instance['end_month'];
		$end_day = $instance['end_day'];
		$end_year = $instance['end_year'];

		$use_relative = $instance['use_relative'];
		$relative_months = $instance['relative_months'];
		$relative_days = $instance['relative_days'];
		$relative_years = $instance['relative_years'];
		
		$use_category = $instance['use_category'];
		$category = $instance['category'];		
		
		//display title
		if (!empty($title))
		  echo $before_title . $title . $after_title;
			
		//passes instance right into the main function (I want to make this a little smarter in a future version)
		$posts = random_posts_within_date_range($instance);
				
		//change widget length if requested. Otherwise option from WordPress settings is used.
		if($show_excerpt && $excerpt_length)
		{
			if(!is_numeric($excerpt_length))
			{
				echo "Whoa, you entered something for 'excerpt length' that isn't a number. Check your widget settings.";
				echo $after_widget; //end widget to maintain style of rest of page
				return;				
			}
			//had to dynamically create this functions to prevent error with multiple widget instances	
			$filter_exerpt = create_function('$length', 'return '.$excerpt_length.';');
			
			//set filter to temporarily change widget length
			add_filter('excerpt_length', $filter_exerpt);
		}
		
		//list start
		echo '<ul class="random-post-list">';
		
		//loop through posts
		while ( $posts->have_posts() )
		{
			$posts->the_post();		
			?>
			<li class="random-post-element">
			
				<p class="random-post-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></p>
			
				<?php if($show_date) : ?>
				<p class="random-post-date"><?php the_time("F j, Y"); ?></p>
				<? endif; ?>
				
				<?php if($show_excerpt) : ?>
				<span class="random-post-excerpt"><?php the_excerpt(); ?></span>
				<? endif; ?>
						
			</li>
			
		<?php
		}
		
		//remove filter
		if($show_excerpt && $excerpt_length)
			remove_filter('excerpt_length', $filter_exerpt);
		
		//list end
		echo '</ul>';
		
		//after_widget stuff (set by theme)
		echo $after_widget;
	}
}

/**
*  	Function: random_posts_within_date_range
*	Returns: $post variable similar to the result of WP_Query (see plugin documentation for usage info)
*	This function does the dirty work. Is called by the widget, or can be used on its own.
*/ 
function random_posts_within_date_range($settings){

		$count = $settings['count'];
		
		$start_month = $settings['start_month'];
		$start_day = $settings['start_day'];
		$start_year = $settings['start_year'];
		
		$no_end = $settings['no_end'];
		$end_month = $settings['end_month'];
		$end_day = $settings['end_day'];
		$end_year = $settings['end_year'];

		$use_relative = $settings['use_relative'];
		$relative_months = $settings['relative_months'];
		$relative_days = $settings['relative_days'];
		$relative_years = $settings['relative_years'];
		
		$use_category = $settings['use_category'];
		$category = $settings['category'];		
		  
		//skip the rest if count is undefined or 0
		if(!$count || ($count == 0))
		{
			echo "This widget set to display 0 posts. Why do you even need me? Check your widget settings.";
			echo $after_widget; //end widget to maintain style of rest of page
			return;
		}
		
		//if the no end box is checked, set date to current date
		if($no_end)
		{
			$end_month = (int)date("m");
			$end_day = (int)date("d");
			$end_year = (int)date("Y");
		}
		
		//needs to be global for use in filter_where()
		global $start_date,$end_date;			
		
		
		//1 day is added to end_date to ensure that all new posts are used
		if(!$use_relative){
			//check validty of dates
			if(!checkdate($start_month, $start_day, $start_year))
			{
				echo "The start date you entered is invalid. Check your widget/function settings.";
				echo $after_widget; //end widget to maintain style of rest of page
				return;
			}
			if(!checkdate($end_month, $end_day, $end_year))
			{
				echo "The end date you entered is invalid. Check your widget/function settings.";
				echo $after_widget; //end widget to maintain style of rest of page
				return;
			}
			
			//create date variables from strings for comparsion and ease of output - "2008-6-30", etc
			$start_date = strtotime ($start_year."-".$start_month."-".$start_day);
			$end_date = strtotime ($end_year."-".$end_month."-".$end_day." +1 day");
			
			//display error if start date is after end date
			if($start_date > $end_date)
			{
				echo "Whoops! The start date selected falls after the end date. Check your widget settings.";
				echo $after_widget; //end widget to maintain style of rest of page
				return;		
			}
		}
		else{
			$start_date = strtotime ("-$relative_days days -$relative_months months -$relative_years years");
			$end_date = strtotime("+1 day");
		}
		
		/** 
		 * Filter posts by date. Not nearly as simple as it you would think it would be. 
		 * Hack via - http://wordpress.org/support/topic/267931
		 * filters where
		 */
		
		//had to dynamically create this functions to prevent error with multiple widget instances
		$whereq = " AND post_date >= '".date("Y-m-d",$start_date)."' AND post_date <= '".date("Y-m-d",$end_date)."'";	
		$where_func = '$where_query = "'.$whereq.'";'.'$where .= $where_query; return $where;'; 
		$filter_where = create_function('$where', $where_func);
		
		add_filter('posts_where', $filter_where);
		
		//create query
		$query['showposts'] = $count;
		$query['orderby'] = 'rand';
		
		//add category if category box is checked
		if($use_category)
			$query['cat'] = $category;
			
		$posts=new WP_Query($query);
		
		//remove_filter('posts_where', 'filter_where');
		remove_filter('posts_where', $filter_where);
		
		//display HTML comment with info - This is the first place you should look if you're not getting the output you expected 
		$comment = "\n<!-- Random Posts Within Date Range Widget by Alex Chalupka (http://alexchalupka.com)\n";
		$comment .= "Showing up to $count posts ";
		if($use_category)
			$comment .= "in the ".get_cat_name($category)." category ";
		if($no_end)
			$comment .= "between ".date("m/d/Y",$start_date)." and today. -->\n";	
		else if($use_relative)
		{
			$comment .= "in the last ";
			if($relative_days)
				$comment .= "$relative_days days ";
			if($relative_months)
				$comment .= "$relative_months months ";
			if($relative_years)
				$comment .= "$relative_years years ";
			$comment .= " -->\n";
		}
		else
			$comment .= "between ".date("m/d/Y",$start_date)." and ".date("m/d/Y",$end_date)." -->\n";		
		echo $comment;

		return $posts;
		
	}


?>
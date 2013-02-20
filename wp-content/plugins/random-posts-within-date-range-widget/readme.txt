=== Random Posts Within Date Range Widget ===
Contributors: lupka
Donate link: http://alexchalupka.com/donate
Tags: random, posts, widget, categories, date, date range, timeframe, excerpt, randomize, sidebar, category
Requires at least: 2.8.6
Tested up to: 3.0.1
Stable tag: trunk

Widget that displays the title(w/ link), date(optional), and excerpt(optional) of random posts within a selected date range.

== Description ==

This plugin allows you to create a widget that will display the title/date/excerpt from random posts in a specified(or open-ended) date range. It can also be used outside of a widget to create custom loops of random posts within a date range. The following can be specified:

*   Number of posts to display
*   Whether or not to show dates
*   Whether or not to show excerpts
*   Excerpt length (number of words)
*   Start date and End date of posts to randomize
*   Whether or not to always use current date as end. (Allows you to include new posts without editing settings every day)
*   Option to use relative time instead (To chose from random posts from last week, year, etc.)
*   Category to choose posts from. (Example: Random posts from sports category in the past week. This is the original reason I needed a plugin like this. Comes in handy for the newspaper site I run.)

Please contact me if you run into any issues, either via email (lupka31@gmail.com) or Twitter (http://twitter.com/lupka)
For latest FAQs/info visit: http://alexchalupka.com/projects/wordpress/random-posts-widget/

== Installation ==

1. Download, unzip, and upload the `random-posts-within-date-range-widget` folder along with all its files to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Go to the 'Widgets' page under 'Appearance' and drag an instance of the widget into the selected sidebar.
4. Edit settings to meet desired effect.

A few important notes:
*   If you click the "Always use current date as end point" box, it will override the "End Date" settings. (I had fancy JavaScript functions to validate/disable these menus, but ran into issues when running multiple instances of the widget. It's on my to-do list for upcoming versions.)
*   Likewise, if you click the "Use time relative to current date" box, it will override the above date settings.
*   If the "Show Excerpt" box is checked and the post has a manual excerpt, WordPress will output the entire manual excerpt, regardless of what is entered in the "Excerpt Length" box. 
*   If you check the "Show Excerpt" box and leave the "Excerpt Length" box blank or with "0" entered, it will use the default 55 words.

The CSS of the widget can be edited much like any other HTML element. The structure is as follows:

`<li class="random-post-element"> 
<p class="random-post-title"><a href="#">TITLE</a></p> 
<p class="random-post-date">DATE</p> 
<span class="random-post-excerpt>EXCERPT</span> 	
</li>`

Example CSS (used in screenshot):

`.random-post-list {font-family:Arial, sans-serif;}
.random-post-element { margin:5px;}			
.random-post-title {font-size:14px;}
.random-post-title a {color:#000;}
.random-post-title a:hover {text-decoration:none;}
.random-post-date {font-size:12px; color:#333;}
.random-post-excerpt p{font-size:12px;}`

The functionality of this plugin can be accessed outside of the widget with the use of this function:

`random_posts_within_date_range($settings)`

The function returns a post variable similar to that returned by WP_Query(). This allows you to use the_author(), the_content, etc. to create custom loops.

These are the values accepted for the $settings array used for the function (Sorry, it's a little complex, hope to clean this up in the future):

`$settings['count']; //INTEGER - Number of posts to retrieve 

$settings['start_month']; //INTEGER - month of start date (1-12) 
$settings['start_day']; //INTEGER - day of start date (1-31 depending on # of days in month) 
$settings['start_year']; //INTEGER - year of start date (after 1970) 

$settings['no_end']; //BOOLEAN - TRUE to allow current date to always be end, FALSE to use below value as end date
$settings['end_month']; //INTEGER - month of end date (1-12) (only used if 'no_end' is FALSE)
$settings['end_day']; //INTEGER - day of end date (1-31 depending on # of days in month) (only used if 'no_end' is FALSE)
$settings['end_year']; //INTEGER - year of end date (after 1970) (only used if 'no_end' is FALSE)

$settings['use_relative']; //BOOLEAN - TRUE to use relative date (i.e. "posts from the 5 days"), this overrides the above end and start values, FALSE use start and end date values
$settings['relative_months']; //INTEGER - number of months to go back to pull posts (only used if 'use_relative' is TRUE)
$settings['relative_days']; //INTEGER - number of days to go back to pull posts (only used if 'use_relative' is TRUE)
$settings['relative_years']; //INTEGER - number of years to go back to pull posts (only used if 'use_relative' is TRUE)

$settings['use_category']; //BOOLEAN - TRUE to only grab posts from specific category, FALSE to select from all categories
$settings['category']; //INTEGER - ID of category to pull posts from (only used if 'use_category' is TRUE)`

This can then be used as follows:

`<?php $random_posts = random_posts_within_date_range($settings); 

while ( $random_posts->have_posts() ){
	$random_posts->the_post();	?>
	
	<p><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></p>
	<p><?php the_time("F n, Y"); ?></p>
	<p><?php the_excerpt(); ?></p>				
	</li>

	<?php } ?>`

== Frequently Asked Questions ==

= Will you add xxx feature? =

I'm definitely up for adding some more features, but at the same time, I don't want to get away from the primary purpose of this widget. It's easy for this sort of thing to get out of control. No one likes bloated software.

Ideas for new versions are included but not limited to:

* Support for thumbnails
* Ability to select which authors to choose.
* Custom CSS within widget settings box

Let me know what features you'd like to see, and I'll consider adding them. 

== Screenshots ==

1. This is the widget settings box you'll see in your widget admin screen.
2. An example of the plugin in action. Formatting/style can be changed via CSS. Check the installation guide for details.

== Changelog ==

= 1.0 =
* Initial version of the plugin
= 1.1 =
* Adds ability to use random_posts_within_date_range() function to access functionality outide of widgets and create custom loops with random posts.
* Correction of small formatting problems with widget settings page in right-to-left languages.
= 1.1 =
* Fixes small bug with post dates on the widget.

== Upgrade Notice ==

= 1.0 =
* N/A
= 1.1 = 
* Relatively small upgrade, only necessary if you want to use random_posts_within_date_range() function or if you've had problems with the formatting of the widget settings box.
= 1.2 =
* Another small fix. Upgrade only needed if you're using the widget to display post dates.
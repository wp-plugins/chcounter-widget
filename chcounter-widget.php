<?php
/*
Plugin Name: ChCounter Widget
Plugin URI: http://wordpress.org/extend/plugins/chcounter-widget/
Description: Simple plugin to create a widget for the chCounter.
Version: 1.0
Author: Kolja Schleich


Copyright 2007-2008  Kolja Schleich  (email : kolja.schleich@googlemail.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
define('ChCounter_PLUGIN_URI', get_bloginfo('wpurl').'/wp-content/plugins/chcounter-widget');

// Add trailing slash to $_SERVER['DOCUMENT_ROOT'] if it doesn't exist
if ( substr( $_SERVER['DOCUMENT_ROOT'], -1, 1 ) != '/' )
	$_SERVER['DOCUMENT_ROOT'] == $_SERVER['DOCUMENT_ROOT'].'/';

/**
 * chCounterWidget() - Function to display chCounter Widget
 *
 */
function chCounterWidget( $args )
{
	extract( $args );
	$options = get_option( 'chcounter_widget' );
	
	echo '<li id="chcounter"><h2>'.$options['title'].'</h2>';
	if ( file_exists( $_SERVER['DOCUMENT_ROOT'].'chcounter/counter.php' ) ) {
		$counter_template = '';
		if ( 1 == $options['total'] )
			$counter_template .= '<li>{L_TOTAL_VISITORS} {V_TOTAL_VISITORS}</li>';
		if ( 1 == $options['today'] )
			$counter_template .= '<li>{L_VISITORS_TODAY} {V_VISITORS_TODAY}</li>';
		if ( 1 == $options['yesterday'] )
			$counter_template .= '<li>{L_VISITORS_YESTERDAY} {V_VISITORS_YESTERDAY}</li>';
		if ( 1 == $options['max_per_day'] )
			$counter_template .= '<li>{L_MAX_VISITORS_PER_DAY} {V_MAX_VISITORS_PER_DAY}</li>';
		if ( 1 == $options['online'] )
			$counter_template .= '<li>{L_VISITORS_CURRENTLY_ONLINE} {V_VISITORS_CURRENTLY_ONLINE}</li>';
		if ( 1 == $options['max_online'] )
			$counter_template .= '<li>{L_MAX_VISITORS_ONLINE} {V_MAX_VISITORS_ONLINE}</li>';
		if ( 1 == $options['total_page_views'] )
			$counter_template .= '<li>{L_TOTAL_PAGE_VIEWS} {V_TOTAL_PAGE_VIEWS}</li>';
		if ( 1 == $options['total_page_views_this_page'] )
			$counter_template .= '<li>{L_PAGE_VIEWS_THIS_PAGE} {V_PAGE_VIEWS_THIS_PAGE}</li>';
		if ( 1 == $options['per_day'] )
			$counter_template .= '<li>{L_VISITORS_PER_DAY} {V_VISITORS_PER_DAY}</li>';
		if ( 1 == $options['stats'] ) {
			$counter_template .= '<li><a target="_blank" href="{V_COUNTER_URL}/stats/index.php"><img src="{V_COUNTER_URL}/images/stats.png" style="width:15px; height:15px; border: 0px; display: inline; margin-right: 0.5em;" alt="counter" title="{L_STATISTICS}" /></a><a target="_blank" href="{V_COUNTER_URL}/stats/index.php">{L_STATISTICS}</a></li>';
		}
			
		$chCounter_template = <<<TEMPLATE
		<ul>$counter_template</ul>
TEMPLATE;
		include( $_SERVER['DOCUMENT_ROOT'].'chcounter/counter.php' );
	} else {
		echo '<p>'.__( 'It looks like the chCounter is not installed. The Plugin expects chCounter to be installed in /chcounter/', 'chcounter' ).'</p>';
	}
	echo '</li>';	
}

/**
 * chCounterWidgetOptions() - Update Options for the Widget
 *
 * @param string $title Widget Title
 * @param int $online
 * @param int $today
 * @param int $yesterday
 * @param int $max_per_day
 * @param int $max_online
 * @param int $total
 * @param int $stats
 *
 * @return void
 */
function chCounterWidgetSetOptions( $title, $online, $today, $yesterday, $max_per_day, $max_online, $total, $total_page_views, $total_page_views_this_page, $per_day, $stats )
{
	$options = array();
	
	$options['title'] = $title;
	$options['online'] = $online;
	$options['today'] = $today;
	$options['yesterday'] = $yesterday;
	$options['max_per_day'] = $max_per_day;
	$options['max_online'] = $max_online;
	$options['total'] = $total;
	$options['total_page_views'] = $total_page_views;
	$options['total_page_views_this_page'] = $total_page_views_this_page;
	$options['per_day'] = $per_day;
	$options['stats'] = $stats;
	
	update_option( 'chcounter_widget', $options );
	
	return;
}


/**
 * chCounterWidgetControl() - chCounter Widget Options Menu
 *
 * @param none
 * @return void
 */
function chCounterWidgetControl()
{
	$options = get_option( 'chcounter_widget' );
	
 	if ( $_POST['chcounter-submit'] ) {
		$online = ( isset( $_POST['online'] ) ) ? 1 : 0;
		$today = ( isset( $_POST['today'] ) ) ? 1 : 0;
		$yesterday = ( isset( $_POST['yesterday'] ) ) ? 1 : 0;
		$max_per_day = ( isset( $_POST['max_per_day'] ) ) ? 1 : 0;
		$max_online = ( isset( $_POST['max_online'] ) ) ? 1 : 0;
		$total = ( isset( $_POST['total'] ) ) ? 1 : 0;
		$total_page_views = ( isset( $_POST['total_page_views'] ) ) ? 1 : 0;
		$total_page_views_this_page = ( isset( $_POST['total_page_views_this_page'] ) ) ? 1 : 0;
		$per_day = ( isset( $_POST['visitors_per_day'] ) ) ? 1 : 0;
		$stats = ( isset( $_POST['stats'] ) ) ? 1 : 0;
		
		chCounterWidgetSetOptions( $_POST['chCounter_widget_title'], $online, $today, $yesterday, $max_per_day, $max_online, $total, $total_page_views, $total_page_views_this_page, $per_day, $stats );
	}
	
	echo '<p style="text-align: center;">'.__( 'Title', 'chcounter' ).'<input style="margin-left: 1em;" type="text" name="chCounter_widget_title" id="widget_title" value="'.$options['title'].'" size="30" /></p>';
	
	echo '<ul id="chcounter-widget">';
	
	$selected = ( 1 == $options['total'] ) ? ' checked="checked"' : '';
	echo '<li><label for="total" class="chcounter-widget">'.__( 'Total Visitors', 'chcounter' ).'</label><input type="checkbox" name="total" id="total" value="1"'.$selected.' /></li>';
	
	$selected = ( 1 == $options['today'] ) ? ' checked="checked"' : '';
	echo '<li><label for="today" class="chcounter-widget">'.__( 'Visitors today', 'chcounter' ).'</label><input type="checkbox" name="today" id="today" value="1"'.$selected.' /></li>';
	
	$selected = ( 1 == $options['yesterday'] ) ? ' checked="checked"' : '';
	echo '<li><label for="yesterday" class="chcounter-widget">'.__( 'Visitors yesterday', 'chcounter' ).'</label><input type="checkbox" name="yesterday" id="yesterday" value="1"'.$selected.' /></li>';
	
	$selected = ( 1 == $options['max_per_day'] ) ? ' checked="checked"' : '';
	echo '<li><label for="max_per_day" class="chcounter-widget">'.__( 'Max. visitors per day', 'chcounter' ).'</label><input type="checkbox" name="max_per_day" id="max_per_day" value="1"'.$selected.' /></li>';
	
	$selected = ( 1 == $options['online'] ) ? ' checked="checked"' : '';
	echo '<li style="clear: both;"><label for="online" class="chcounter-widget">'.__( 'Curently online', 'chcounter' ).'</label><input type="checkbox" name="online" id="online" value="1"'.$selected.' /></li>';

	$selected = ( 1 == $options['max_online'] ) ? ' checked="checked"' : '';	
	echo '<li><label for="max_online" class="chcounter-widget">'.__( 'Max. online', 'chcounter' ).'</label><input type="checkbox" name="max_online" id="max_online" value="1"'.$selected.' /></li>';

	$selected = ( 1 == $options['total_page_views'] ) ? ' checked="checked"' : '';	
	echo '<li><label for="total_page_views" class="chcounter-widget">'.__( 'Total page views', 'chcounter' ).'</label><input type="checkbox" name="total_page_views" id="total_page_views" value="1"'.$selected.' /></li>';
	
	$selected = ( 1 == $options['total_page_views_this_page'] ) ? ' checked="checked"' : '';	
	echo '<li><label for="total_page_views_this_page" class="chcounter-widget">'.__( 'Page views of this page', 'chcounter' ).'</label><input type="checkbox" name="total_page_views_this_page" id="total_page_views_this_page" value="1"'.$selected.' /></li>';
	
	$selected = ( 1 == $options['per_day'] ) ? ' checked="checked"' : '';
	echo '<li><label for="visitors_per_day" class="chcounter-widget">'.__( 'Visitors per day', 'chcounter' ).'</label><input type="checkbox" name="visitors_per_day" id="visitors_per_day" value="1"'.$selected.' /></li>';
	
	$selected = ( 1 == $options['stats'] ) ? ' checked="checked"' : '';
	echo '<li><label for="stats" class="chcounter-widget">'.__( 'Statistics', 'chcounter' ).'</label><input type="checkbox" name="stats" id="stats" value="1"'.$selected.' /></li>';
	
	echo '</ul>';

	echo '<input type="hidden" name="chcounter-submit" id="chcounter-submit" value="1" />';
	
	return;
}


/**
 * chCounterWidgetInit() - Plugin Initialization
 *
 * @param none
 * @return void
 */
function chCounterWidgetInit()
{
	register_sidebar_widget( 'chCounter', 'chCounterWidget' );
	register_widget_control( 'chCounter', 'chCounterWidgetControl', 500, 200 );
	
	$options = array();
	
	$options['online'] = 1;
	$options['today'] = 1;
	$options['yesterday'] = 1;
	$options['max_per_day'] = 1;
	$options['max_online'] = 1;
	$options['total'] = 1;
	$options['stats'] = 1;
	$options['total_page_views'] = 1;
	$options['total_page_views_this_page'] = 1;
	$options['per_day'] = 1;
	
	add_option( 'chcounter_widget', $options, 'chCounter Widget Options', 'yes' );
	
	return;
}

/**
 * chCounterWidgetAddHeaderCode() - Add Code to Wordpress Header
 *
 * @param none
 */
 function chCounterWidgetAddHeaderCode()
 {
	echo "\n\n<!-- chCounter Widget START -->\n";
	echo "<link rel='stylesheet' href='".ChCounter_PLUGIN_URI."/style.css' type='text/css' />\n";
	echo "<!-- chCounter Widget END -->\n\n";
 }

load_plugin_textdomain( 'chcounter', $path = 'wp-content/plugins/chcounter-widget' );
 
add_action( 'plugins_loaded', 'chCounterWidgetInit' );
add_action( 'admin_head', 'chCounterWidgetAddHeaderCode' );
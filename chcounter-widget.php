<?php
/*
Plugin Name: ChCounter Widget
Plugin URI: http://wordpress.org/extend/plugins/chcounter-widget/
Description: Simple plugin to create a widget for the chCounter.
Version: 1.1.3
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

// Add trailing slash to $_SERVER['DOCUMENT_ROOT'] if it doesn't exist
if ( substr( $_SERVER['DOCUMENT_ROOT'], -1, 1 ) != '/' )
	$_SERVER['DOCUMENT_ROOT'] == $_SERVER['DOCUMENT_ROOT'].'/';

/**
 * chcounter_widget_get_parameters()  - Wrapper function to get available parameters to display
 *
 * @param none
 * @return array
 */
function chcounter_widget_get_parameters()
{
	$params = array();
	$params["total"] = array( "admin_label" => "Total Visitors", "counter_label" =>  "{L_TOTAL_VISITORS}", "counter_value" => "{V_TOTAL_VISITORS}" );
	$params["today"] = array( "admin_label" => "Visitors today", "counter_label" => "{L_VISITORS_TODAY}", "counter_value" => "{V_VISITORS_TODAY}" );
	$params["yesterday"] = array( "admin_label" => "Visitors yesterday", "counter_label" => "{L_VISITORS_YESTERDAY}", "counter_value" => "{V_VISITORS_YESTERDAY}" );
	$params["max_per_day"] = array( "admin_label" => "Max. visitors per day", "counter_label" => "{L_MAX_VISITORS_PER_DAY}", "counter_value" => "{V_MAX_VISITORS_PER_DAY}" );
	$params["online"] = array( "admin_label" => "Curently online", "counter_label" => "{L_VISITORS_CURRENTLY_ONLINE}", "counter_value" => "{V_VISITORS_CURRENTLY_ONLINE}" );
	$params["max_online"] = array( "admin_label" => "Max. online", "counter_label" => "{L_MAX_VISITORS_ONLINE}", "counter_value" => "{V_MAX_VISITORS_ONLINE}" );
	$params["total_page_views"] = array( "admin_label" => "Total page views", "counter_label" => "{L_TOTAL_PAGE_VIEWS}", "counter_value" => "{V_TOTAL_PAGE_VIEWS}" );
	$params["total_page_views_this_page"] = array( "admin_label" => "Page views of current page", "counter_label" => "{L_PAGE_VIEWS_THIS_PAGE}", "counter_value" => "{V_PAGE_VIEWS_THIS_PAGE}" );
	$params["per_day"] = array( "admin_label" => "Visitors per day", "counter_label" => "{L_VISITORS_PER_DAY}", "counter_value" => "{V_PAGE_VIEWS_THIS_PAGE}" );
	$params["stats"] = array( "admin_label" => "Statistics", "counter_label" => "{L_STATISTICS}", "counter_value" => "{V_COUNTER_URL}" );

	return $params;
}


/**
 * chcounter_widget() - Function to display chCounter Widget
 *
 * @param none
 * @return void
 */
function chcounter_widget( $args )
{
	extract( $args );
	$options = get_option( 'chcounter_widget' );
	$params = chcounter_widget_get_parameters();
	
	echo '<li id="chcounter"><h2>'.$options['title'].'</h2>';
	if ( file_exists( $_SERVER['DOCUMENT_ROOT'].$options['chcounter_path'].'/counter.php' ) ) {
		$counter_template = '';
		//sort( $options['order'] );
		foreach ( $options['order'] AS $order => $param ) {
			if ( 1 == $options[$param] ) {
				if ( 'stats' == $param )
					$counter_template .= '<li><a target="_blank" href="'.$params['stats']['counter_value'].'/stats/index.php"><img src="'.$params['stats']['counter_value'].'/images/stats.png" style="width:15px; height:15px; border: 0px; display: inline; margin-right: 0.5em;" alt="counter" title="'.$params['stats']['counter_label'].'" /></a><a target="_blank" href="'.$params['stats']['counter_value'].'/stats/index.php">'.$params['stats']['counter_label'].'</a></li>';
				else
					$counter_template .= '<li>'.$params[$param]['counter_label'].' '.$params[$param]['counter_value'].'</li>';
			}
		}
		
		$chCounter_template = <<<TEMPLATE
		<ul>$counter_template</ul>
TEMPLATE;
		include( $_SERVER['DOCUMENT_ROOT'].$options['chcounter_path'].'/counter.php' );
	} else {
		echo '<p>'.__( 'Could not find the chcounter installation. Please check your settings.', 'chcounter' ).'</p>';
	}
	echo '</li>';

	return;
}


/**
 * chcounter_widget_settings() - chCounter Widget Settings Page
 *
 * @param none
 * @return void
 */
function chcounter_widget_options_page()
{
	$options = get_option( 'chcounter_widget' );
	$params = chcounter_widget_get_parameters();
	$i = 1;
	
 	if ( isset( $_POST['update_chcounter'] ) ) {	
		if ( 'update_options' == $_POST['update_chcounter'] ) {
			//$options['title'] = $_POST['chCounter_widget_title'];
			$options['chcounter_path'] = $_POST['chcounter_widget_path'];
			$options['uninstall'] = isset( $_POST['chcounter_widget_uninstall'] ) ? 1 : 0;
			foreach ( $params AS $param => $data ) {
				$options[$param] = isset( $_POST[$param] ) ? 1 : 0;
				$options['order'][$_POST['order'][$param]] = $param;
			}
			
			update_option( 'chcounter_widget', $options );
			
			$return_message = !isset( $_POST['chcounter_widget_uninstall'] ) ? 'Settings saved' : 'Settings saved. The uninstall options has been checked. If you deactivate the plugin now all plugin data will be removed from the database';
			echo '<div id="message" class="updated fade"><p><strong>'.__( $return_message, 'chcounter').'</strong></p></div>';
		}
	}
	
	echo '<div class="wrap">';
	echo '	<h2>'.__( 'chCounter Widget Settings', 'chcounter' ).'</h2>';
	
	echo '<form action="options-general.php?page=chcounter-widget.php" method="post">';
		
	echo '<h3>'.__( 'General Settings', 'chcounter' ).'</h3>';
	echo '	<p><label for="chcounter_widget_path" style="font-weight: bold;">'.__( 'chCounter Path', 'chcounter' ).':</label> '.$_SERVER['DOCUMENT_ROOT'].'<input type="text" name="chcounter_widget_path" id="chcounter_widget_path" value="'.$options['chcounter_path'].'" size="20" /> '.__( 'without trailing slash', 'chcounter' ).'</p>';
	
	echo '<h3>'.__( 'Parameters', 'chcounter' ).'</h3>';
	echo '<div id="chcounter_widget_parameters" class="narrow">';
	echo '	<ul id="chcounter_widget">';
	foreach( $options['order'] AS $order => $param ) {
		$i++;
		$class = ( 'alternate' == $class ) ? '' : 'alternate';
		$selected[$param] = ( 1 == $options[$param] ) ? ' checked="checked"' : '';
		echo '<li><label for="'.$param.'" class="chcounter-widget">'.__( $params[$param]['admin_label'], 'chcounter' ).'</label><input type="checkbox" name="'.$param.'" id="'.$param.'" value="1"'.$selected[$param].' /><input type="text" name="order['.$param.']" value="'.$order.'" size="1" /></li>';
	}
	echo '	</ul>';
	echo '</div>';
	

	$selected_uninstall = ( isset($options['uninstall']) AND 1 == $options['uninstall'] ) ? " checked = 'checked'" : '';
	echo '	<h3>'.__( 'Uninstall chCounter Widget', 'chcounter' ).'</h3>';
	echo '	<p>'.__( '<strong>Attention:</strong> All data created by the plugin will be removed from the database if you uninstall the plugin.', 'chcounter' ).'</p>';
	echo '	<p><label for="chcounter_widget_uninstall">'.__( 'Yes, I want to uninstall chCounter Widget', 'chcounter').'</label> <input type="checkbox" name="chcounter_widget_uninstall" id="chcounter_widget_uninstall" value="1"'.$selected_uninstall.'/> </p>';
	echo '	<input type="hidden" name="update_chcounter" id="chcounter-submit" value="update_options" />';
	echo '	<p class="submit"><input type="submit" name="updateSettings" value="'.__( 'Save Settings', 'chcounter' ) .'&raquo;" class="button" /></p>';
	
	echo '	</form>';

	echo '</div>';
	
	return;
}


/**
 * chcounter_widget_control() - Control Panel for the widget
 *
 * @param none
 * @return void
 */
function chcounter_widget_control()
{
	$options = get_option( 'chcounter_widget' );
	if ( $_POST['chcounter-submit'] ) {	
		$options['title'] = $_POST['chCounter_widget_title'];
		update_option( 'chcounter_widget', $options );
	}
	echo '<p style="text-align: left;">'.__( 'Title', 'chcounter' ).': <input type="text" name="chCounter_widget_title" id="widget_title" value="'.$options['title'].'" size="30" /></p>';
	echo '<input type="hidden" name="chcounter-submit" id="chcounter-submit" value="1" />';
	
	return;
}


/**
 * chcounter_widget_init() - Plugin Initialization
 *
 * @param none
 * @return void
 */
function chcounter_widget_init()
{
	$params = chcounter_widget_get_parameters();
	
	register_sidebar_widget( 'chCounter', 'chcounter_widget' );
	register_widget_control( 'chCounter', 'chcounter_widget_control', 250, 100 );
	
	$options = array();
	$options['title'] = '';
	$i = 1;
	foreach ( $params AS $param => $data ) {
		$options[$param] = 1;
		$options['order'][$i] = $param;
		$i++;
	}

	add_option( 'chcounter_widget', $options, 'chCounter Widget Options', 'yes' );
	
	return;
}


/**
 * chcounter_widget_add_admin_menu() - Add Options Menu to the Web Interface
 *
 * @param none
 * @return void
 */
function chcounter_widget_admin_menu()
{
	if (function_exists('add_options_page')) {
		add_options_page(__( 'chCounter Widget', 'chcounter' ), __( 'chCounter Widget', 'chcounter' ), 8, basename(__FILE__), 'chcounter_widget_options_page');
	}
}


/**
 * chcounter_widget_deactivation() - Checks if uninstall option is set and maybe deletes plugin options
 *
 * @param none
 * @return void
 */
function chcounter_widget_deactivation()
{
	$options = get_option( 'chcounter_widget' );
	if ( isset($options['uninstall']) AND 1 == $options['uninstall'] )
		delete_option( 'chcounter_widget' );
}


/**
 * chcounter_widget_add_header_code() - Add Code to Wordpress Header
 *
 * @param none
 */
 function chcounter_widget_css()
 {
	echo "\n\n<!-- chCounter Widget START -->\n";
	echo "<link rel='stylesheet' href='".get_bloginfo('wpurl')."/wp-content/plugins/chcounter-widget/style.css' type='text/css' />\n";
	echo "<!-- chCounter Widget END -->\n\n";
 }

add_action( 'plugins_loaded', 'chcounter_widget_init' );
add_action( 'deactivate_chcounter-widget/chcounter-widget.php', 'chcounter_widget_deactivation' );
add_action( 'admin_head', 'chcounter_widget_css' );
add_action( 'admin_menu', 'chcounter_widget_admin_menu' );

load_plugin_textdomain( 'chcounter', $path = 'wp-content/plugins/chcounter-widget' );
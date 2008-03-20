<?php
/*
Plugin Name: ChCounter Widget
Plugin URI: http://wordpress.org/extend/plugins/chcounter-widget/
Description: Simple plugin to create a widget for the chCounter.
Version: 2.1
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

class chCounterWidget
{
	/**
	 * Plugin Version
	 *
	 * @var string
	 */
	var $version = '2.1';
	
	/**
	 * Array of available parameters
	 *
	 * @var array
	 */
	 var $params = array();
	 
	/**
	 * path to the plugin
	 *
	 * @var string
	 */
	 var $plugin_url;
	  
	 
	/**
	 * __construct() - Initialize available parameters
	 *
	 * @param none
	 * @return void
	 */
	function __construct()
	{
		// Add trailing slash to $_SERVER['DOCUMENT_ROOT'] if it doesn't exist
		if ( substr($_SERVER['DOCUMENT_ROOT'], -1, 1) != '/' )
			$_SERVER['DOCUMENT_ROOT'] == $_SERVER['DOCUMENT_ROOT'].'/';
		
		$this->plugin_url = get_bloginfo('wpurl')."/wp-content/plugins/chcounter-widget";

		$params = array();
		$params["total"] = array("admin_label" => "Total Visitors", "counter_label" =>  "{L_TOTAL_VISITORS}", "counter_value" => "{V_TOTAL_VISITORS}");
		$params["today"] = array("admin_label" => "Visitors today", "counter_label" => "{L_VISITORS_TODAY}", "counter_value" => "{V_VISITORS_TODAY}");
		$params["yesterday"] = array("admin_label" => "Visitors yesterday", "counter_label" => "{L_VISITORS_YESTERDAY}", "counter_value" => "{V_VISITORS_YESTERDAY}");
		$params["maxperday"] = array("admin_label" => "Max. visitors per day", "counter_label" => "{L_MAX_VISITORS_PER_DAY}", "counter_value" => "{V_MAX_VISITORS_PER_DAY}");
		$params["online"] = array("admin_label" => "Curently online", "counter_label" => "{L_VISITORS_CURRENTLY_ONLINE}", "counter_value" => "{V_VISITORS_CURRENTLY_ONLINE}");
		$params["maxonline"] = array("admin_label" => "Max. online", "counter_label" => "{L_MAX_VISITORS_ONLINE}", "counter_value" => "{V_MAX_VISITORS_ONLINE}");
		$params["totalpageviews"] = array("admin_label" => "Total page views", "counter_label" => "{L_TOTAL_PAGE_VIEWS}", "counter_value" => "{V_TOTAL_PAGE_VIEWS}");
		$params["totalpageviewsthispage"] = array("admin_label" => "Page views of current page", "counter_label" => "{L_PAGE_VIEWS_THIS_PAGE}", "counter_value" => "{V_PAGE_VIEWS_THIS_PAGE}");
		$params["perday"] = array("admin_label" => "Visitors per day", "counter_label" => "{L_VISITORS_PER_DAY}", "counter_value" => "{V_PAGE_VIEWS_THIS_PAGE}");
		$params["stats"] = array("admin_label" => "Statistics", "counter_label" => "{L_STATISTICS}", "counter_value" => "{V_COUNTER_URL}");

		$this->params = $params;

		return;
	}
	function chCounterWidget()
	{
		$this->__construct();
	}


	/**
	 * get_parameters()  - get available parameters to display
	 *
	 * @param none
	 * @return array
	 */
	function get_parameters()
	{
		return $this->params;
	}

	
	/**
	 * display() - Function to display chCounter Widget
	 *
	 * @param none
	 * @return void
	 */
	function display($args)
	{
		if ( is_string($args) )
			parse_str($args, $args);

		$options = get_option('chcounter_widget');
		$params = $this->get_parameters();

		$defaults = array(
			'before_widget' => '<li id="chcounter" class="widget '.get_class($this).'_'.__FUNCTION__.'">',
			'after_widget' => '</li>',
			'before_title' => '<h2 class="widgettitle">',
			'after_title' => '</h2>',
			'widget_title' => $options['title']
		);
		
		$args = array_merge($defaults, $args);
		extract($args);
			
		if ( file_exists($_SERVER['DOCUMENT_ROOT'].$options['chcounter_path'].'/counter.php') ) {
			if ( 0 == $options['invisible'] ) {
				echo $before_widget . $before_title . $widget_title . $after_title;
				$counter_template = '';
				
				if ( count( $options['params']['active'] ) > 0 ) {
					foreach ( $options['params']['active'] AS $order => $param ) {
						if ( 'stats' == $param )
							$counter_template .= "<li><a target='_blank' href='".$params['stats']['counter_value']."/stats/index.php'><img src='".$params['stats']['counter_value']."/images/stats.png' style='width:15px; height:15px; border: 0px; display: inline; margin-right: 0.5em;' alt='counter' title='".$params['stats']['counter_label']."' /></a><a target='_blank' href='".$params['stats']['counter_value']."/stats/index.php'>".$params['stats']['counter_label']."</a></li>";
						else
							$counter_template .= "<li>".$params[$param]['counter_label']." ".$params[$param]['counter_value']."</li>";
					}
				}
				
				$chCounter_template = <<<TEMPLATE
				<ul>$counter_template</ul>
TEMPLATE;
				include_once($_SERVER['DOCUMENT_ROOT'].$options['chcounter_path'].'/counter.php');
				echo $after_widget;
			} else {
				$chCounter_visible = 0;
				include_once($_SERVER['DOCUMENT_ROOT'].$options['chcounter_path'].'/counter.php');
			}
		} else {
			echo $before_widget . $before_title . __('chCounter Error', 'chcounter') .$after_title.__('Could not find the chcounter installation. Please check your settings.', 'chcounter').$after_widget;
		}
			
		return;
	}


	/**
	 * display_options_page() - chCounter Widget Settings Page
	 *
	 * @param none
	 * @return void
	 */
	function display_options_page()
	{
		$params = $this->get_parameters();
		$options = get_option('chcounter_widget');
		
		if ( isset($_POST['update_chcounter']) ) {	
			if ( 'update_options' == $_POST['update_chcounter'] ) {
				$options['chcounter_path'] = $_POST['chcounter_widget_path'];
				$options['uninstall'] = isset( $_POST['chcounter_widget_uninstall'] ) ? 1 : 0;
				$options['invisible'] = isset( $_POST['chcounter_widget_invisible'] ) ? 1 : 0;
				$options['params']['available'] = $this->get_order($_POST['chcounter_widget_available_order'], 'chcounter_available');
				$options['params']['active'] = $this->get_order($_POST['chcounter_widget_active_order'], 'chcounter_active');
				
	
				update_option('chcounter_widget', $options);
				
				$return_message = !isset( $_POST['chcounter_widget_uninstall'] ) ? 'Settings saved' : 'Settings saved. The uninstall options has been checked. If you deactivate the plugin now all plugin data will be removed from the database';
				echo '<div id="message" class="updated fade"><p><strong>'.__($return_message, 'chcounter').'</strong></p></div>';
			}
		}
		
		include 'settings.php';
	}


	/**
	 * get_order() - Get Order of parameters
	 *
	 * @param string $input serialized string with order
	 * @return array
	 */
 	function get_order($input, $listname)
	{
		parse_str($input, $input_array);
		$input_array = $input_array[$listname];
		$order_array = array();
		for ( $i = 0; $i < count($input_array); $i++ ) {
			if ( $input_array[$i] != '' )
				$order_array[$i+1] = $input_array[$i];
		}
		return $order_array;	
	}


	/**
	 * widget_control() - Control Panel for the widget
	 *
	 * @param none
	 * @return void
	 */
	function widget_control()
	{
		$options = get_option('chcounter_widget');
		if ( $_POST['chcounter-submit'] ) {
			$options['title'] = $_POST['chCounter_widget_title'];
			update_option('chcounter_widget', $options);
		}
		echo '<p style="text-align: left;">'.__('Title', 'chcounter').': <input type="text" name="chCounter_widget_title" id="widget_title" value="'.$options['title'].'" size="30" /></p>';
		echo '<input type="hidden" name="chcounter-submit" id="chcounter-submit" value="1" />';
		
		return;
	}


	/**
	 * init() - Plugin Initialization
	 *
	 * @param none
	 * @return void
	 */
	function init()
	{
		$params = $this->get_parameters();
		
		if ( function_exists("register_sidebar_widget") && function_exists("register_widget_control") ) {
			register_sidebar_widget('chCounter', array(&$this, 'display'));
			register_widget_control('chCounter', array(&$this, 'widget_control'), 250, 100);
		}
		
		$options = array();
		$options['title'] = '';
		$options['invisible'] = 1;
		foreach ( $params AS $param => $data ) {
			$options['params']['available'][] = $param;
			$options['params']['active'] = array();
		}
	
		add_option('chcounter_widget', $options, 'chCounter Widget Options', 'yes');
		
		return;
	}


	/**
	 * deactivate() - Checks if uninstall option is set and maybe deletes plugin options
	 *
	 * @param none
	 * @return void
	 */
	function deactivate()
	{
		$options = get_option('chcounter_widget');
 		if ( isset($options['uninstall']) AND 1 == $options['uninstall'] )
			delete_option('chcounter_widget');
	}


	/**
	 * add_header_code() - Add Code to Wordpress Header
	 *
	 * @param none
	 */
	function add_header_code()
	{
		echo "\n\n<!-- chCounter Widget START -->\n";
		echo "<link rel='stylesheet' href='".$this->plugin_url."/style.css' type='text/css' />\n";
		wp_register_script('chcounter', $this->plugin_url.'/chcounter.js', array('prototype', 'scriptaculous'), '1.0');
		wp_print_scripts('chcounter');
		echo "<!-- chCounter Widget END -->\n\n";
	}
	

	/**
	 * add_admin_menu() - Add Options Menu to the Web Interface
	 *
	 * @param none
	 * @return void
	 */
	function add_admin_menu()
	{
		add_options_page(__('chCounter Widget', 'chcounter'), __('chCounter Widget', 'chcounter'), 8, basename(__FILE__), array(&$this, 'display_options_page'));
	}
}


$chcounter_widget = new chCounterWidget();

if ( isset($chcounter_widget) ) {
	add_action('plugins_loaded', array($chcounter_widget, 'init'));
	add_action('deactivate_chcounter-widget/chcounter-widget.php', array($chcounter_widget, 'deactivate'));
	add_action('admin_head', array($chcounter_widget, 'add_header_code'));
	add_action('admin_menu', array($chcounter_widget, 'add_admin_menu'));
	
	load_plugin_textdomain('chcounter', $path = 'wp-content/plugins/chcounter-widget');
}

/**
 * Wrapper function to display chCounter Widget statically
 *
 * @param string/array $args
 */
 function chcounter_widget_display($args = array())
 {
 	global $chcounter_widget;
	$chcounter_widget->display($args);
 }

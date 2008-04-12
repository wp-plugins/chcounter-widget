<?php
/*
Plugin Name: ChCounter Widget
Plugin URI: http://wordpress.org/extend/plugins/chcounter-widget/
Description: Integrate chCounter into Wordpress as widget.
Version: 2.2
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
	var $version = '2.2';
	
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
	 * Initialize available parameters
	 *
	 * @param none
	 * @return void
	 */
	function __construct()
	{
		// Add trailing slash to $_SERVER['DOCUMENT_ROOT'] if it doesn't exist
		if ( substr($_SERVER['DOCUMENT_ROOT'], -1, 1) != '/' )
			$_SERVER['DOCUMENT_ROOT'] == $_SERVER['DOCUMENT_ROOT'].'/';
		
		//$this->plugin_url = get_bloginfo( 'wpurl' )."/".PLUGINDIR."/chcounter-widget";
		$this->plugin_url = get_bloginfo( 'wpurl' )."/".PLUGINDIR.'/'.basename(__FILE__, ".php");

		$params = array();
		$params["total"] = array( "admin_label" => "Total Visitors", "counter_label" =>  "{L_TOTAL_VISITORS}", "counter_value" => "{V_TOTAL_VISITORS}" );
		$params["today"] = array( "admin_label" => "Visitors today", "counter_label" => "{L_VISITORS_TODAY}", "counter_value" => "{V_VISITORS_TODAY}" );
		$params["yesterday"] = array( "admin_label" => "Visitors yesterday", "counter_label" => "{L_VISITORS_YESTERDAY}", "counter_value" => "{V_VISITORS_YESTERDAY}" );
		$params["maxperday"] = array( "admin_label" => "Max. visitors per day", "counter_label" => "{L_MAX_VISITORS_PER_DAY}", "counter_value" => "{V_MAX_VISITORS_PER_DAY}" );
		$params["online"] = array( "admin_label" => "Curently online", "counter_label" => "{L_VISITORS_CURRENTLY_ONLINE}", "counter_value" => "{V_VISITORS_CURRENTLY_ONLINE}" );
		$params["maxonline"] = array( "admin_label" => "Max. online", "counter_label" => "{L_MAX_VISITORS_ONLINE}", "counter_value" => "{V_MAX_VISITORS_ONLINE}" );
		$params["totalpageviews"] = array( "admin_label" => "Total page views", "counter_label" => "{L_TOTAL_PAGE_VIEWS}", "counter_value" => "{V_TOTAL_PAGE_VIEWS}" );
		$params["totalpageviewsthispage"] = array( "admin_label" => "Page views of current page", "counter_label" => "{L_PAGE_VIEWS_THIS_PAGE}", "counter_value" => "{V_PAGE_VIEWS_THIS_PAGE}" );
		$params["perday"] = array( "admin_label" => "Visitors per day", "counter_label" => "{L_VISITORS_PER_DAY}", "counter_value" => "{V_PAGE_VIEWS_THIS_PAGE}" );
		$params["stats"] = array( "admin_label" => "Statistics", "counter_label" => "{L_STATISTICS}", "counter_value" => "{V_COUNTER_URL}" );

		$this->params = $params;

		return;
	}
	function chCounterWidget()
	{
		$this->__construct();
	}


	/**
	 * gets available parameters to display
	 *
	 * @param none
	 * @return array
	 */
	function getParameters()
	{
		return $this->params;
	}

	
	/**
	 * displays chCounter Widget
	 *
	 * @param array $args
	 * @return void
	 */
	function display($args)
	{
		if ( is_string($args) )
			$args = array( 'widget_title' => $args );
			
		$options = get_option( 'chcounter_widget' );
		$params = $this->getParameters();

		$defaults = array(
			'before_widget' => '<li id="chcounter" class="widget '.get_class($this).'_'.__FUNCTION__.'">',
			'after_widget' => '</li>',
			'before_title' => '<h2 class="widgettitle">',
			'after_title' => '</h2>',
			'widget_title' => $options['title']
		);
		
		$args = array_merge( $defaults, $args );
		extract( $args );
			
		if ( file_exists($_SERVER['DOCUMENT_ROOT'].$options['chcounter_path'].'/counter.php') ) {
			if ( 0 == $options['invisible'] ) {
				echo $before_widget . $before_title . $widget_title . $after_title;
				$counter_template = '';
				
				if ( count($options['params']['active']) > 0 ) {
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
			echo $before_widget . $before_title . __( 'chCounter Error', 'chcounter' ) .$after_title.__( 'Could not find the chcounter installation. Please check your settings.', 'chcounter' ).$after_widget;
		}
			
		return;
	}


	/**
	 * displays options page
	 *
	 * @param none
	 * @return void
	 */
	function displayOptionsPage()
	{
		$params = $this->getParameters();
		$options = get_option( 'chcounter_widget' );
		
		if ( isset($_POST['update_chcounter']) ) {	
			if ( 'update_options' == $_POST['update_chcounter'] ) {
				$options['chcounter_path'] = $_POST['chcounter_widget_path'];
				$options['invisible'] = isset( $_POST['chcounter_widget_invisible'] ) ? 1 : 0;
				$options['params']['available'] = $this->getOrder($_POST['chcounter_widget_available_order'], 'chcounter_available');
				$options['params']['active'] = $this->getOrder($_POST['chcounter_widget_active_order'], 'chcounter_active');
				
				update_option('chcounter_widget', $options);

				echo '<div id="message" class="updated fade"><p><strong>'.__( 'Settings saved', 'chcounter' ).'</strong></p></div>';
			}
		}
		
		?>
		<div class='wrap'>
			<h2><?php _e( 'chCounter Widget Settings', 'chcounter' ) ?></h2>
				
			<form action='options-general.php?page=chcounter-widget.php' method='post' onSubmit="populateHiddenVars();">
					
				<h3><?php _e( 'General Settings', 'chcounter' ) ?></h3>
				<p><label for='chcounter_widget_path'><?php _e( 'chCounter Path', 'chcounter' ) ?>: </label><?php echo $_SERVER['DOCUMENT_ROOT'] ?><input type='text' name='chcounter_widget_path' id='chcounter_widget_path' value='<?php echo $options['chcounter_path'] ?>' size='20' /><?php _e( 'without trailing slash', 'chcounter' ) ?></p>
				
				<?php $selected_invisible = ( 1 == $options['invisible'] ) ? " checked = 'checked'" : ''; ?>
				<p><label for='chcounter_widget_invisible'><?php _e( 'Make chCounter Invisible', 'chcounter' ) ?></label> <input type="checkbox" name="chcounter_widget_invisible" id="chcounter_widget_invisible"<?php echo $selected_invisible ?>/></p>
					
				<h3><?php _e( 'Parameters', 'chcounter' ) ?></h3>
				<div id="chcounter_available_box" class='chcounter_widget_parameters narrow'>
					<h4><?php _e( 'Available', 'chcounter' ) ?></h4>
					<ol class='chcounter_widget' id='chcounter_available'>
						<?php if ( count($options['params']['available']) > 0 ) : ?>
						<?php foreach ( $options['params']['available'] AS $order => $param ) : ?>
						<li id='param_<?php echo $param ?>'><?php _e( $params[$param]['admin_label'], 'chcounter' ) ?></li>
						<?php endforeach; ?>
						<?php endif; ?>
					</ol>
							
					<span class="handle" id="chcounter_handle_available"><?php _e( 'You see this message, because all parameters have been activated. To deactivate certain parameters simply drag & drop them into this box', 'chcounter' ) ?></span>
					<input type="hidden" name="chcounter_widget_available_order" id="chcounter_widget_available_order" />
				</div>
				<div id="chcounter_active_box" class='chcounter_widget_parameters narrow'>
					<h4><?php _e( 'Active', 'chcounter' ) ?></h4>
							
					<ol class='chcounter_widget' id='chcounter_active'>
						<?php if ( count($options['params']['active']) > 0 ) : ?>
						<?php foreach ( $options['params']['active'] AS $order => $param ) : ?>
						<li id='param_<?php echo $param ?>'><?php _e( $params[$param]['admin_label'], 'chcounter' ) ?></li>
						<?php endforeach; ?>
						<?php endif; ?>
					</ol>
							
					<span class="handle" id="chcounter_handle_active"><?php _e( 'You see this message, because no parameters have been activated yet. You can create your chCounter Display via drag & drop into this box', 'chcounter' ) ?></span>
					<input type="hidden" name="chcounter_widget_active_order" id="chcounter_widget_active_order" />
				</div>
					
				<br style="clear: both;" />
				<input type="hidden" name="update_chcounter" id="chcounter-submit" value="update_options" />
				<p class="submit"><input type="submit" name="updateSettings" value="<?php _e( 'Save Settings', 'chcounter' ) ?>&raquo;" class="button" /></p>
			</form>
		</div>
		<div class='wrap'>
			<h3 style='clear: both; padding-top: 1em;'><?php _e( 'Uninstall chCounter Widget', 'chcounter' ) ?></h3>
			<form action="index.php" method="get">
				<input type="hidden" name="chcounter-widget" value="uninstall" />
				<p><?php _e( '<strong>Attention:</strong> All data created by the plugin will be removed from the database if you uninstall the plugin.', 'chcounter' ) ?></p>
				<p><input type="checkbox" name="delete_plugin" id="chcounter_widget_uninstall" value="1" /> <label for="chcounter_widget_uninstall" class="chcounter_widget"><?php _e( 'Yes, I want to uninstall chCounter Widget', 'chcounter' ) ?></label> </p>
					
				<p class="submit"><input type="submit" value="<?php _e( 'Uninstall chCounter Widget', 'chcounter' ) ?>&raquo;" class="button" /></p>
			</form>
		</div>
		<script type='text/javascript'>
			// <![CDATA[
			    Sortable.create("chcounter_available",
			    {dropOnEmpty:true, containment:["chcounter_available", "chcounter_active"], constraint:false});
			    Sortable.create("chcounter_active",
			    {dropOnEmpty:true, containment:["chcounter_available", "chcounter_active"], constraint:false});
			    window.onload = toggleHandle( "chcounter_active", "chcounter_handle_active" );
			    window.onload = toggleHandle( "chcounter_available", "chcounter_handle_available" );
			    // ]]>
		</script>
		<?php
	}


	/**
	 * gets order of parameters
	 *
	 * @param string $input serialized string with order
	 * @return array
	 */
 	function getOrder( $input, $listname )
	{
		parse_str( $input, $input_array );
		$input_array = $input_array[$listname];
		$order_array = array();
		for ( $i = 0; $i < count($input_array); $i++ ) {
			if ( $input_array[$i] != '' )
				$order_array[$i+1] = $input_array[$i];
		}
		return $order_array;	
	}


	/**
	 * displays control panel for the widget
	 *
	 * @param none
	 * @return void
	 */
	function widgetControl()
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
	 * Register widget
	 *
	 * @param none
	 * @return void
	 */
	function registerWidget()
	{
		if ( !function_exists("register_sidebar_widget") )
			return;

		register_sidebar_widget( 'chCounter', array(&$this, 'display') );
		register_widget_control( 'chCounter', array(&$this, 'widgetControl'), 250, 100 );
		return;
	}
	
	
	/**
	 * initializes plugin
	 *
	 * @param none
	 * @return void
	 */
	function init()
	{
		$params = $this->getParameters();
		
		$options = array();
		$options['title'] = '';
		$options['invisible'] = 0;
		$options['version'] = $this->version;
		foreach ( $params AS $param => $data ) {
			$options['params']['available'][] = $param;
			$options['params']['active'] = array();
		}
		
		if ($old_options = get_option( 'chcounter_widget' ) ) {
			if ( !isset($old_options['version']) ) {
				$options = array();
				$options = $old_options;
				$options['version'] = $this->version;
				update_option( 'chcounter_widget', $options );
			}
		}
		
		add_option( 'chcounter_widget', $options, 'chCounter Widget Options', 'yes' );
		
		return;
	}


	/**
	 * uninstalls chCounter Widget
	 *
	 * @param none
	 * @return void
	 */
	function uninstall()
	{
		delete_option( 'chcounter_widget' );
		
		/*
		* Deactivate Plugin
		*/
		$plugin = basename(__FILE__, ".php") .'/' . basename(__FILE__);
		require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		if ( function_exists( "deactivate_plugins" ) )
			deactivate_plugins( $plugin );
		else {
			$current = get_option('active_plugins');
			array_splice($current, array_search( $plugin, $current), 1 );
			update_option('active_plugins', $current);
			do_action('deactivate_' . trim( $plugin ));
		}
	}


	/**
	 * adds code to Wordpress head
	 *
	 * @param none
	 */
	function addHeaderCode()
	{
		echo "<link rel='stylesheet' href='".$this->plugin_url."/style.css' type='text/css' />\n";
		wp_enqueue_script( 'chcounter', $this->plugin_url.'/chcounter.js', array('prototype', 'scriptaculous'), '1.0' );
	}
	

	/**
	 * add options menu to the admin panel
	 *
	 * @param none
	 * @return void
	 */
	function addAdminMenu()
	{
		$mypage = add_options_page( __( 'chCounter Widget', 'chcounter' ), __( 'chCounter Widget', 'chcounter' ), 8, basename(__FILE__), array(&$this, 'displayOptionsPage') );
		add_action( "admin_print_scripts-$mypage", array(&$this, 'addHeaderCode') );
	}
}

$chcounter_widget = new chCounterWidget();


add_action( 'plugins_loaded', array(&$chcounter_widget, 'registerWidget') );
add_action( 'activate_chcounter-widget/chcounter-widget.php', array(&$chcounter_widget, 'init') );
add_action( 'admin_menu', array(&$chcounter_widget, 'addAdminMenu') );
	
load_plugin_textdomain( 'chcounter', $path = 'wp-content/plugins/chcounter-widget' );

// Uninstall chCounter Widget
if ( isset( $_GET['chcounter-widget']) AND 'uninstall' == $_GET['chcounter-widget'] AND ( isset($_GET['delete_plugin']) AND 1 == $_GET['delete_plugin'] ) )
	$chcounter_widget->uninstall();

		
/**
 * Wrapper function to display chCounter Widget statically
 *
 * @param string/array $args
 */
 function chcounter_widget_display( $args = array() )
 {
 	global $chcounter_widget;
	$chcounter_widget->display( $args );
 }

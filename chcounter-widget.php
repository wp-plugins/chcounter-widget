<?php
/*
Plugin Name: ChCounter Widget
Plugin URI: http://wordpress.org/extend/plugins/chcounter-widget/
Description: Integrate chCounter into Wordpress as widget.
Version: 2.6
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
	private $version = '2.6';
	
	/**
	 * path to the plugin
	 *
	 * @var string
	 */
	private $plugin_url;

	 
	/**
	 * Initialize class
	 *
	 * @param none
	 * @return void
	 */
	public function __construct()
	{
		if ( !defined( 'WP_CONTENT_URL' ) )
			define( 'WP_CONTENT_URL', get_option( 'siteurl' ) . '/wp-content' );
		if ( !defined( 'WP_PLUGIN_URL' ) )
			define( 'WP_PLUGIN_URL', WP_CONTENT_URL. '/plugins' );
		
		$this->plugin_url = WP_PLUGIN_URL.'/'.basename(__FILE__, '.php');

		return;
	}


	/**
	 * getParameters () - gets available parameters to display
	 *
	 * @param none
	 * @return array
	 */
	private function getParameters()
	{
        	$params = array();
		$params["total"] = array( "admin_label" => __('Total Visitors', 'chcounter'), "counter_label" =>  "{L_TOTAL_VISITORS}", "counter_value" => "{V_TOTAL_VISITORS}" );
		$params["today"] = array("admin_label" => __('Visitors today', 'chcounter'), "counter_label" => "{L_VISITORS_TODAY}", "counter_value" => "{V_VISITORS_TODAY}" );
		$params["yesterday"] = array( "admin_label" => __('Visitors yesterday', 'chcounter'), "counter_label" => "{L_VISITORS_YESTERDAY}", "counter_value" => "{V_VISITORS_YESTERDAY}" );
		$params["perday"] = array( "admin_label" => __('Visitors per day', 'chcounter'), "counter_label" => "{L_VISITORS_PER_DAY}", "counter_value" => "{V_PAGE_VIEWS_THIS_PAGE}" );
		$params["maxperday"] = array( "admin_label" => __('Max. visitors per day', 'chcounter'), "counter_label" => "{L_MAX_VISITORS_PER_DAY}", "counter_value" => "{V_MAX_VISITORS_PER_DAY}" );
		$params["maxperdaydate"] = array( "admin_label" => __('Max. visitors per day date', 'chcounter'), "chcounter_label" => "{L_MAX_VISITORS_PER_DAY_DATE}", "counter_value" => "{V_MAX_VISITORS_PER_DAY_DATE}" );
		$params["online"] = array( "admin_label" => __('Curently online', 'chcounter'), "counter_label" => "{L_VISITORS_CURRENTLY_ONLINE}", "counter_value" => "{V_VISITORS_CURRENTLY_ONLINE}" );
		$params["maxonline"] = array( "admin_label" => __('Max. online', 'chcounter'), "counter_label" => "{L_MAX_VISITORS_ONLINE}", "counter_value" => "{V_MAX_VISITORS_ONLINE}" );
		$params["maxonlinedate"] = array( "admin_label" => __('Max. online date', 'chcounter'), "counter_label" => "{L_MAX_VISITORS_ONLINE_DATE}", "counter_value" => "{V_MAX_VISITORS_ONLINE_DATE}" );
		$params["totalpageviews"] = array( "admin_label" => __('Total page views', 'chcounter'), "counter_label" => "{L_TOTAL_PAGE_VIEWS}", "counter_value" => "{V_TOTAL_PAGE_VIEWS}" );
		$params["pageviewstoday"] = array( "admin_label" => __('Page views today', 'chcounter'), "counter_label" => "{L_PAGE_VIEWS_TODAY}", "counter_value" => "{V_PAGE_VIEWS_TODAY}" );
		$params["pageviewsyesterday"] = array( "admin_label" => __('Page views yesterday', 'chcounter'), "counter_label" => "{L_PAGE_VIEWS_YESTERDAY}", "counter_value" => "{V_PAGE_VIEWS_YESTERDAY}" );
		$params["pageviewsperday"] = array( "admin_label" => __('Page views per day', 'chcounter'), "counter_label" => "{L_PAGE_VIEWS_PER_DAY}", "counter_value" => "{V_PAGE_VIEWS_PER_DAY}" );
		$params["maxpageviewsperday"] = array( "admin_label" => __('Max. page views per day', 'chcounter'), "counter_label" => "{L_MAX_PAGE_VIEWS_PER_DAY}", "counter_value" => "{V_MAX_PAGE_VIEWS_PER_DAY}" );
		$params["maxpageviewsperdaydate"] = array( "admin_label" => __('Max. page views per day date', 'chcounter'), "counter_label" => "{L_MAX_PAGE_VIEWS_PER_DAY_DATE}", "counter_value" => "{V_MAX_PAGE_VIEWS_PER_DAY_DATE}" );
		$params["pageviewsthispage"] = array( "admin_label" => __('Page views of current page', 'chcounter'), "counter_label" => "{L_PAGE_VIEWS_THIS_PAGE}", "counter_value" => "{V_PAGE_VIEWS_THIS_PAGE}" );
		$params["pageviewscurrentvisitor"] = array( "admin_label" => __('Page views of current visitor', 'chcounter'), "counter_label" => "{L_PAGE_VIEWS_OF_CURRENT_VISITOR}", "counter_value" => "{V_PAGE_VIEWS_OF_CURRENT_VISITOR}" );
		$params["pageviewspervisitor"] = array( "admin_label" => __('Page views per visitor', 'chcounter'), "counter_label" => "{L_PAGE_VIEWS_PER_VISITOR}", "counter_value" => "{V_PAGE_VIEWS_PER_VISITOR}" );
		$params["javascriptactivated"] = array( "admin_label" => __('Javascript activated', 'chcounter'), "counter_label" => "{L_JAVASCRIPT_ACTIVATED}", "counter_value" => "{V_JS_PERCENTAGE}" );
		$params["counterstart"] = array( "admin_label" => __('Counterstart', 'chcounter'), "counter_label" => "{L_COUNTER_START}", "counter_value" => "{V_COUNTER_START}" );
		$params["stats"] = array( "admin_label" => __('Statistics', 'chcounter'), "counter_label" => "{L_STATISTICS}", "counter_value" => "{V_COUNTER_URL}" );

		return $params;
	}

	
	/**
	 * display() - displays chCounter Widget
	 *
	 * Usually this function is invoked by the Wordpress widget system.
	 * However it can also be called manually via chcounter_widget_display().
	 *
	 * @param array/string $args
	 * @return void
	 */
	public function display($args)
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
			
		if ( file_exists(trailingslashit($_SERVER['DOCUMENT_ROOT']).$options['chcounter_path'].'/counter.php') ) {
			if ( 0 == $options['invisible'] ) {
				echo $before_widget . $before_title . $widget_title . $after_title;
				$counter_template = '';
				
				if ( count($options['params']['active']) > 0 ) {
					foreach ( $options['params']['active'] AS $order => $param ) {
						if ( 'stats' == $param )
							$counter_template .= "<li id='chcounter_stats'><a target='_blank' href='".$params['stats']['counter_value']."/stats/index.php'><img src='".$params['stats']['counter_value']."/images/stats.png' style='width:15px; height:15px; border: 0px; display: inline; margin-right: 0.5em;' alt='".$params['stats']['counter_label']."' title='".$params['stats']['counter_label']."' /></a><a target='_blank' href='".$params['stats']['counter_value']."/stats/index.php'>".$params['stats']['counter_label']."</a></li>";
						else
							$counter_template .= "<li>".$params[$param]['counter_label']." ".$params[$param]['counter_value']."</li>";
					}
				}
				
				$chCounter_template = <<<TEMPLATE
								 <ul>$counter_template</ul>
TEMPLATE;
				include_once(trailingslashit($_SERVER['DOCUMENT_ROOT']).$options['chcounter_path'].'/counter.php');
				echo $after_widget;
			} else {
				$chCounter_visible = 0;
				include_once(trailingslashit($_SERVER['DOCUMENT_ROOT']).$options['chcounter_path'].'/counter.php');
			}
		} else {
			echo $before_widget . $before_title . __( 'chCounter Error', 'chcounter' ) .$after_title.__( 'Could not find the chcounter installation. Please check your settings.', 'chcounter' ).$after_widget;
		}
			
		return;
	}


	/**
	 * displayAdminPage() - displays admin page 
	 *
	 * @param none
	 * @return void
	 */
	public function displayAdminPage()
	{
		global $wp_version;
		
		$params = $this->getParameters();
		$options = get_option( 'chcounter_widget' );
			
		if ( isset($_POST['updateSettings']) ) {
			check_admin_referer( 'chcounter-widget_update-options' );
			
			$options['chcounter_path'] = $_POST['chcounter_widget_path'];
			$options['invisible'] = isset( $_POST['chcounter_widget_invisible'] ) ? 1 : 0;
			$options['params']['available'] = $this->getOrder($_POST['chcounter_widget_available_order'], 'chcounter_available');
			$options['params']['active'] = $this->getOrder($_POST['chcounter_widget_active_order'], 'chcounter_active');
					
			update_option('chcounter_widget', $options);
			echo '<div id="message" class="updated fade"><p><strong>'.__( 'Settings saved', 'chcounter' ).'</strong></p></div>';
		}
		
		?>
		<div class='wrap'>
			<h2><?php _e( 'chCounter Widget Settings', 'chcounter' ) ?></h2>
					
			<form action='options-general.php?page=chcounter-widget.php' method='post' onSubmit="populateHiddenVars();">
					
				<?php wp_nonce_field( 'chcounter-widget_update-options') ?>
					
				<h3><?php _e( 'General Settings', 'chcounter' ) ?></h3>
				<table class="form-table">
				<tr valign="top">
					<th scope="row"><label for='chcounter_widget_path'><?php _e( 'chCounter Path', 'chcounter' ) ?></label></th><td><?php echo trailingslashit($_SERVER['DOCUMENT_ROOT']) ?><input type='text' name='chcounter_widget_path' id='chcounter_widget_path' value='<?php echo $options['chcounter_path'] ?>' size='20' /><br/><?php _e( 'without trailing slash', 'chcounter' ) ?></td>
				</tr>
				<tr valign="top">
					<th scope="row"><?php $selected_invisible = ( 1 == $options['invisible'] ) ? " checked = 'checked'" : ''; ?><label for='chcounter_widget_invisible'><?php _e( 'Invisible', 'chcounter' ) ?></label></th>
					<td><input type="checkbox" name="chcounter_widget_invisible" id="chcounter_widget_invisible"<?php echo $selected_invisible ?>/><br /><?php _e( 'When this option is active chCounter Widget will not be shown, while still counting', 'chcounter' ) ?></td>
				</tr>
				</table>
				
				<h3><?php _e( 'Parameters', 'chcounter' ) ?></h3>
				<div id="chcounter_available_box" class='chcounter_widget_parameters narrow' >
					<h4><?php _e( 'Available', 'chcounter' ) ?></h4>
					<ol class='chcounter_widget' id='chcounter_available'>
						<?php if ( count($options['params']['available']) > 0 ) : ?>
						<?php foreach ( $options['params']['available'] AS $order => $param ) : ?>
							<li id='param_<?php echo $param ?>'><?php echo $params[$param]['admin_label'] ?></li>
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
							<li id='param_<?php echo $param ?>'><?php echo $params[$param]['admin_label'] ?></li>
						<?php endforeach; ?>
						<?php endif; ?>
					</ol>
								
					<span class="handle" id="chcounter_handle_active"><?php _e( 'You see this message, because no parameters have been activated yet. You can create your chCounter Display via drag & drop into this box', 'chcounter' ) ?></span>
					<input type="hidden" name="chcounter_widget_active_order" id="chcounter_widget_active_order" />
				</div>
						
				<br style="clear: both;" />
				<p class="submit"><input type="submit" name="updateSettings" value="<?php _e( 'Save Settings', 'chcounter' ) ?>&raquo;" class="button" /></p>
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
	 * getOrder() - gets order of parameters
	 *
	 * @param string $input serialized string with order
	 * @param string $listname ID of list to sort
	 * @return array
	 */
 	private function getOrder( $input, $listname )
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
	 * control() - displays control panel for the widget
	 *
	 * @param none
	 * @return void
	 */
	public function control()
	{
		$options = get_option( 'chcounter_widget' );
		if ( $_POST['chcounter-submit'] ) {
			$options['title'] = $_POST['chCounter_widget_title'];
			update_option( 'chcounter_widget', $options );
		}
		echo '<p style="text-align: left;">'.__( 'Title', 'chcounter' ).': <input class="widefat" type="text" name="chCounter_widget_title" id="widget_title" value="'.$options['title'].'" /></p>';
		echo '<input type="hidden" name="chcounter-submit" id="chcounter-submit" value="1" />';
		
		return;
	}


	/**
	 * register() - registers widget
	 *
	 * @param none
	 * @return void
	 */
	public function register()
	{
		if ( !function_exists("register_sidebar_widget") )
			return;

		$widget_ops = array('classname' => 'widget_chcounter', 'description' => __('chCounter visitor statistics', 'chcounter') );
		wp_register_sidebar_widget( 'chcounter', 'chCounter', array(&$this, 'display'), $widget_ops );
		wp_register_widget_control( 'chcounter', 'chCounter', array(&$this, 'control'), array('width' => 250, 'height' => 100) );
		return;
	}
	
	
	/**
	 * activate() - Activate plugin
	 *
	 * @param none
	 * @return void
	 */
	public function activate()
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
		
		add_option( 'chcounter_widget', $options, 'chCounter Widget Options', 'yes' );
		
		/*
		* Add Capability to edit chCounter Widget Options for Administrator
		*/
		$role = get_role('administrator');
		$role->add_cap('edit_chcounter_widget');
		
		return;
	}


	/**
	 * uninstall() - uninstalls chCounter Widget
	 *
	 * @param none
	 * @return void
	 */
	public function uninstall()
	{
		delete_option( 'chcounter_widget' );
	}


	/**
	 * addHeaderCode() - adds code to Wordpress head
	 *
	 * @param none
	 * @return void
	 */
	public function addHeaderCode()
	{
		echo "<link rel='stylesheet' href='".$this->plugin_url."/style.css' type='text/css' />\n";
		if ( is_admin() ) {
			wp_register_script( 'chcounter', $this->plugin_url.'/chcounter.js', array('prototype', 'scriptaculous'), '1.0' );
			wp_print_scripts( 'chcounter' );
		}
	}
	

	/**
	 * addAdminMenu() - add options menu to the admin panel
	 *
	 * @param none
	 * @return void
	 */
	public function addAdminMenu()
	{
		$plugin = basename(__FILE__,'.php').'/'.basename(__FILE__);
		//$menu_title = "<img src='".$this->plugin_url."/icon.gif' alt='' /> ".__( 'chCounter', 'chcounter' );
		$menu_title = __( 'chCounter', 'chcounter' );
		$mypage = add_options_page( __( 'chCounter', 'chcounter' ), $menu_title, 'edit_chcounter_widget', basename(__FILE__), array(&$this, 'displayAdminPage') );
		add_action( "admin_print_scripts-$mypage", array(&$this, 'addHeaderCode') );
		add_filter( 'plugin_action_links_' . $plugin, array( &$this, 'pluginActions' ) );
	}
	
	
	/**
	 * pluginActions() - display link to settings page in plugin table
	 *
	 * @param array $links array of action links
	 * @return void
	 */
	public function pluginActions( $links )
	{
		$settings_link = '<a href="options-general.php?page='.basename(__FILE__).'">' . __('Settings') . '</a>';
		array_unshift( $links, $settings_link );
	
		return $links;
	}
}

$chcounter_widget = new chCounterWidget();

register_activation_hook(__FILE__, array(&$chcounter_widget, 'activate') );
load_plugin_textdomain( 'chcounter', false, basename(__FILE__, '.php').'/languages' );

add_action( 'widgets_init', array(&$chcounter_widget, 'register') );
add_action( 'wp_head', array(&$chcounter_widget, 'addHeaderCode') );
add_action( 'admin_menu', array(&$chcounter_widget, 'addAdminMenu') );
	
if ( function_exists('register_uninstall_hook') )
   register_uninstall_hook(__FILE__, array(&$chcounter_widget, 'uninstall'));


/**
 * Wrapper function to display chCounter Widget statically
 *
 * @param string/array $args
 */
function chcounter_widget_display( $args = array() ) {
 	global $chcounter_widget;
	$chcounter_widget->display( $args );
 }

<?php
/*
Plugin Name: ChCounter Widget
Plugin URI: http://wordpress.org/extend/plugins/chcounter-widget/
Description: Integrate chCounter into Wordpress as widget.
Version: 3.1.2
Author: Kolja Schleich

Copyright 2007-2015  Kolja Schleich  (email : kolja [dot] schleich [at] googlemail.com)

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
	var $version = '3.1.2';
	
	/**
	 * path to the plugin
	 *
	 * @var string
	 */
	var $plugin_url;

	 
	/**
	 * Class constructor
	 *
	 * @param none
	 * @return void
	 */
	function __construct()
	{
		$this->initialize();
		$this->plugin_url = WP_PLUGIN_URL.'/'.basename(__FILE__, '.php');

		return;
	}
	function chCounterWidget()
	{
		$this->__construct();
	}


	/**
	 * initialize plugin: register hooks and actions
	 *
	 * @param none
	 * @return void
	 */
	function initialize()
	{
		if ( !defined( 'WP_CONTENT_URL' ) )
			define( 'WP_CONTENT_URL', get_option( 'siteurl' ) . '/wp-content' );
		if ( !defined( 'WP_PLUGIN_URL' ) )
			define( 'WP_PLUGIN_URL', WP_CONTENT_URL. '/plugins' );
			
		register_activation_hook(__FILE__, array(&$this, 'activate') );
		load_plugin_textdomain( 'chcounter', false, basename(__FILE__, '.php').'/languages' );
	
		add_action( 'widgets_init', array(&$this, 'register') );
		add_action( 'wp_head', array(&$this, 'addHeaderCode') );
		add_action( 'admin_menu', array(&$this, 'addAdminMenu') );
	
		if ( function_exists('register_uninstall_hook') )
			register_uninstall_hook(__FILE__, array('chCounterWidget', 'uninstall'));
	}
	
	
	/**
	 * gets available parameters to display
	 *
	 * @param none
	 * @return array of parameters
	 */
	function getParameters()
	{
		$params = array();
		$params["total"] = array( "label" => __('Total Visitors', 'chcounter'), "value" => "{V_TOTAL_VISITORS}" );
		$params["today"] = array("label" => __('Visitors today', 'chcounter'), "value" => "{V_VISITORS_TODAY}" );
		$params["yesterday"] = array( "label" => __('Visitors yesterday', 'chcounter'), "value" => "{V_VISITORS_YESTERDAY}" );
		$params["perday"] = array( "label" => __('Visitors per day', 'chcounter'), "value" => "{V_VISITORS_PER_DAY}" );
		$params["maxperday"] = array( "label" => __('Max. visitors per day', 'chcounter'), "value" => "{V_MAX_VISITORS_PER_DAY}" );
		$params["maxperdaydate"] = array( "label" => __('Max. visitors per day date', 'chcounter'), "value" => "{V_MAX_VISITORS_PER_DAY_DATE}" );
		$params["online"] = array( "label" => __('Curently online', 'chcounter'), "value" => "{V_VISITORS_CURRENTLY_ONLINE}" );
		$params["maxonline"] = array( "label" => __('Max. online', 'chcounter'), "value" => "{V_MAX_VISITORS_ONLINE}" );
		$params["maxonlinedate"] = array( "label" => __('Max. online date', 'chcounter'), "value" => "{V_MAX_VISITORS_ONLINE_DATE}" );
		$params["totalpageviews"] = array( "label" => __('Total page views', 'chcounter'), "value" => "{V_TOTAL_PAGE_VIEWS}" );
		$params["pageviewstoday"] = array( "label" => __('Page views today', 'chcounter'), "value" => "{V_PAGE_VIEWS_TODAY}" );
		$params["pageviewsyesterday"] = array( "label" => __('Page views yesterday', 'chcounter'), "value" => "{V_PAGE_VIEWS_YESTERDAY}" );
		$params["pageviewsperday"] = array( "label" => __('Page views per day', 'chcounter'), "value" => "{V_PAGE_VIEWS_PER_DAY}" );
		$params["maxpageviewsperday"] = array( "label" => __('Max. page views per day', 'chcounter'), "value" => "{V_MAX_PAGE_VIEWS_PER_DAY}" );
		$params["maxpageviewsperdaydate"] = array( "label" => __('Max. page views per day date', 'chcounter'), "value" => "{V_MAX_PAGE_VIEWS_PER_DAY_DATE}" );
		$params["pageviewsthispage"] = array( "label" => __('Page views of current page', 'chcounter'), "value" => "{V_PAGE_VIEWS_THIS_PAGE}" );
		$params["pageviewscurrentvisitor"] = array( "label" => __('Page views of current visitor', 'chcounter'), "value" => "{V_PAGE_VIEWS_OF_CURRENT_VISITOR}" );
		$params["pageviewspervisitor"] = array( "label" => __('Page views per visitor', 'chcounter'), "value" => "{V_PAGE_VIEWS_PER_VISITOR}" );
		$params["javascriptactivated"] = array( "label" => __('Javascript activated', 'chcounter'), "value" => "{V_JS_PERCENTAGE}" );
		$params["counterstart"] = array( "label" => __('Counterstart', 'chcounter'), "value" => "{V_COUNTER_START}" );
		$params["stats"] = array( "label" => __('Statistics', 'chcounter'), "value" => "{V_COUNTER_URL}" );

		return $params;
	}

	
	/**
	 * displays chCounter Widget
	 *
	 * Usually this function is invoked by the Wordpress widget system.
	 * However it can also be called manually via chcounter_widget_display().
	 *
	 * @param array/string $args
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
			'widget_title' => (string)$options['title']
		);
		
		$args = array_merge( $defaults, $args );
		extract( $args );
		
		$file = dirname( __FILE__ ).'/chcounter/counter.php';
		if ( file_exists($file)) {
			if ( 0 == $options['invisible'] ) {
				echo $before_widget;
				if ( !empty($widget_title) ) echo $before_title . $widget_title . $after_title;

				$counter_template = '';
				
				if ( count($options['params']['active']) > 0 ) {
					foreach ( $options['params']['active'] AS $order => $param ) {
						if ( 'stats' == $param )
							$counter_template .= "<li id='chcounter_stats'><a target='_blank' href='".$params['stats']['value']."/stats/index.php'><img src='".$params['stats']['value']."/images/stats.png' style='width:15px; height:15px; border: 0px; display: inline; margin-right: 0.5em;' alt='".$params['stats']['label']."' title='".$params['stats']['label']."' /></a><a target='_blank' href='".$params['stats']['value']."/stats/index.php'>".$params['stats']['label']."</a></li>";
						else
							$counter_template .= "<li>".$params[$param]['label']." ".$params[$param]['value']."</li>";
					}
				}
				
				$chCounter_template = <<<TEMPLATE
								 <ul>$counter_template</ul>
TEMPLATE;
				include_once($file);
				echo $after_widget;
			} else {
				$chCounter_visible = 0;
				include_once($file);
			}
		} else {
			echo $before_widget . $before_title . __( 'chCounter Error', 'chcounter' ) .$after_title.__( 'Could not find the chcounter installation. Please check your settings.', 'chcounter' ).$after_widget;
		}
			
		return;
	}


	/**
	 * displays admin page 
	 *
	 * @param none
	 * @return void
	 */
	function displayAdminPage()
	{
		$params = $this->getParameters();
		
		//$this->uninstall();
		$this->activate();
		
		if ( isset($_POST['updateSettings']) ) {
			check_admin_referer( 'chcounter-widget_update-options' );
			
			// Hidden order values are empty if Javascript is disabled
			if ($_POST['chcounter_widget_available_order'] == "" && $_POST['chcounter_widget_active_order'] == "") {
				$options['params']['available'] = $options['params']['active'] = $tmp = array();
				$param_order = $_POST['param_order'];
				asort($param_order); // sort parameter ordering keeping key associations intact
				foreach ($param_order AS $param => $order) {
					// Put fields with empty ordering values into available otherwise in active parameters 
					if ($order == "") {
						array_push($options['params']['available'], $param);
					} else {
						// prevent problems with identical keys
						if (array_key_exists($order, $tmp))
							array_push($tmp, $param);
						else
							$tmp[$order] = $param;
						ksort($tmp); // sort array by keys
						$options['params']['active'] = array_values($tmp);
					}
				}
			} else {
				// Parameter order from jQuery Sortable list if Javascript is active
				$options['params']['available'] = $this->parseString($_POST['chcounter_widget_available_order'], 'chcounter_available');
				$options['params']['active'] = $this->parseString($_POST['chcounter_widget_active_order'], 'chcounter_active');
			}
			//$options['chcounter_path'] = untrailingslashit(htmlspecialchars($_POST['chcounter_widget_path']));
			$options['invisible'] = isset( $_POST['chcounter_widget_invisible'] ) ? 1 : 0;
							
			update_option('chcounter_widget', $options);
			echo '<div id="message" class="updated fade"><p><strong>'.__( 'Settings saved', 'chcounter' ).'</strong></p></div>';
		}
		
		$options = get_option( 'chcounter_widget' );
		?>
		<div class='wrap'>
			<h2><?php _e( 'chCounter Widget Settings', 'chcounter' ) ?></h2>
			
			<p class="update-nag" id="chcounter_nojs"><?php _e('Javascript appears to be deactivated. You can activate chCounter parameters by inserting numbers giving their displaying order into the respective form fields. Empty values will deactivate parameters.', 'chcounter') ?></p>
			
			<form action='options-general.php?page=chcounter-widget.php' method='post' onSubmit="populateHiddenVars();">
					
				<?php wp_nonce_field( 'chcounter-widget_update-options') ?>
				
				<div id="chcounter_available_box" class='chcounter_widget_parameters widget narrow' >
					<h3><?php _e( 'Available', 'chcounter' ) ?></h3>
					<ol class='chcounter_widget' id='chcounter_available'>
						<?php if ( count($options['params']['available']) > 0 ) : ?>
						<?php foreach ( $options['params']['available'] AS $order => $param ) : ?>
							<li class="widget-top" id='param_<?php echo $param ?>'><span class="widget-title"><?php echo $params[$param]['label'] ?></span><input type="text" name="param_order[<?php echo $param ?>]" id="param_order_<?php echo $param ?>" size="2" value="" /></li>
						<?php endforeach; ?>
						<?php endif; ?>
					</ol>
					
					<span class="handle" id="chcounter_handle_available" style="display: none;"><?php _e( 'You see this message, because all parameters have been activated. To deactivate certain parameters simply drag & drop them into this box', 'chcounter' ) ?></span>
					<input type="hidden" name="chcounter_widget_available_order" id="chcounter_widget_available_order" />
				</div>
				<div id="chcounter_active_box" class='chcounter_widget_parameters widget narrow'>
					<h3><?php _e( 'Active', 'chcounter' ) ?></h3>
							
					<ol class='chcounter_widget' id='chcounter_active'>
						<?php if ( count($options['params']['active']) > 0 ) : ?>
						<?php foreach ( $options['params']['active'] AS $order => $param ) : ?>
							<li class="widget-top" id='param_<?php echo $param ?>'><span class="widget-title"><?php echo $params[$param]['label'] ?></span><input type="text" name="param_order[<?php echo $param ?>]" id="param_order_<?php echo $param ?>" size="2" value="<?php echo $order ?>" /></li>
						<?php endforeach; ?>
						<?php endif; ?>
					</ol>
					
					<span class="handle" id="chcounter_handle_active" style="display: none;"><?php _e( 'You see this message, because no parameters have been activated yet. You can create your chCounter Display via drag & drop into this box', 'chcounter' ) ?></span>					
					<input type="hidden" name="chcounter_widget_active_order" id="chcounter_widget_active_order" />
				</div>
						
				<br style="clear: both;" />
				<p class="submit"><input type="submit" name="updateSettings" value="<?php _e( 'Save Settings', 'chcounter' ) ?>&raquo;" class="button button-primary" /></p>
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
			
			document.getElementById('chcounter_nojs').style.display='none';
			// Hide order boxes when Javascript is active
			<?php foreach ($params AS $key => $param) : ?>
			document.getElementById('param_order_<?php echo $key ?>').style.visibility='hidden';
			<?php endforeach; ?>
		</script>
		<?php
	}
	

	/**
	 * parse string and escape html specialchars
	 *
	 * @param string str
	 * @param string name
	 * @return escaped parsed string
	 */
	function parseString($str, $name) {
		parse_str( $str, $tmp );
		$ret = array();
		foreach ($tmp[$name] AS $id => $value) {
			$ret[] = htmlspecialchars($value);
		}
		return $ret;
	}
	
	
	/**
	 * displays control panel for the widget
	 *
	 * @param none
	 * @return void
	 */
	function control()
	{
		$options = get_option( 'chcounter_widget' );
		if ( isset($_POST['chcounter-submit']) ) {
			$options['title'] = htmlspecialchars($_POST['chCounter_widget_title']);
			$options['invisible'] = isset( $_POST['chcounter_widget_invisible'] ) ? 1 : 0;
			update_option( 'chcounter_widget', $options );
		}
		echo '<p style="text-align: left;"><label for="chcounter_title">'.__( 'Title', 'chcounter' ).'</label>: <input class="widefat" type="text" name="chCounter_widget_title" id="chcounter_title" value="'.htmlspecialchars($options['title']).'" /></p>';
		$checked = ( 1 == $options['invisible'] ) ? ' checked="checked"' : '';
		echo '<p style="text-align: left;"><label for="chcounter_invisible">'.__( 'Invisible', 'chcounter' ).'</label>&#160;<input type="checkbox" name="chcounter_widget_invisible" id="chcounter_invisible"'.$checked.' /></p>';
		echo '<input type="hidden" name="chcounter-submit" id="chcounter-submit" value="1" />';
	}


	/**
	 * registers widget
	 *
	 * @param none
	 * @return void
	 */
	function register()
	{
		if ( !function_exists("register_sidebar_widget") )
			return;

		$widget_ops = array('classname' => 'widget_chcounter', 'description' => __('chCounter visitor statistics', 'chcounter') );
		wp_register_sidebar_widget( 'chcounter', 'chCounter', array(&$this, 'display'), $widget_ops );
		wp_register_widget_control( 'chcounter', 'chCounter', array(&$this, 'control'), array('width' => 250, 'height' => 100) );
	}
	
	
	/**
	 * Activate plugin
	 *
	 * @param none
	 * @return void
	 */
	function activate()
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
		
		add_option( 'chcounter_widget', $options, '', 'yes' );
		
		/*
		* Add Capability to edit chCounter Widget Options for Administrator
		*/
		$role = get_role('administrator');
		$role->add_cap('edit_chcounter_widget');
		
		$this->writeChCounterConfig();
	}
	function writeChCounterConfig() {
		$content = "<?php
/*
 **************************************
 *
 * includes/config.inc.php
 * -------------
 *
 * last modified:	2005-04-21
 * -------------
 *
 * project:	chCounter
 * version:	3.1.1
 * copyright:	© 2005 Christoph Bachner
 * license:	GPL vs2.0 or higher [ see docs/license.txt ]
 * contact:	www.christoph-bachner.net
 *
 **************************************
*/


//
// Datenbank-Zugangsdaten
// Your database data 
// Données d'accès pour la base de données
//
\$_CHC_DBCONFIG = array(

	'server' => '".DB_HOST."',		// database server | Server | Server
	'user' => '".DB_USER."',			// database account | Benutzername | mot d'utilisateur
	'password' => '".DB_PASSWORD."',			// database password | Passwort | mot de passe
	'database' => '".DB_NAME."',			// database name | Datenbankname | nom de la base de données

	// Prefix of the chCounter database tables:
	// Präfix der chCounter Datenbanktabellen:
	// Préfixe des tableaux de la base de données du chCounter:
	'tables_prefix' => 'chc_'
	
);

?>";
		$file = dirname( __FILE__ ).'/chcounter/includes/config.inc.php';
		file_put_contents($file, $content);
	}


	/**
	 * uninstall chCounter Widget
	 *
	 * @param none
	 * @return void
	 */
	function uninstall()
	{
		delete_option( 'chcounter_widget' );
	}


	/**
	 * adds code to Wordpress head
	 *
	 * @param none
	 * @return void
	 */
	function addHeaderCode()
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
	function addAdminMenu()
	{
		$plugin = basename(__FILE__,'.php').'/'.basename(__FILE__);
//		$menu_title = "<img src='".$this->plugin_url."/icon.png' alt='' /> ";
		$menu_title = __( 'chCounter', 'chcounter' );
		$mypage = add_options_page( __( 'chCounter', 'chcounter' ), $menu_title, 'edit_chcounter_widget', basename(__FILE__), array(&$this, 'displayAdminPage') );
		add_action( "admin_print_scripts-$mypage", array(&$this, 'addHeaderCode') );
		add_filter( 'plugin_action_links_' . $plugin, array( &$this, 'pluginActions' ) );
	}
	
	
	/**
	 * display link to settings page in plugin table
	 *
	 * @param array $links array of action links
	 * @return new array of plugin actions
	 */
	function pluginActions( $links )
	{
		$settings_link = '<a href="options-general.php?page='.basename(__FILE__).'">' . __('Settings') . '</a>';
		array_unshift( $links, $settings_link );
	
		return $links;
	}
}

// run chCounter Widget
$chcounter_widget = new chCounterWidget();
/**
 * Wrapper function to display chCounter Widget statically
 *
 * @param string/array $args
 */
function chcounter_widget_display( $args = array() ) {
 	global $chcounter_widget;
	$chcounter_widget->display( $args );
}
?>
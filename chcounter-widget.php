<?php
/*
Plugin Name: ChCounter Widget
Author URI: http://kolja.galerie-neander.de/
Plugin URI: http://kolja.galerie-neander.de/plugins/chcounter-widget/
Description: Integrate chCounter into Wordpress as widget.
Version: 2.7
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
	var $version = '2.7';
	
	/**
	 * path to the plugin
	 *
	 * @var string
	 */
	var $plugin_url;

	 
	/**
	 * plugin patth
	 *
	 * @var string
	 */
	var $plugin_path;


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
		$this->plugin_path = WP_PLUGIN_DIR.'/'.basename(__FILE__, '.php');

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
		if ( !defined( 'WP_CONTENT_DIR' ) )
			define( 'WP_CONTENT_DIR', ABSPATH . 'wp-content' );
		if ( !defined( 'WP_PLUGIN_DIR' ) )
			define( 'WP_PLUGIN_DIR', WP_CONTENT_DIR . '/plugins' );
			
		register_activation_hook(__FILE__, array(&$this, 'activate') );
		load_plugin_textdomain( 'chcounter', false, basename(__FILE__, '.php').'/languages' );
	
		add_action( 'widgets_init', array(&$this, 'register') );
		add_action( 'wp_head', array(&$this, 'addHeaderCode') );
		add_action( 'admin_menu', array(&$this, 'addAdminMenu') );
	
		if ( function_exists('register_uninstall_hook') )
			register_uninstall_hook(__FILE__, array(&$this, 'uninstall'));
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
			'widget_title' => (string)$options['title'],
			'invisible' => $options['invisible']
		);
		
		$args = array_merge( $defaults, $args );
		extract( $args );
			
		if ( empty($invisible) ) {
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
			include_once('chcounter/counter.php');
			echo $after_widget;
		} else {
			$chCounter_visible = 0;
			include_once('chcounter/counter.php');
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
		$options = get_option( 'chcounter_widget' );
			
		if ( isset($_POST['updateSettings']) ) {
			check_admin_referer( 'chcounter-widget_update-options' );
			
			$options['params']['available'] = $this->getOrder($_POST['chcounter_widget_available_order'], 'chcounter_available');
			$options['params']['active'] = $this->getOrder($_POST['chcounter_widget_active_order'], 'chcounter_active');
					
			update_option('chcounter_widget', $options);
			echo '<div id="message" class="updated fade"><p><strong>'.__( 'Settings saved', 'chcounter' ).'</strong></p></div>';
		}
		$db_name = isset($_POST['chcounter_db_name']) ? $_POST['chcounter_db_name'] : DB_NAME;
		$db_user = isset($_POST['chcounter_db_user']) ? $_POST['chcounter_db_user'] : DB_USER;
		$db_passwd = isset($_POST['chcounter_db_passwd']) ? $_POST['chcounter_db_passwd'] : DB_PASSWORD;
		$db_table_prefix = isset($_POST['chcounter_table_prefix']) ? $_POST['chcounter_table_prefix'] : 'chc_';
		?>
		<div class='wrap'>
			<?php if ( isset($_GET['install']) && 'chcounter' == $_GET['install'] ) : ?>
			<h2><?php _e( 'chCounter Configuration', 'chcounter' ) ?></h2>

			<?php if ( !is_writable($this->plugin_path.'/chcounter/includes') ) : ?>
			<div class="error fade"><p><?php printf(__( 'The chCounter Configuration directory is not writable. Either make %s writable or configure chCounter manually.', 'chcounter' ), $this->plugin_path.'/chcounter/includes/') ?></p></div>
			<?php endif; ?>

			<?php if ( isset($_POST['write']) ) : ?>
				<?php $this->writeConfiguration( $_POST['chcounter_db_name'], $_POST['chcounter_db_user'], $_POST['chcounter_db_passwd'], $_POST['chcounter_table_prefix'] ) ?>
				<div class="updated fade"><p><?php printf(__( "Configuration file written. <a href='%s' target='_blank'>Install chCounter</a>", 'chcounter' ), $this->plugin_url.'/chcounter/install/install.php') ?></p></div>
			<?php endif; ?>

			<form action="" method="post">
			<table class="form-table">
			<tr valign="top">
				<th scope="row"><label for="chcounter_db_name"><?php _e( 'Database Name', 'chcounter' ) ?></label></th>
				<td><input type="text" name="chcounter_db_name" id="chcounter_db_name" value="<?php echo $db_name ?>" /></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="chcounter_db_user"><?php _e( 'Database User', 'chcounter' ) ?></label></th>
				<td><input type="text" name="chcounter_db_user" id="chcounter_db_user" value="<?php echo $db_user ?>" /></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="chcounter_db_passwd"><?php _e( 'Database Password', 'chcounter' ) ?></label></th>
				<td><input type="text" name="chcounter_db_passwd" id="chcounter_db_passwd" value="<?php echo $db_passwd ?>" /></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="chcounter_table_prefix"><?php _e( 'Table Prefix', 'chcounter' ) ?></label></th>
				<td><input type="text" name="chcounter_table_prefix" id="chcounter_table_prefix" value="<?php echo $db_table_prefix ?>" /></td>
			</tr>
			</table>

			<p class="submit"><input type="submit" name="write"  value="<?php _e( 'Save Configuration &raquo;', 'chcounter' ) ?>" /></p>
			</form>

			<?php else : ?>

			<h2><?php _e( 'chCounter Widget Settings', 'chcounter' ) ?></h2>

			<?php if ( isset($_GET['remove_install_dir']) ) : ?>
				<?php if ( $this->removeDir($this->plugin_path.'/chcounter/install') ) : ?>
				<div class="updated fade"><p><?php _e( "The chCounter Installation directory has been deleted.", 'chcouner' ) ?></p></div>
				<?php else : ?>
				<div class="error fade"><p><?php _e( 'Could not delete the installation directory. Please delete it manually.', 'chcounter' ) ?></p></div>
				<?php endif; ?>
			<?php endif; ?>

			<?php if ( !$this->installed() ) : ?>
			<div class="updated"><p><?php printf(__( "It looks like chCounter has not been installed yet. <a href='%s'>Install now.</a>", 'chcounter' ), $_SERVER['REQUEST_URI']."&amp;install=chcounter") ?></p></div>
			<?php elseif ( $this->installed() && file_exists($this->plugin_path.'/chcounter/install') ) : ?>
			<div class="updated"><p><?php printf(__( "The chCounter Installation directory exists. You should <a href='%s'>delete it.</a>", 'chcounter' ), $_SERVER['REQUEST_URI']."&amp;remove_install_dir") ?></p></div>
			<?php endif; ?>

			<form action='' method='post' onSubmit="populateHiddenVars();">
					
				<?php wp_nonce_field( 'chcounter-widget_update-options') ?>
					
				<div id="chcounter_available_box" class='chcounter_widget_parameters widget narrow' >
					<h4><?php _e( 'Available', 'chcounter' ) ?></h4>
					<ol class='chcounter_widget' id='chcounter_available'>
						<?php if ( count($options['params']['available']) > 0 ) : ?>
						<?php foreach ( $options['params']['available'] AS $order => $param ) : ?>
							<li class="widget-top" id='param_<?php echo $param ?>'><span class="widget-title"><?php echo $params[$param]['label'] ?></span></li>
						<?php endforeach; ?>
						<?php endif; ?>
					</ol>
							
					<span class="handle" id="chcounter_handle_available"><?php _e( 'You see this message, because all parameters have been activated. To deactivate certain parameters simply drag & drop them into this box', 'chcounter' ) ?></span>
					<input type="hidden" name="chcounter_widget_available_order" id="chcounter_widget_available_order" />
				</div>
				<div id="chcounter_active_box" class='chcounter_widget_parameters widget narrow'>
					<h4><?php _e( 'Active', 'chcounter' ) ?></h4>
							
					<ol class='chcounter_widget' id='chcounter_active'>
						<?php if ( count($options['params']['active']) > 0 ) : ?>
						<?php foreach ( $options['params']['active'] AS $order => $param ) : ?>
							<li class="widget-top" id='param_<?php echo $param ?>'><?php echo $params[$param]['label'] ?></li>
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
			Sortable.create("chcounter_available",{
				dropOnEmpty:true,
				containment:["chcounter_available", "chcounter_active"],
				constraint:false,
				onUpdate: function() { toggleHandle("chcounter_active", "chcounter_handle_active"); }
			});
			Sortable.create("chcounter_active",{
				dropOnEmpty:true,
				containment:["chcounter_available", "chcounter_active"],
				constraint:false,
				onUpdate: function() { toggleHandle("chcounter_available", "chcounter_handle_available"); }
			});
			window.onload = toggleHandle( "chcounter_active", "chcounter_handle_active" );
			window.onload = toggleHandle( "chcounter_available", "chcounter_handle_available" );
			// ]]>
		</script>

		<?php endif; ?>
		<?php
	}


	/**
	 * gets order of parameters
	 *
	 * @param string $input serialized string with order
	 * @param string $listname ID of list to sort
	 * @return sorted array of parameters
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
	function control()
	{
		$options = get_option( 'chcounter_widget' );
		if ( isset($_POST['chcounter-submit']) ) {
			$options['title'] = $_POST['chCounter_widget_title'];
			$options['invisible'] = isset( $_POST['chcounter_widget_invisible'] ) ? 1 : 0;
			update_option( 'chcounter_widget', $options );
		}
		echo '<p style="text-align: left;"><label for="chcounter_widget_title">'.__( 'Title', 'chcounter' ).'</label><input class="widefat" type="text" name="chCounter_widget_title" id="chcounter_widget_title" value="'.$options['title'].'" /></p>';
		$checked = ( $options['invisible'] == 1 ) ? ' checked="checked"' : '';
		echo '<p><input type="checkbox" name="chcounter_widget_invisible" id="chcounter_widget_invisible"'.$checked.' />&#160;<label for="chcounter_widget_invisible">'.__( 'Invisible', 'chcounter' ).'</label></p>';
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
		
		add_option( 'chcounter_widget', $options, 'chCounter Widget Options', 'yes' );
		
		/*
		* Add Capability to edit chCounter Widget Options for Administrator
		*/
		$role = get_role('administrator');
		$role->add_cap('edit_chcounter_widget');

		if ( $this->installed() && file_exists($this->plugin_path.'/chcounter/install') )
			$this->removeDir($this->plugin_path.'/chcounter/install');
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
	 * check if chCounter is installed, thus $prefix . 'config' table exists
	 *
	 * @param none
	 * @return boolean
	 */
	function installed()
	{
		$options = get_option('chcounter_widget');
		$tables = mysql_list_tables(DB_NAME);
		$prefix = $options['table_prefix'];
		while ( list($temp) = mysql_fetch_array($tables) ) {
			if ( $temp == $prefix . 'config' ) {
				return true;
			}
		}

		return false;
	}


	/**
	 * write chCounter configuration file
	 *
	 * @param string $db_name
	 * @param string $db_user
	 * @param string $db_passwd
	 * @param string $table_prefix
	 * @return true
	 */
	function writeConfiguration( $db_name, $db_user, $db_passwd, $table_prefix )
	{
		$file = $this->plugin_path . '/chcounter/includes/config.inc.php';
		$content = "<?php \$_CHC_DBCONFIG = array (\n\t'server' => 'localhost',\n\t'database' => '".$db_name."',\n\t'user' => '".$db_user."',\n\t'password' => '".$db_passwd."',\n\t'tables_prefix' => '".$table_prefix."'\n);\n?>";
		file_put_contents($file, $content);

		$options = get_option('chcounter_widget');
		$options['table_prefix'] = $table_prefix;
		update_option('chcounter_widget', $options);

		return true;
	}


	/**
	 * remove chCounter installation directory
	 *
	 * @param none
	 * @return void
	 */
	function removeDir( $dir )
	{
		if ( substr($dir,-1) == '/' )
			$dir = substr($dir,0,-1);

		if ( !file_exists($dir) || !is_dir($dir) ) {
			return false;
		} elseif ( !is_readable($dir) ) {
			return false;

		} else {
			$handle = opendir($dir);
			while ( false !== ($item = readdir($handle)) ) {
				if ( $item != '.' && $item != '..' ) {
					$path = $dir . '/' . $item;

					if ( is_dir($path) )
						$this->removeDir($path);
					else
						unlink($path);
				}
			}

			closedir($handle);

			if ( !@rmdir($dir) )
				return false;

			return true;
		}
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
			wp_register_script( 'chcounter', $this->plugin_url.'/chcounter.js', array('jquery', 'scriptaculous'), '1.0' );
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
		$setup_link = '<a href="options-general.php?page='.basename(__FILE__).'&amp;install=chcounter">'.__('Setup', 'chcounter').'</a>';
		array_unshift( $links, $settings_link, $setup_link );
	
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

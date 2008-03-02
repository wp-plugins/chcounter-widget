<?php
function chcounter_widget_maybe_upgrade()
{
	$old_options = get_option( 'chcounter_widget' );
	
	// Version lower than 2.0
	if ( !isset($old_options['params']['active']) ) {
		// Version greater than 1.0
		if ( isset($old_options['order']) ) {
			foreach ( $old_options['order'] AS $order => $param ) {
				if ( 1 == $old_options[$param] ) {
					// Parameter is activated.
					$options['params']['active'][$order] = $param;
				} else {
					// Parameter is not activated
					$options['params']['available'][] = $param;
				}
			}
			
			$options['title'] = $old_options['title'];
			$options['chcounter_path'] = $old_options['chcounter_path'];
			
			update_option( 'chcounter_widget', $options );
		} else {
			/*
			* Version 1.0
			*
			* User must delete all options and reconfigure the plugin
			*/
		}
	} else {
		// nothing to do ... yet
	}
}

chcounter_widget_maybe_upgrade();
?>

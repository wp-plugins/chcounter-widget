<?php $options = get_option( 'chcounter_widget' ); ?>

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

<?php $selected_uninstall = ( isset($options['uninstall']) AND 1 == $options['uninstall'] ) ? " checked = 'checked'" : ''; ?>
<h3 style='clear: both; padding-top: 1em;'><?php _e( 'Uninstall chCounter Widget', 'chcounter' ) ?></h3>
<p><?php _e( '<strong>Attention:</strong> All data created by the plugin will be removed from the database if you uninstall the plugin.', 'chcounter' ) ?></p>
<p><label for="chcounter_widget_uninstall"><?php _e( 'Yes, I want to uninstall chCounter Widget', 'chcounter' ) ?></label> <input type="checkbox" name="chcounter_widget_uninstall" id="chcounter_widget_uninstall" value="1"<?php echo $selected_uninstall ?>/></p>
		
<input type="hidden" name="update_chcounter" id="chcounter-submit" value="update_options" />
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

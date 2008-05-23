=== chCounter Widget ===
Contributors: Kolja Schleich
Tags: plugin, sidebar, widget, visitor counter, counter, integration
Requires at least: 2.2
Tested up to: 2.5
Stable tag: 2.3

A simple plugin to create a widget for the [chCounter](http://chcounter.org).


== Description ==

This is a simple plugin which creates a widget for the [chCounter](http://chcounter.org). Currently the following parameters are supported:

* Total number of visitors
* Online visitors yesterday
* Currently Online visitors
* Online visitors today
* Maximum number of visitors online per day
* Maximum number of visitors online at one time
* Total number of page views
* Total number of page views for current page
* Visitors per day
* Link to the chCounter statistics page

The parameters to display are controlled via the admin panel. There's also an option to make chCounter invisible while active and counting. In the latest Version I've included a new capability to control access to the Plugin Settings page and make it compatible with [Role Manager](http://www.im-web-gefunden.de/wordpress-plugins/role-manager/)

**Translations**

* German
* Turkish

A template for creating translations for other languages is included. If you create a translation for your language you can send the file to me and I will put it in the repository for public access.

== Installation ==

To install the plugin to the following steps

1. Unzip the zip-file and upload the content to your Wordpress Plugin directory.
2. Activiate the plugin via the admin plugin page.
3. Go to Options --> chCounter Widget and set up the directory of your chCounter installation as well as parameters shown on the frontend
3. Go to the widget page and add it to your sidebar. Don't forget to set the title via the widget control panel


== Frequently Asked Questions == 

= How to upgrade from version 1.0 to 1.1? =
You first unzip the new files and upload them to the plugins directory. After updating the files you need to deactivate und reactivate the plugin once. **Attention**: In Version 1.1 all data created by the plugin will be deleted upon plugin deactivation. I recommend to update.

= How to upgrade from version 1.0 to 1.1.2? =
First upload the new files to the plugins directory. You can just overwrite the old ones. Then go to Options --> chCounter Widget and check the uninstall option. Then deactivate and reactivate the plugin. You need to set the options again, Sorry!

= How to upgrade to Version 2.0 =
Due to some major changes in the options structure you need to uninstall the chCounter plugin once and then reconfigure it.

= How to diplay chCounter statically without using widgets? =
**Version 2.0.2**

Place the following code where you want to display chCounter

`<?php
$chcounter_widget = new chCounterWidget();
$chcounter_widget->display(array (
   'before_widget' => '<li id="chcounter" class="widget chCounterWidget_display">',
   'after_widget' => '</li>',
   'before_title' => '<h2 class="widgettitle">',
   'after_title' => '</h2>',
   'widget_title' => 'Visitor statistics',
));
?>`

**Version 2.1+**

You can just put the following code where you want to display chCounter:

`<?php chcounter_widget_display("chCounter Widget Title") ?>`

The plugin will default to before and after widget tags like in the example for Version 2.0.2. Alternatively you can pass an array of arguments to the function like in Version 2.0.2 to overwrite the defaults.


== ChangeLog ==

**Version 2.3**, *21-May-2008*

- NEW: uses own capability to control access to plugin options page
- detached translation files from main plugin files. Own repository

**Version 2.2.1**, *13-April-2008*

- NEW: load scripts only on chCounter settings page
- changed uninstallation method to direct uninstallation and plugin deactivation
- reincorporated settings.php into main plugin file

**Version 2.2**, *9-April-2008*

- bug fix for displaying widget statically

**Version 2.1**, *20-March-2008*

- NEW: Simplified static displaying of chCounter. See FAQ for further details
- Switched to using scriptaculous and prototype shipped with Wordpress to reduce disk usage

**Version 2.0.2**, *17-March-2008*

- NEW: option to make chCounter invisible while active

**Version 2.0.1**, *17-March-2008*

- made it compatible with Wordpress 2.5
- NEW: possibility to display chCounter statically without using widget. See FAQ for further details

**Version 2.0**, *2-March-2008*

- NEW: drag & drop sorting and activation of parameters
- styling like widgets in Wordpress 2.3

**Version 1.1.3**, *29-February-2008*

- Some styling upgrade with own css file in respect to Wordpress 2.5

**Version 1.1.2**, *25-February-2008*

- Took out automatic uninstallation upon plugin deactivation
- NEW: option to uninstall it upon plugin deactivation
- Fixed a severe bug in 1.1.1 so that the widget was not displayed.

**Version 1.1.1**, *25-February-2008*

- NEW: Implemented uninstallation of the plugin upon deactivation.
- Version was deleted due to severe bug that caused the widget not to work.

**Version 1.1**, *24-February-2008*

- NEW: option to set chCounter installation directory via the admin interface and simple sorting of parameters.

**Version 1.0**, *20-February-2008*

- First Release of the plugin.


== Screenshots ==
1. Options Page to control chCounter display
2. Widget Control Panel

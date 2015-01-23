=== chCounter Widget ===
Contributors: Kolja Schleich
Tags: plugin, sidebar, widget, visitor counter, counter, integration
Requires at least: 2.7
Tested up to: 4.0.1
Stable tag: 3.1.1

A simple plugin to create a widget for [chCounter](http://chcounter.org).

== Description ==

Create a widget for [chCounter](http://chcounter.org). It can display all [20 output values](http://chcounter.org/index.php?s=alle-ausgabewerte) that chCounter supports.

The parameters to display are controlled via the admin panel. There's also an option to make chCounter invisible while active and counting

**Translations**

* German
* French
* Turkish
* Swedish
* Belorussian by [FatCow](http://www.fatcow.com/)

Most recent language files can be downloaded at http://svn.wp-plugins.org/chcounter-widget/i18n.


== Installation ==

To install the plugin to the following steps

1. Install chCounter via the webinterface http://www.yourDomain.tld/wp-content/plugins/chcounter-widget/chcounter/install/install.php (will give deprecated warnings you can ignore)
2. Remove the folder "install" in the chcounter subdirectory
3. Unzip the zip-file and upload the content to your Wordpress Plugin directory.
4. Activiate the plugin via the admin plugin page.
5. Go to Options --> chCounter Widget and set up the parameters to show on the front end
6. Go to the widget page and add it to your sidebar. Don't forget to set the title via the widget control panel


== Frequently Asked Questions == 

= How to diplay chCounter statically without using widgets? =

Place the following code where you want to display chCounter

`<?php chcounter_widget_display("chCounter Widget Title") ?>`


== Screenshots ==
1. Options Page to control chCounter display. Set the path to chCounter relative to the web root
2. Widget Control Panel. Make the counter display invisible while still counting

== Changelog ==

= 3.1.1 =
* checked for security issues

= 3.1 =
* NEW: Admin page works without Javascript

= 3.0 =
* NEW: Compatible with Wordpress 4.0.1
* NEW: Bundle chCounter 3.1.3 (fixed some deprecated issues) within plugin
* BUGFIX: escape html specialchars in $_POST variables for security

= 2.8.1 =
* NEW: Belorussian translation by [FatCow](http://www.fatcow.com/)

= 2.8 =
* REMOVED: chCounter bundle due to installation problems

= 2.7.1 = 
* BUGFIX: german translation
* NEW: upgrade procedure to fix false counter url

= 2.7 
* NEW: bundled chCounter with plugin

= 2.6.1 =
* BUGFIX: don't display title element if empty

= 2.6 =
* CHANGED: full translation with Wordpress

= 2.5.3 =
* CHANGED: backwards compatibility with PHP4

= 2.5.2 =
* BUGFIX: parameters

= 2.5.1 =
* CHANGED: styling on settings page

= 2.5 =
* NEW: support of all output values chCounter can display

= 2.4 =
* NEW: uninstallation hook for WP 2.7
* CHANGED: disabled uninstallation form in WP 2.7

= 2.3 =
* NEW: own capability to control access to plugin options page

= 2.2.1 =
* NEW: load scripts only on chCounter settings page
* CHANGED: uninstallation method to direct uninstallation and plugin deactivation

= 2.2 =
* BUGFIX: display widget statically

= 2.1 =
* NEW: Simplified static displaying of chCounter.
* CHANGED: Switched to using scriptaculous and prototype shipped with Wordpress to reduce disk usage
* REMOVED: deleted scriptaculous and prototype files from plugin

= 2.0.2 =
* NEW: option to make chCounter invisible while active

= 2.0.1 =
* NEW: display chCounter statically without using widget.
* BUGFIX: compatibility with Wordpress 2.5

= 2.0 =
* NEW: drag & drop sorting and activation of parameters
* CHANGED: styling like widgets in Wordpress 2.3

= 1.1.3 =
* CHANGED: styling upgrade with own css file in respect to Wordpress 2.5

= 1.1.2 =
* NEW: option to uninstall it upon plugin deactivation
* BUGFIX: widget was not displayed
* REMOVED: Took out automatic uninstallation upon plugin deactivation

= 1.1.1 =
* NEW: uninstallation of the plugin upon deactivation.

= 1.1 =
* NEW: option to set chCounter installation directory via the admin interface and simple sorting of parameters.

= 1.0 =
* First Release of the plugin.
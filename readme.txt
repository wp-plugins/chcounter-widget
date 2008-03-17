=== chCounter Widget ===
Contributors: Kolja Schleich
Tags: plugin, sidebar, widget, visitor counter, counter
Requires at least: 2.2
Tested up to: 2.3.3
Stable tag: 2.0.1

A simple plugin to create a widget for the chCounter from <http://chcounter.org/>

== Description ==

This is a simple plugin which creates a widget for the chCounter from <http://chcounter.org/>.

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

The parameters to display are controlled via the admin panel. Since Version 2.0 I implemented a drag & drop sorting and activation of parameters through the scriptaculous JavaScript libraries (<http://script.aculo.us/>).

== Installation ==

To install the plugin to the following steps

1. Unzip the zip-file and upload the content to your Wordpress Plugin directory.
2. Activiate the plugin via the admin plugin page.
3. Go to Options --> chCounter Widget and set up the directory of your chCounter installation as well as parameters shown on the frontend
3. Go to the widget page and add it to your sidebar. Don't forget to set the title via the widget control panel

== Frequently Asked Questions == 

= How to upgrade from version 1.0 to 1.1? =
You first unzip the new files and upload them to the plugins directory. After updating the files you need to deactivate und reactivate the plugin once. **Attention**: In Version 1.1 all data created by the plugin will be deleted upon plugin deactivation. I recommend to update to version 1.1.1

= How to upgrade from version 1.0 to 1.1.2? =
First upload the new files to the plugins directory. You can just overwrite the old ones. Then go to Options --> chCounter Widget and check the uninstall option. Then deactivate and reactivate the plugin. You need to set the options again, Sorry!

= How to upgrade to Version 2.0 =
Due to some major changes in the options structure you need to uninstall the chCounter plugin once and then reconfigure it.

== ChangeLog ==

**Version 2.0**
*2-March-2008*

- implementation of drag & drop sorting and activation of parameters
- styling like widgets in Wordpress 2.3

**Version 1.1.3**
*29-February-2008*

- Some styling upgrade with own css file in respect to Wordpress 2.5

**Version 1.1.2**
*25-February-2008*

- Took out the uninstallation upon plugin deactivation and added an option to uninstall it.
- Fixed a severe bug in 1.1.1 so that the widget was not displayed.

**Version 1.1.1**
*25-February-2008*

- Implemented uninstallation of the plugin upon deactivation.
- Version was deleted due to severe bug that caused the widget not to work.

**Version 1.1**
*24-February-2008*

- Implemented option to set chCounter installation directory via the admin interface and simple sorting of parameters.

**Version 1.0**
*20-February-2008*

- First Release of the plugin.

== Screenshots ==


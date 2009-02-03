=== chCounter Widget ===
Contributors: Kolja Schleich
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=2329191
Tags: plugin, sidebar, widget, visitor counter, counter, integration
Requires at least: 2.3
Tested up to: 2.7
Stable tag: 2.5

A simple plugin to create a widget for [chCounter](http://chcounter.org).

== Description ==

Create a widget for [chCounter](http://chcounter.org). It can display all [20 output values](http://chcounter.org/index.php?s=alle-ausgabewerte) that chCounter supports.

The parameters to display are controlled via the admin panel. There's also an option to make chCounter invisible while active and counting. Access to the settings page is controled via Wordpress capabilities which makes it compatible with [Role Manager](http://www.im-web-gefunden.de/wordpress-plugins/role-manager/)

**Translations**

* German
* Turkish

== Installation ==

To install the plugin to the following steps

1. Unzip the zip-file and upload the content to your Wordpress Plugin directory.
2. Activiate the plugin via the admin plugin page.
3. Go to Options --> chCounter Widget and set up the directory of your chCounter installation as well as parameters shown on the frontend
4. Go to the widget page and add it to your sidebar. Don't forget to set the title via the widget control panel


== Frequently Asked Questions == 

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

== Screenshots ==
1. Options Page to control chCounter display
2. Widget Control Panel

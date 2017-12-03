=== WP REST API Templates ===
Contributors: mrpharderwijk
Tags: wp-api, wp-rest-api, rest, api, templates, static page, template
Requires at least: 3.6.0
Tested up to: 4.7.x
Stable tag: 1.0.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Extends WordPress WP REST API with new routes retrieving pages by Template or retrieving all template types.


== Description ==

Extends WordPress WP REST API with new routes retrieving pages by Template or retrieving all template types.

The new routes available will be:

* `wp-json/wp/v2/templates` outputs all the different templates available
* `wp-json/wp/v2/templates?type=<template-name>` outputs the pages that comply to the given template-name


== Installation ==

This plugin requires having [WP REST API](http://v2.wp-api.org/) installed and activated or it won't be of any use. Since Wordpress 4.7 the WP REST API has been merged in the Wordpress core, so this plugin might not be needed any longer.

Install the plugin as you would with any WordPress plugin in your `wp-content/plugins/` directory or equivalent.

Once installed, activate WP REST API By Template from the WordPress plugins dashboard page and you're ready to go, WP REST API will respond to the new route and endpoint.


== Changelog ==

= 1.0.1 =
* First public release
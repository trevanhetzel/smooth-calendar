=== Plugin Name ===
Contributors: hetzelcreative
Donate link: http://trevan.co
Tags: calendar, events
Requires at least: 4.3
Tested up to: 4.4.2
Stable tag: 4.4.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A simple and flexible calendar plugin.

== Description ==

Smooth Calendar is a straightfowrward solution to displaying events on a WordPress site. First and foremost, the calendar view allows users of your site to quickly see events for a given month. Multiple events can be displayed on a single day and there is an option to display a single page for each event, perfect for linking people to an event page from social media!

The plugin uses JavaScript to fetch data, which provides for a fast and easy to use experience for users. The experience in the Dashboard is also very user friendly, as each event is a custom post type with easy to understand fields.

While the plugin can certainly be installed and used right out of the box, there is much room for flexibility and extending the plugin. From styling it to fit your site's theme to adding even more functionality, this plugin was written in an extendable way to fit you as a site owner's or developer's needs.

A lot of time has been spent to make this calendar plugin as user friendly on as many devices as possible. It's fully responsive and works on every modern device it's viewed on. Phone, tablet, laptop or desktop, the user experience is just the same!

There is an abundance of WordPress calendar plugins, but if you're looking for a responsive, easy to get going (and easy for clients to manage) calendar plugin, Smooth calendar is your best bet!

== Features ==

* Responsive
* Supports multiple events on a single day
* "Quick view" of event
* Ability to have single pages for each event (which makes it SEO friendly)
* Customizable colors
* Easily extendable
* Uses custom post types and metadata, which makes creating your own theme very straightforward
* Allows the display of an event title, date, start/end time, location and description
* Google Calendar integration

== Installation ==

1. Upload [`smooth-calendar`](https://github.com/trevanhetzel/smooth-calendar/archive/master.zip) to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Place the calendar in a page using the shortcode `[smooth-calendar`] (optionally place it in a theme file with `<?php echo do_shortcode('[smooth-calendar]'); ?>`)
4. Update the settings by viewing the Settings page under the 'Calendar' tab. If you'd like each event to have its own page, check the 'Enable single pages' checkbox.

== FAQ ==

= How can I modify the "single" template =

The single event template can be overridden by adding a file in your theme called `single-calendar.php`.

= Can I have multiple calendars? =

No. Currently, only one calendar is supported. You could technically display multiple calendars by using categories or tags though.

== Screenshots ==

1. Desktop view

2. Desktop hover view

3. Tablet view

4. Mobile view

5. Mobile hover view

6. Single page view

7. Dashboard view

8. Dashboard edit view

== Changelog ==

= v1.2.1 =
* Add option to add Google Calendar link on single event pages

= v1.2.0 =
* Major change that removes dependency on WP REST API
* Data is now fetched using admin-ajax.php

= v1.1.6 =
* Minor change to version number to retag and show proper assets

= v1.1.5 =
* Update version number in an attempt to get the changes shown on the WP plugin page

= v1.1 =
* Update plugin author and modify paths to screenshots

= v1.0 =
* Initial release

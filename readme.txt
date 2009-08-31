=== Flickr Zoom Badge ===
Contributors: mortenf
Donate link: http://www.mfd-consult.dk/paypal/
Tags: widget, sidebar, flickr, photos
Requires at least: 2.7
Tested up to: 2.8.4
Stable tag: trunk

Show photos from Flickr based on user and/or tag(s), with zoom effect without using Flash.

== Description ==

This plugin gives you a widget, that will display a random collection of photo thumbnails from a flickr account and/or flickr tag set. A JavaScript routine will cycle randomly through the thumbnails, zooming a thumbnail similar to what the Flickr Flash Badge does.

== Installation ==

1. Download Plugin .zip-file.
1. Unzip and upload to the plugin directory, usually at `wp-content/plugins/`.
1. Activate the plugin from the WordPress "Plugin" administration screen.
1. Go to the WordPress "Widget" administration screen, and drag the Flickr Zoom Badge widget onto the sidebar of your choice.
1. Input a Flickr user ID and/or a tag name.
1. Hit "Save".

== Screenshots ==

1. Example

== Frequently Asked Questions ==

= What is my "Flickr ID"? =

Your Flickr ID is a unique string, that is used internally by Flickr. You can find your own by using e.g. [idgettr](http://idgettr.com/) or [What Is My Flickr ID](http://www.adamwlewis.com/articles/what-is-my-flickr-id).

= Can I change the number of thumbnails? =

Yes, but (for now) you have to edit the plugin file yourself. Near the top, it defines the values flickr_zoom_badge_count (the number of thumbnails in each row/column) and flickr_zoom_badge_size (the size of the thumbnails) -- you can change the values as you see fit, although not all values work well.

= I have translated the plugin into another language, now what? =

Great, thanks! Please do leave a comment on the plugin's homepage
[www.mfd-consult.dk/flickr-zoom-badge](http://www.mfd-consult.dk/flickr-zoom-badge/) or send an e-mail with details; I'll make sure it's included in the next version.

= What's in the pipeline? =

A real roadmap isn't in place, but the following features are currently on the to-do list:
* Configuration of number and size of thumbnails through the widget interface.

= Another question? =

If your question isn't answered here, please do leave a comment in the forum or on the plugin's homepage:
[www.mfd-consult.dk/flickr-zoom-badge](http://www.mfd-consult.dk/flickr-zoom-badge/)

== Changelog ==

= 1.1 =
* Added Danish translation.

= 1.0 =
* Initial release.

== License ==

Copyright (c) 2009 Morten Høybye Frederiksen <morten@wasab.dk>

Permission to use, copy, modify, and distribute this software for any
purpose with or without fee is hereby granted, provided that the above
copyright notice and this permission notice appear in all copies.

THE SOFTWARE IS PROVIDED "AS IS" AND THE AUTHOR DISCLAIMS ALL WARRANTIES
WITH REGARD TO THIS SOFTWARE INCLUDING ALL IMPLIED WARRANTIES OF
MERCHANTABILITY AND FITNESS. IN NO EVENT SHALL THE AUTHOR BE LIABLE FOR
ANY SPECIAL, DIRECT, INDIRECT, OR CONSEQUENTIAL DAMAGES OR ANY DAMAGES
WHATSOEVER RESULTING FROM LOSS OF USE, DATA OR PROFITS, WHETHER IN AN
ACTION OF CONTRACT, NEGLIGENCE OR OTHER TORTIOUS ACTION, ARISING OUT OF
OR IN CONNECTION WITH THE USE OR PERFORMANCE OF THIS SOFTWARE.

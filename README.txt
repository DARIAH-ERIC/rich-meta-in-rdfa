=== Rich Meta in RDFa ===
Contributors: yoannspace
Donate link:
Tags: digital humanities, dublin core, rdfa, isidore
Requires at least: 4.9.1
Tested up to: 4.9.1
Requires PHP: 5.6.35
Stable tag: 1.0.0
License: Apache License - 2.0
License URI: http://www.apache.org/licenses/LICENSE-2.0

This WordPress plugin allows users to add some Dublin Core data in RDFa within the HTML page of each post.

== Description ==

This WordPress plugin allows users to add some Dublin Core data in RDFa within the HTML page of each post.
Currently it is all pretty straightforward because it is only used for harvesting by ISIDORE (www.rechercheisidore.fr), but in the future it would be nice to have some tweaks in the admin panel. i.e. Change the namespace and element name of the RDFa data for a given input like title or excerpt.

== Installation ==

1. Upload directory `rich-meta-in-rdfa` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress

== Frequently Asked Questions ==

= ISIDORE can not crawl my website and complains of a @rel attribute within a link element =

Please go to the settings page of the plugin (under Settings in the Dashboard left-side menu) and uncheck the checkbox mentioning the link elements.
It will remove the link elements within the HTML page and will stop causing problems. Don't worry, this setting will not break the website, it will just omit a certain part of the HTML but the functionality will still be available at the correct URL.

= What elements are being created =

Here is the list of elements being created:
    * dc:identifier
    * dc:title
    * dc:description
    * dc:date
    * dc:creator
    * dc:source
    * dc:subject
    * dc:type
    * dc:language

== Screenshots ==

1. Example of the output (in the body element of the HTML, under the entry-content div class)

== Changelog ==

= 1.0.0 =
* Very first version

== Upgrade Notice ==

No upgrade notice for now

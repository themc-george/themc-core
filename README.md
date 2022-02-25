=== TheMC Core ===
Contributors: LinuxArchitect
Donate link: https://themc.network/donation/
Tags: core
Requires at least: 5.9.0
Tested up to: 5.9.1
Stable tag: 0.0.2
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

A core functionality plugin to provide the code needed to operate themc.network.
Probably not useful to others unless you have a site very similar to mine. Making
this plugin customizable is, initially, a low priority.

== Description ==

A WordPress plugin to provide the theme-independent core code needed to operate themc.network

themc.network is a combination multisite config, with a small number of "core" sites plus member sites,
plus some independent sites which might or might not share the multisite users and usermeta tables.

By using a plugin, we keep core code out of the theme which is responsible for the style of the site.
In theory, the site theme can be switched out and/or be used by other sites. This plugin is closely
tied to the features, functionality, and operations of the site and is probably not useful to others
unless they want the exact same site.

== Installation ==

1. Upload `themc-core.php` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Place `<?php do_action('themc_core_hook'); ?>` in your templates

== Frequently Asked Questions ==

= Got a question? =

An answer to that question.

= What about foo bar? =

Do you mean fubar? This should not be an issue.

== Changelog ==

= 0.0.2 =
* switch to oo framework

= 0.0.1 =
* initial version (duh)

== Upgrade Notice ==

= 0.0.1 =
* this is the initial version

== Arbitrary section ==

You may provide arbitrary sections, in the same format as the ones above.  This may be of use for extremely complicated
plugins where more information needs to be conveyed that doesn't fit into the categories of "description" or
"installation."  Arbitrary sections will be shown below the built-in sections outlined above.

== A brief Markdown Example ==

Ordered list:

1. Some feature
1. Another feature
1. Something else about the plugin

Unordered list:

* something
* something else
* third thing

Here's a link to [WordPress](https://wordpress.org/ "Your favorite software") and one to [Markdown's Syntax Documentation][markdown syntax].
Titles are optional, naturally.

[markdown syntax]: https://daringfireball.net/projects/markdown/syntax
            "Markdown is what the parser uses to process much of the readme file"

Markdown uses email style notation for blockquotes and I've been told:
> Asterisks for *emphasis*. Double it up  for **strong**.

`<?php code(); // goes in backticks ?>`

<pre><code>
<?php 
code(); // multiple line code goes into pre/code tags
code(); // multiple line code goes into pre/code tags
code(); // multiple line code goes into pre/code tags
</code></pre>


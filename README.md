# themc-core
A WordPress plugin to provide the theme-independent core code needed to operate themc.network

themc.network is a combination multisite config, with a small number of "core" sites plus member sites,
plus some independent sites which might or might not share the multisite users and usermeta tables.

By using a plugin, we keep core code out of the theme which is responsible for the style of the site.
In theory, the site theme can be switched out and/or be used by other sites. This plugin is closely
tied to the features, functionality, and operations of the site and is probably not useful to others
unless they want the exact same site.

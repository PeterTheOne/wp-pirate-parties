wp-pirate-parties
=================

A wordpress plugin that displays pirate parties as a widget, datasource is the 
[PPI-rest-api](https://github.com/Pirate-Parties-International/PPI-rest-api).

* Author: [Peter Grassberger](http://petergrassberger.com)
* License: MIT

Development with Vagrant
------------------------

* Install [VirtualBox](https://www.virtualbox.org/) and [Vagrant](https://www.vagrantup.com/).
* run ``vagrant up``.

Production Deploy
-----------------

* Install Wordpress on a webserver.
* Move files to ``*wordpress-install-dir*/wp-content/plugins/wp-pirate-parties``
* (You can remove the Vagrantfile).
* Activate the plugin.
* Add the Widget to the Sidebar.

Generate l10n .pot and .mo files
--------------------------------
Run
`xgettext --from-code=utf-8 -k_e -k_x -k__ -o language/wp-pirate-parties.pot $(find . -name "*.php")`.

To create .mo files run
`msgfmt -o wp-pirate-parties-de_DE.mo wp-pirate-parties-de_DE.po`

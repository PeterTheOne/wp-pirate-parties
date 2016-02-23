wp-pirate-parties
=================

A wordpress plugin that displays pirate parties as a widget, datasource is the 
[PPI-rest-api](https://github.com/Pirate-Parties-International/PPI-rest-api).

* Author: [Peter Grassberger](http://petergrassberger.com)
* License: MIT

Flag Icons: [lipis/flag-icon-css](https://github.com/lipis/flag-icon-css)

Usage Widget and Shortcode
--------------------------

* Activate plugin.
* Add Widget to Sidebar.
* user `[pirate-party id="ppat"]` shorcode in post.
* Full shortcode options: `[pirate-party id="ppat" show-logo="1" show-native-name="1" show-membershipsshow-website="1" show-facebook="0" show-twitter="1" show-googleplus="0" show-youtube="0"]`.
* `show-all="1"` overwrites all show options and sets them to `1`.

Development with Vagrant
------------------------

* Install [VirtualBox](https://www.virtualbox.org/) and [Vagrant](https://www.vagrantup.com/).
* Run ``vagrant up``.
* Open `http://localhost:8080/` in your browser.

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
`xgettext --from-code=utf-8 -k_e -k_x -k__ -o languages/wp-pirate-parties.pot $(find . -name "*.php")`.

To create .mo files run
`msgfmt -o wp-pirate-parties-de_DE.mo wp-pirate-parties-de_DE.po`

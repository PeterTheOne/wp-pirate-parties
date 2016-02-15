# -*- mode: ruby -*-
# vi: set ft=ruby :

# All Vagrant configuration is done below. The "2" in Vagrant.configure
# configures the configuration version (we support older styles for
# backwards compatibility). Please don't change it unless you know what
# you're doing.
Vagrant.configure(2) do |config|
  # The most common configuration options are documented and commented below.
  # For a complete reference, please see the online documentation at
  # https://docs.vagrantup.com.

  # Every Vagrant development environment requires a box. You can search for
  # boxes at https://atlas.hashicorp.com/search.
  config.vm.box = "debian/jessie64"

  # Disable automatic box update checking. If you disable this, then
  # boxes will only be checked for updates when the user runs
  # `vagrant box outdated`. This is not recommended.
  # config.vm.box_check_update = false

  # Create a forwarded port mapping which allows access to a specific port
  # within the machine from a port on the host machine. In the example below,
  # accessing "localhost:8080" will access port 80 on the guest machine.
  config.vm.network "forwarded_port", guest: 80, host: 8080

  # Create a private network, which allows host-only access to the machine
  # using a specific IP.
  # config.vm.network "private_network", ip: "192.168.33.10"

  # Create a public network, which generally matched to bridged network.
  # Bridged networks make the machine appear as another physical device on
  # your network.
  # config.vm.network "public_network"

  # Share an additional folder to the guest VM. The first argument is
  # the path on the host to the actual folder. The second argument is
  # the path on the guest to mount the folder. And the optional third
  # argument is a set of non-required options.
  # config.vm.synced_folder "../data", "/vagrant_data"

  # Provider-specific configuration so you can fine-tune various
  # backing providers for Vagrant. These expose provider-specific options.
  # Example for VirtualBox:
  #
  # config.vm.provider "virtualbox" do |vb|
  #   # Display the VirtualBox GUI when booting the machine
  #   vb.gui = true
  #
  #   # Customize the amount of memory on the VM:
  #   vb.memory = "1024"
  # end
  #
  # View the documentation for the provider you are using for more
  # information on available options.

  # Define a Vagrant Push strategy for pushing to Atlas. Other push strategies
  # such as FTP and Heroku are also available. See the documentation at
  # https://docs.vagrantup.com/v2/push/atlas.html for more information.
  # config.push.define "atlas" do |push|
  #   push.app = "YOUR_ATLAS_USERNAME/YOUR_APPLICATION_NAME"
  # end

  # Enable provisioning with a shell script. Additional provisioners such as
  # Puppet, Chef, Ansible, Salt, and Docker are also available. Please see the
  # documentation for more information about their specific syntax and use.
  config.vm.provision "shell", inline: <<-SHELL
    sudo debconf-set-selections <<< 'mysql-server mysql-server/root_password password root'
    sudo debconf-set-selections <<< 'mysql-server mysql-server/root_password_again password root'

    sudo apt-get update
    sudo apt-get install -y apache2 mysql-server php5-common libapache2-mod-php5 php5-cli php-pear php5-mysql software-properties-common

    sudo service apache2 restart

    #sudo apt-key adv --recv-keys --keyserver keyserver.ubuntu.com 0xcbcb082a1bb943db
    #sudo add-apt-repository 'deb [arch=amd64,i386] http://ams2.mirrors.digitalocean.com/mariadb/repo/10.1/debian jessie main'
    #sudo apt-get install -q -y mariadb-server

    #cd /var/www/
    #wget -quiet https://wordpress.org/latest.tar.gz
    #tar -xzf latest.tar.gz

    curl -s -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar
    chmod +x wp-cli.phar
    sudo mv wp-cli.phar /usr/local/bin/wp

    sudo -E wp core download --path=/var/www/html --allow-root
    cd /var/www/html
    sudo -E wp core config --dbname=wordpress --dbuser=root --dbpass=root --dbhost=localhost --allow-root

    sudo echo "define('WP_DEBUG', true); define('WP_DEBUG_LOG', true);" >> wp-config.php

    mysqladmin -u root -proot create wordpress
    sudo -E wp core install --url=localhost:8080 --title=wp-pirate-parties --admin_user=admin --admin_password=password --admin_email=fake@fake.fake --skip-email --path=/var/www/html --allow-root

    sudo rm index.html
    sudo ln -s /vagrant/ /var/www/html/wp-content/plugins/wp-pirate-parties

    sudo -E wp plugin activate wp-pirate-parties --allow-root
    sudo -E wp widget add wp_pirate_parties_widget sidebar-1 1 --title="Pirate Parties" --allow-root
  SHELL
end

#!/usr/bin/env bash

	# Restart any PHP related daemons
	sudo service httpd restart

	################memcache/d stuff end
	#disable the firewall
	sudo service iptables stop
	sudo chkconfig iptables off

	###############composer
    curl -sS https://getcomposer.org/installer | php
    #Move it to /usr/local/bin/
    sudo mv composer.phar /usr/local/bin/composer
    echo "================= MODULES Complete ================="


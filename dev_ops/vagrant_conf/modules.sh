#!/usr/bin/env bash
	################memcache/d stuff begin

	echo "======== Development tools"
	sudo yum groupinstall "Development tools"
	#sudo service memcached start
	#sudo chkconfig memcached on
	#sudo echo "extension=memcached.so" >> /etc/php.d/memcached.ini

	# Restart any PHP related daemons
	sudo service httpd restart

	echo "======== disable the firewall"
	#disable the firewall
	sudo service iptables stop
	sudo chkconfig iptables off

    echo "================= MODULES Complete ================="


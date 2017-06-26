#!/usr/bin/env bash
#config apache, make sure apache auto-boots
	sudo cp /vagrant/dev_ops/vagrant_conf/httpd.conf /etc/httpd/conf/httpd.conf
	sudo cp /vagrant/dev_ops/vagrant_conf/php.ini /etc/php.ini
	sudo chkconfig httpd on

	sudo service httpd start
	echo "================= Apache Complete ================="

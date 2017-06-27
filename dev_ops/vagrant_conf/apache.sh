#!/usr/bin/env bash

echo "================= Apache Install & Configuration ================="
sudo yum clean all
sudo yum -y update
sudo yum -y install httpd
sudo firewall-cmd --permanent --add-port=80/tcp
sudo firewall-cmd --permanent --add-port=443/tcp
sudo firewall-cmd --reload
sudo systemctl enable httpd

#config apache, make sure apache auto-boots
#sudo cp /vagrant/dev_ops/vagrant_conf/httpd.conf /etc/httpd/conf/httpd.conf
#sudo cp /vagrant/dev_ops/vagrant_conf/php.ini /etc/php.ini
sudo chkconfig httpd on


echo "======== disable the firewall"
#disable the firewall
sudo service iptables stop
sudo chkconfig iptables off

sudo service httpd start
echo "================= Apache Complete ================="

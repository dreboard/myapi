#!/usr/bin/env bash

echo "======== Development tools"

rpm -Uvh https://dl.fedoraproject.org/pub/epel/epel-release-latest-7.noarch.rpm
rpm -Uvh https://mirror.webtatic.com/yum/el7/webtatic-release.rpm
sudo yum -y update

sudo yum groupinstall "Development tools"
#sudo service memcached start
#sudo chkconfig memcached on
#sudo echo "extension=memcached.so" >> /etc/php.d/memcached.ini

echo "================= MODULES Complete ================="


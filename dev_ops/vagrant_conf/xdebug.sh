#!/usr/bin/env bash
sudo cp ./dev_ops/vagrant_conf/xdebug.ini /etc/php.d/xdebug.ini
sudo service httpd restart
echo "================= XDEBUG Complete ================="
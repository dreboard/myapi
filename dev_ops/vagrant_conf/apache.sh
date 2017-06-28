#!/bin/bash

# setup hosts file

VFILE='/etc/httpd/conf.d/api.conf'
VHOST=$(cat <<EOF
<VirtualHost *:80>
            ServerName api.dev
            ServerAlias www.api.dev
            DocumentRoot "/var/www/api/public"
            ServerAdmin incentisoft@gmail.com
            ErrorLog /var/www/api/logs/error.log
            <Directory "/var/www/api">
                    Options Indexes FollowSymLinks Includes ExecCGI
                    AllowOverride All
                    Require all granted
            </Directory>
        </VirtualHost>
EOF
)


echo "================= Apache Install & Configuration ================="
sudo yum clean all
sudo yum -y update
sudo yum -y install httpd
sudo systemctl enable httpd

#config apache, make sure apache auto-boots
#sudo cp /dev_ops/vagrant_conf/httpd.conf /etc/httpd/conf/httpd.conf
#sudo cp /vagrant/dev_ops/vagrant_conf/php.ini /etc/php.ini

sudo service httpd start

if [ "! -d /var/www/api" ] ; then
    sudo mkdir -p /var/www/api/public
    sudo mkdir /var/www/api/logs
    chown -R apache. /var/www/api
    chmod -R 755 /var/www/api
  echo "-------------------directories created---------------------"
else
  echo "-------------------No directories needed---------------------"
fi

if [ "! /etc/httpd/conf.d/api.conf" ] ; then
    sudo touch $VFILE
  echo "-------------------file  created---------------------"
else
    sudo cp /dev/null $VFILE
  echo "-------------------No directories needed---------------------"
fi

echo "${VHOST}" > /etc/httpd/conf.d/api.conf

#sudo cp -f ./dev_ops/apache/api.conf /etc/httpd/conf.d
sudo chkconfig httpd on

sudo service httpd restart
echo "================= Apache Complete ================="

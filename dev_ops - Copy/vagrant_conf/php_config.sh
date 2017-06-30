#!/usr/bin/env bash
# Install php modules and composer
# Package list
# https://webtatic.com/packages/php71/

# ================= php71w-common also install the below modules =================
# php-api, php-bz2, php-calendar, php-ctype, php-curl, php-date, php-exif, php-fileinfo, php-filter, php-ftp, php-gettext, php-gmp, php-hash,
# php-iconv, php-json, php-libxml, php-openssl, php-pcre, php-pecl-Fileinfo, php-pecl-phar, php-pecl-zip, php-reflection, php-session, php-shmop,
# php-simplexml, php-sockets, php-spl, php-tokenizer, php-zend-abi, php-zip, php-zlib

sudo rpm -Uvh https://dl.fedoraproject.org/pub/epel/epel-release-latest-7.noarch.rpm
sudo rpm -Uvh https://mirror.webtatic.com/yum/el7/webtatic-release.rpm

echo "================= Installing PHP Core ================="
sudo yum -y install mod_php71w php71w-cli php71w-common php71w-gd php71w-mbstring php71w-mcrypt php71w-mysql php71w-pdo php71w-xml php71w-soap php71w-pecl-imagick

echo "================= Installing PHP Runtime Mods ================="
sudo yum -y install  php71w-opcache php71w-pecl-memcached php71w-pecl-redis php71w-pecl-xdebug

echo "================= Installing PHP Utilities ================="
sudo yum -y install php71w-phpdbg php71w-tidy php71w-pear

echo "================= XDEBUG Configure ================="
sudo cp /vagrant/dev_ops/vagrant_conf/xdebug.ini /etc/php.d/xdebug.ini

echo "================= Installing Composer ================="
curl -sS https://getcomposer.org/installer | php
#Move it to /usr/local/bin/
sudo mv composer.phar /usr/local/bin/composer

echo "================= Installing phpunit ================="
wget https://phar.phpunit.de/phpunit-6.1.phar
chmod +x phpunit-6.1.phar
sudo mv phpunit-6.1.phar /usr/local/bin/phpunit
sudo service httpd restart
echo "================= PHP Complete ================="


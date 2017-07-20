# My API

Base API built with the Slim framework (v3.7).

## Automation and provisioning

We will use as much automation as possible during provisioning so that our scripts can be used. Though it's important to note that some scripts rely on others, order of execution can be important and there are many setting changes that are designed for dev environments only.  

## Requirements

You can use this system on any computer that can run the following software, it's completely platform independent.

- [VirtualBox](http://www.virtualbox.org/wiki/Downloads) 
- [Vagrant](http://www.vagrantup.com/downloads)

#### The base box was built with virtualbox 5.1.18 / vagrant 1.9.2

## Components

- This will run the default webserver with the default php modules we need installed.

|Script               |Name|Version|Repo|Description|
|---------------------|--------|-------|----|-----------|
|Vagrantfile            |Linux             |16.04|Ubuntu|Xenial64
|apache.sh            |Apache             |2.x|CentOS|Mounts the ./public dir to webroot, installs Apache
|php.sh            |PHP                |7.1.x|Webtatic EL7|Installs PHP 7.1, restarts Apache
|php-mcrypt.sh        |PHP Mcrypt extension|-|EPEL|Installs Mcrypt. Only needed for PHP 5.3.x as 5.5 has it built-in.
|xdebug.sh 		      |Xdebug extension   |-|PECL|Install Xdebug extension for debugging purposes.
|composer.sh          |Composer|1.4.2|getcomposer.org|Installs PHP's composer package manager
|bootstrap.sh         |Internal|1.0.0|-|Various bootstrap tasks and snag fixes

There will be more modules to follow as we develop this shell.

#### Composer
- Inside the assets folder move the two scripts post-merge/post-receive into the git/hooks folder
- These hooks will install updates and run the autoloader on git pull
- Composer dependancies will auto install from inline provision


#### PHPStorm vagrant setup

- [Configuring a remote PHP interpreter in a Vagrant environment ](https://www.jetbrains.com/help/phpstorm/configuring-remote-php-interpreters.html)
- [Using Composer Dependency Manager](https://www.jetbrains.com/help/phpstorm/using-composer-dependency-manager.html)




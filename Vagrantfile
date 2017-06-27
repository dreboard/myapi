# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure(2) do |config|

config.ssh.insert_key = false

  config.vm.box = "centos_6.5_x64"
  config.vm.box_url = "https://github.com/2creatives/vagrant-centos/releases/download/v6.5.3/centos65-x86_64-20140116.box"

  # Prevent localhost server conflict
  config.vm.network "forwarded_port", guest: 80, host: 8800, auto_correct: true

  # update the base server
  config.vm.provision "shell", inline: <<-SHELL
	sudo rpm -Uvh https://dl.fedoraproject.org/pub/epel/epel-release-latest-7.noarch.rpm
         rpm -Uvh https://mirror.webtatic.com/yum/el7/webtatic-release.rpm
	sudo yum -y update
  SHELL

  ## Provisioners, running vagrant provision will run all named provisions below
  # EXAMPLE: vagrant provision --provision-with name
  config.vm.provision "modules", type: "shell", path: "./dev_ops/vagrant_conf/modules.sh"
  config.vm.provision "apache", type: "shell", path: "./dev_ops/vagrant_conf/apache.sh"
  config.vm.provision "php_config", type: "shell", path: "./dev_ops/vagrant_conf/php_config.sh"
  config.vm.provision "xdebug", type: "shell", path: "./dev_ops/vagrant_conf/xdebug.sh"

end

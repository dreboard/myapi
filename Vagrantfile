# -*- mode: ruby -*-
# vi: set ft=ruby :

#------PLUGINS REQUIRED
#vagrant plugin install vagrant-vbguest
#vagrant plugin install vagrant-scp

Vagrant.configure("2") do |config|
  config.vm.box = "bento/centos-7.1"

  config.vm.network "forwarded_port", guest: 80, host: 8008
  config.vm.boot_timeout = 600
  # config.vm.network "private_network", ip: "192.168.33.10"


  config.vbguest.auto_update = false
  config.vm.synced_folder "./public", "/var/www/api", create: true,
    :owner => "vagrant",
    :group => "vagrant",
    :mount_options => ["dmode=777,fmode=777"]

  #config.vm.synced_folder ".", "/vagrant", type: "virtualbox"
  #config.vm.synced_folder "./", "/var/www/api", type: "virtualbox", disabled: true
  config.vm.hostname = "www.api.dev"

  config.vm.provider "virtualbox" do |vb|
    # Customize the amount of memory on the VM:
    vb.memory = "512"
  end

  # Environment setup
  ## vagrant provision --provision-with apache
  config.vm.provision "bootstrap", type: "shell", path: "./dev_ops/vagrant_conf/bootstrap.sh"
  config.vm.provision "apache", type: "shell", path: "./dev_ops/vagrant_conf/apache.sh"
  config.vm.provision "php", type: "shell", path: "./dev_ops/vagrant_conf/php_config.sh"
  config.vm.provision "complete", type: "shell", path: "./dev_ops/vagrant_conf/complete.sh"

end

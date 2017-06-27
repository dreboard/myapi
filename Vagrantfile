# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure("2") do |config|
  config.vm.box = "centos/7"

  config.vm.network "forwarded_port", guest: 80, host: 8099
  config.vm.boot_timeout = 600
  # config.vm.network "private_network", ip: "192.168.33.10"

  config.vm.synced_folder ".", "/vagrant", type: "virtualbox", disabled: true
  config.vm.hostname = "www.api.dev"

  config.vm.provider "virtualbox" do |vb|
    # Customize the amount of memory on the VM:
    vb.memory = "512"
  end

  # Environment setup
  ## vagrant provision --provision-with apache
  config.vm.provision "bootstrap", type: "shell", path: "./dev_ops/vagrant_conf/bootstrap.sh"
  config.vm.provision "server_tools", type: "shell", path: "./dev_ops/vagrant_conf/apache.sh"
  config.vm.provision "php_mods", type: "shell", path: "./dev_ops/vagrant_conf/php_config.sh"

end

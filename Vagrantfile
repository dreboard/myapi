# -*- mode: ruby -*-
# vi: set ft=ruby :

VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|

  config.vm.box = "ubuntu/trusty64"
  config.vm.network "forwarded_port", guest: 80, host: 8888
  config.vm.provider "virtualbox" do |vb|
    vb.memory = "512"
  end
  config.vm.synced_folder "./", "/var/www/my_api"

  config.vm.provision "bootstrap", type: "shell", path: "./dev_ops/vagrant_conf/all_in_one.sh"

end
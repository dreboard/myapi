# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure("2") do |config|

  #---Box config---

  config.vm.box = "bento/centos-7.3"

  config.vm.provider 'virtualbox' do |v|
    v.linked_clone = true if Vagrant::VERSION =~ /^1.8/
  end

  #---Cachier plugin---

  if Vagrant.has_plugin?("vagrant-cachier")
	  # Configure cached packages to be shared between instances of the same base box.
	  # More info on http://fgrehm.viewdocs.io/vagrant-cachier/usage
	  config.cache.scope = :box

	  # OPTIONAL: If you are using VirtualBox, you might want to use that to enable
	  # NFS for shared folders. This is also very useful for vagrant-libvirt if you
	  # want bi-directional sync
	  #config.cache.synced_folder_opts = {
		#type: :nfs,
		# The nolock option can be useful for an NFSv3 client that wants to avoid the
		# NLM sideband protocol. Without this option, apt-get might hang if it tries
		# to lock files needed for /var/cache/* operations. All of this can be avoided
		# by using NFSv4 everywhere. Please note that the tcp option is not the default.
		#mount_options: ['rw', 'vers=3', 'tcp', 'nolock']
	  #}
	  # For more information please check http://docs.vagrantup.com/v2/synced-folders/basic_usage.html
  end

  #---Networking---

  # Port forward 80 to 8080
  config.vm.network :forwarded_port, guest: 80, host: 7000, auto_correct: true
  config.vm.network :forwarded_port, guest: 3306, host: 3306, auto_correct: true

  config.vm.provision :shell, :path => "./dev_ops/scripts/mount-webroot.sh"
  config.vm.provision :shell, :path => "./dev_ops/scripts/php.sh", :args => "-v 5.6 -m 256 -t UTC"
  config.vm.provision :shell, :path => "./dev_ops/scripts/php-mcrypt.sh"
  config.vm.provision :shell, :path => "./dev_ops/scripts/composer.sh"
  config.vm.provision :shell, :path => "./dev_ops/scripts/apache.sh"
  #config.vm.provision :shell, :path => "./dev_ops/scripts/xdebug.sh"
  config.vm.provision :shell, :path => "./dev_ops/scripts/silverstripe-tasks.sh"
  #config.vm.provision :shell, :path => "./dev_ops/scripts/mailcatcher.sh"
  config.vm.provision :shell, :path => "./dev_ops/scripts/bootstrap.sh"
  config.vm.provision :shell, :path => "./dev_ops/scripts/always.sh", run: "always"

end

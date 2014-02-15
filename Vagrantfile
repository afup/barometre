require 'yaml'

VAGRANT_CONFIG = YAML::load_file("provisioning/vagrant.yml")

Vagrant.configure("2") do |config|
    config.vm.box = VAGRANT_CONFIG["virtual_machine"]["name"]
    config.vm.box_url = "http://dl.dropbox.com/u/54390273/vagrantboxes/Squeeze64_VirtualBox4.2.4.box"
    config.vm.network "private_network", ip: VAGRANT_CONFIG["network"]["ip_address"]

    # Share application files between host and guest with NFS
    config.vm.synced_folder "./", "/var/www/barometre", :nfs => true

    config.vm.usable_port_range = (2200..2250)
    config.vm.provider :virtualbox do |virtualbox|
        virtualbox.customize ["modifyvm", :id, "--name", VAGRANT_CONFIG["virtual_machine"]["name"]]
        virtualbox.customize ["modifyvm", :id, "--natdnshostresolver1", "on"]
        virtualbox.customize ["modifyvm", :id, "--memory", VAGRANT_CONFIG["virtual_machine"]["memory"]]
        virtualbox.customize ["setextradata", :id, "--VBoxInternal2/SharedFoldersEnableSymlinksCreate/v-root", "1"]
    end

    config.vm.provision :shell, :path => "provisioning/shell.sh"

    config.ssh.username = "vagrant"
    config.ssh.shell = "bash -l"
    config.ssh.shell = "bash -c 'BASH_ENV=/etc/profile exec bash'"
end


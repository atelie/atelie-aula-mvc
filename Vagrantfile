# Vagrantfile API/syntax version. Don't touch unless you know what you're doing!
VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|

  config.vm.define :development do |dev|

    dev.vm.box = "ubuntu-server-64"
    dev.vm.box_url = "http://grahamc.com/vagrant/ubuntu-12.04-omnibus-chef.box"

    dev.vm.network :forwarded_port, guest: 80, host: 8081
    dev.omnibus.chef_version = :latest

    dev.vm.synced_folder "app/tmp", "/vagrant/app/tmp", id: "vagrant-root",
      owner: "vagrant",
      group: "vagrant",
      mount_options: ["dmode=777,fmode=777"]

    dev.vm.synced_folder "app/webroot/img", "/vagrant/app/webroot/img", id: "vagrant-root",
      owner: "vagrant",
      group: "vagrant",
      mount_options: ["dmode=777,fmode=777"]

    dev.vm.network :private_network, ip: '10.10.20.20'
    dev.vm.provider :virtualbox do |vb|
      vb.customize ["modifyvm", :id, "--memory", "1024"]
    end

    dev.vm.provision :chef_solo do |chef|
      chef.json = {
        mysql: { server_root_password: "", server_repl_password: "", server_debian_password: "" },
        environment: 'development'
      }

      chef.cookbooks_path = "chef/cookbooks"
      chef.add_recipe 'default'
    end

    dev.vm.provision :shell, path: 'vagrant_scripts/after_script.sh'
  end

end
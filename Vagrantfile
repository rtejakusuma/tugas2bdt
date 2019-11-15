Vagrant.configure("2") do |config|

  (1..2).each do |i|
    config.vm.define "config_#{i}" do |node|
      node.vm.hostname = "config-#{i}"
      node.vm.box = "bento/ubuntu-16.04"
      node.vm.network "private_network", ip: "192.168.12.#{i+1}"

      node.vm.provider "virtualbox" do |vb|
        vb.name = "config-#{i}"
        vb.gui = false
        vb.memory = "512"
      end

      node.vm.provision "shell", path: "bash/config_#{i}.sh", privileged: false
    end
  end

  (1..3).each do |i|
    config.vm.define "shard_#{i}" do |node|
    node.vm.hostname = "shard-#{i}"
    node.vm.box = "bento/ubuntu-16.04"
    node.vm.network "private_network", ip: "192.168.12.#{3+i}"
        
    node.vm.provider "virtualbox" do |vb|
      vb.name = "shard-#{i}"
      vb.gui = false
      vb.memory = "512"
    end

    node.vm.provision "shell", path: "bash/shard_#{i}.sh", privileged: false
    end
  end

  config.vm.define "router" do |mongo_query_router|
    mongo_query_router.vm.hostname = "router"
    mongo_query_router.vm.box = "bento/ubuntu-16.04"
    mongo_query_router.vm.network "private_network", ip: "192.168.12.1"
    
    mongo_query_router.vm.provider "virtualbox" do |vb|
      vb.name = "router"
      vb.gui = false
      vb.memory = "512"
    end

    mongo_query_router.vm.provision "shell", path: "bash/router.sh", privileged: false
  end

end
# Tugas 2 BDT - Implementasi MongoDB
Raden Teja Kusuma (05111640000012)

## Deskripsi Tugas
1. Implementasi Cluster MongoDB
    - Menggunakan versi MongoDB:4.2
    - Menggunakan vagrant/docker
    - Cluster terdiri:
        - Config server: 2
        - Shard server: 3
        - Query router:1
2. Menggunakan Dataset
    - Menggunakan dataset `CSV` atau `JSON` > 1000 data
    - Import ke dalam server MongoDB 
3. Implementasi CRUD
    - Menggunakan bahasa pemrograman yang support dengan connector MongoDB
    - Menggunakan web/API/scripting
    - Harus ada operasi CRUD
    - Ada 2 contoh agregrasi
## Spesifikasi
1. Config Server
    - `config_1`
        - OS : `bento/ubuntu-18.04`
        - RAM : `512` MB
        - IP : `192.168.12.2`
    - `config_2`
        - OS : `bento/ubuntu-18.04`
        - RAM : `512` MB
        - IP : `192.168.12.3`
2. Shard Server
    - `shard_1`
        - OS : `bento/ubuntu-18.04`
        - RAM : `512` MB
        - IP : `192.168.12.4`
    - `shard_2`
        - OS : `bento/ubuntu-18.04`
        - RAM : `512` MB
        - IP : `192.168.12.5`
    - `shard_3`
        - OS : `bento/ubuntu-18.04`
        - RAM : `512` MB
        - IP : `192.168.12.6`
3. Query Router
    - `router`
        - OS : `bento/ubuntu-18.04`
        - RAM : `512` MB
        - IP : `192.168.12.7`
## Konfigurasi Vagrant
1. `Vagrantfile`
    ```bash
    Vagrant.configure("2") do |config|

    (1..2).each do |i|
        config.vm.define "config_#{i}" do |node|
        node.vm.hostname = "config-#{i}"
        node.vm.box = "bento/ubuntu-18.04"
        node.vm.network "private_network", ip: "192.168.12.#{i+1}"

        node.vm.provider "virtualbox" do |vb|
            vb.name = "config-#{i}"
            vb.gui = false
            vb.memory = "512"
        end

        node.vm.provision "shell", path: "sh/config-#{i}.sh", privileged: false
        end
    end

    (1..3).each do |i|
        config.vm.define "shard_#{i}" do |node|
        node.vm.hostname = "shard-#{i}"
        node.vm.box = "bento/ubuntu-18.04"
        node.vm.network "private_network", ip: "192.168.12.#{3+i}"
            
        node.vm.provider "virtualbox" do |vb|
        vb.name = "shard-#{i}"
        vb.gui = false
        vb.memory = "512"
        end

        node.vm.provision "shell", path: "sh/shard-#{i}.sh", privileged: false
        end
    end

    config.vm.define "router" do |mongo_query_router|
        mongo_query_router.vm.hostname = "router"
        mongo_query_router.vm.box = "bento/ubuntu-18.04"
        mongo_query_router.vm.network "private_network", ip: "192.168.12.7"
        
        mongo_query_router.vm.provider "virtualbox" do |vb|
        vb.name = "router"
        vb.gui = false
        vb.memory = "512"
        end

        mongo_query_router.vm.provision "shell", path: "sh/router.sh", privileged: false
    end

    end
    ```
2. Provision
    - `allhost.sh`
    ```bash
    # Add hostname
    sudo cp /vagrant/sources/hosts /etc/hosts

    # Copy APT sources list
    sudo cp '/vagrant/sources/sources.list' '/etc/apt/'
    sudo cp '/vagrant/sources/mongodb.list' '/etc/apt/sources.list.d/'

    sudo apt-key adv --keyserver hkp://keyserver.ubuntu.com:80 --recv 4B7C549A058F8B6B

    # Update Repository
    sudo apt-get update
    # sudo apt-get upgrade -y

    # Install MongoDB
    sudo apt-get install -y mongodb-org

    # Start MongoDB
    sudo service mongod start
    ```
    - `config-1.sh`
    ```bash
    sudo bash /vagrant/sh/allhost.sh

    # Override mongod config with current config
    sudo cp /vagrant/conf/configserver1.conf /etc/mongod.conf

    # Restart the mongo service 
    sudo systemctl restart mongod

    # weird
    # sleep 5 

    # Create administratif 
    # mongo mongo-config-1:27019 < /vagrant/mongo/create_admin.mongo

    # Init replica set
    # mongo mongo-config-1:27017 -u mongo-admin -p --authenticationDatabase admin < /vagrant/mongo/init_repl_set.mongo
    ```
    - `config-2.sh`
    ```bash
    sudo bash /vagrant/sh/allhost.sh

    # Override mongod config with current config
    sudo cp /vagrant/conf/configserver2.conf /etc/mongod.conf

    # Restart the mongo service 
    sudo systemctl restart mongod

    # weird
    # sleep 5 

    # Create administratif 
    # mongo mongo-config-1:27019 < /vagrant/mongo/create_admin.mongo

    # Init replica set
    # mongo mongo-config-1:27017 -u mongo-admin -p --authenticationDatabase admin < /vagrant/mongo/init_repl_set.mongo
    ```
    - `router.sh`
    ```bash
    sudo bash /vagrant/sh/allhost.sh

    # Override mongod config with current config
    sudo cp /vagrant/conf/router.conf /etc/mongos.conf

    # Create new service file
    sudo touch /lib/systemd/system/mongos.service
    sudo cp /vagrant/mongos.service /lib/systemd/system/mongos.service

    # Stop current mongo service
    sudo systemctl stop mongod

    # Enable mongos.service
    sudo systemctl enable mongos.service
    sudo systemctl start mongos

    # Confirm mongos is running
    systemctl status mongos
    ```
    - `shard-1.sh`
    ```bash
    sudo bash /vagrant/sh/allhost.sh

    # Override mongod config with current config
    sudo cp /vagrant/conf/shardserver1.conf /etc/mongod.conf

    # Restart the mongo service 
    sudo systemctl restart mongod

    # weird
    #sleep 5

    # Add shards
    # mongo mongo-query-router:27017 -u mongo-admin -p --authenticationDatabase admin < /vagrant/mongo/add_shards.mongo

    # Enable shards
    # mongo mongo-query-router:27017 -u mongo-admin -p --authenticationDatabase admin < /vagrant/mongo/enable_shard.mongo
    ```
    - `shard-2.sh`
    ```bash
    sudo bash /vagrant/sh/allhost.sh

    # Override mongod config with current config
    sudo cp /vagrant/conf/shardserver2.conf /etc/mongod.conf

    # Restart the mongo service 
    sudo systemctl restart mongod

    # weird
    #sleep 5

    # Add shards
    # mongo mongo-query-router:27017 -u mongo-admin -p --authenticationDatabase admin < /vagrant/mongo/add_shards.mongo

    # Enable shards
    # mongo mongo-query-router:27017 -u mongo-admin -p --authenticationDatabase admin < /vagrant/mongo/enable_shard.mongo
    ```
    - `shard-3.sh`
    ```bash
    sudo bash /vagrant/sh/allhost.sh

    # Override mongod config with current config
    sudo cp /vagrant/conf/shardserver3.conf /etc/mongod.conf

    # Restart the mongo service 
    sudo systemctl restart mongod

    # weird
    #sleep 5

    # Add shards
    # mongo mongo-query-router:27017 -u mongo-admin -p --authenticationDatabase admin < /vagrant/mongo/add_shards.mongo

    # Enable shards
    # mongo mongo-query-router:27017 -u mongo-admin -p --authenticationDatabase admin < /vagrant/mongo/enable_shard.mongo
    ```
3. Config
    - `configserver1.conf`
    ```bash
    # mongod.conf

    # for documentation of all options, see:
    #   http://docs.mongodb.org/manual/reference/configuration-options/

    # where to write logging data.
    systemLog:
    destination: file
    logAppend: true
    path: /var/log/mongodb/mongod.log

    # Where and how to store data.
    storage:
    dbPath: /var/lib/mongodb
    journal:
        enabled: true
    #  engine:
    #  wiredTiger:

    # how the process runs
    processManagement:
    timeZoneInfo: /usr/share/zoneinfo

    # network interfaces
    net:
    port: 27019
    bindIp: 192.168.12.2

    #security:

    #operationProfiling:

    replication:
    replSetName: configReplSet

    sharding:
    clusterRole: "configsvr"
    
    ## Enterprise-Only Options

    #auditLog:

    #snmp:
    ```
    - `configserver2.conf`
    ```bash
    # mongod.conf

    # for documentation of all options, see:
    #   http://docs.mongodb.org/manual/reference/configuration-options/

    # where to write logging data.
    systemLog:
    destination: file
    logAppend: true
    path: /var/log/mongodb/mongod.log

    # Where and how to store data.
    storage:
    dbPath: /var/lib/mongodb
    journal:
        enabled: true
    #  engine:
    #  wiredTiger:

    # how the process runs
    processManagement:
    timeZoneInfo: /usr/share/zoneinfo

    # network interfaces
    net:
    port: 27019
    bindIp: 192.168.12.3

    #security:

    #operationProfiling:

    replication:
    replSetName: configReplSet

    sharding:
    clusterRole: "configsvr"
    
    ## Enterprise-Only Options

    #auditLog:

    #snmp:
    ```
    - `router.conf`
    ```bash
    # where to write logging data.
    systemLog:
    destination: file
    logAppend: true
    path: /var/log/mongodb/mongos.log

    # network interfaces
    net:
    port: 27017
    bindIp: 192.168.12.7

    sharding:
    configDB: configReplSet/config-1:27019,config-2:27019
    ```
    - `shardserver1.conf`
    ```bash
    # mongod.conf

    # for documentation of all options, see:
    #   http://docs.mongodb.org/manual/reference/configuration-options/

    # where to write logging data.
    systemLog:
    destination: file
    logAppend: true
    path: /var/log/mongodb/mongod.log

    # Where and how to store data.
    storage:
    dbPath: /var/lib/mongodb
    journal:
        enabled: true
    #  engine:
    #  wiredTiger:

    # how the process runs
    processManagement:
    timeZoneInfo: /usr/share/zoneinfo

    # network interfaces
    net:
    port: 27017
    bindIp: 192.168.12.4


    #security:

    #operationProfiling:

    #replication:

    sharding:
    clusterRole: "shardsvr"
    
    ## Enterprise-Only Options

    #auditLog:

    #snmp:
    ```
    - `shardserver1.conf`
    ```bash
    # mongod.conf

    # for documentation of all options, see:
    #   http://docs.mongodb.org/manual/reference/configuration-options/

    # where to write logging data.
    systemLog:
    destination: file
    logAppend: true
    path: /var/log/mongodb/mongod.log

    # Where and how to store data.
    storage:
    dbPath: /var/lib/mongodb
    journal:
        enabled: true
    #  engine:
    #  wiredTiger:

    # how the process runs
    processManagement:
    timeZoneInfo: /usr/share/zoneinfo

    # network interfaces
    net:
    port: 27017
    bindIp: 192.168.12.5


    #security:

    #operationProfiling:

    #replication:

    sharding:
    clusterRole: "shardsvr"
    
    ## Enterprise-Only Options

    #auditLog:

    #snmp:
    ```
    - `shardserver1.conf`
    ```bash
    # mongod.conf

    # for documentation of all options, see:
    #   http://docs.mongodb.org/manual/reference/configuration-options/

    # where to write logging data.
    systemLog:
    destination: file
    logAppend: true
    path: /var/log/mongodb/mongod.log

    # Where and how to store data.
    storage:
    dbPath: /var/lib/mongodb
    journal:
        enabled: true
    #  engine:
    #  wiredTiger:

    # how the process runs
    processManagement:
    timeZoneInfo: /usr/share/zoneinfo

    # network interfaces
    net:
    port: 27017
    bindIp: 192.168.12.6


    #security:

    #operationProfiling:

    #replication:

    sharding:
    clusterRole: "shardsvr"
    
    ## Enterprise-Only Options

    #auditLog:

    #snmp:
    ```
4. Sources
    - `hosts`
    ```bash
    192.168.12.2 config-1
    192.168.12.3 config-2
    192.168.12.4 shard-1
    192.168.12.5 shard-2
    192.168.12.6 shard-3
    192.168.12.7 router
    ```
    - `mongodb.list`
    ```bash
    deb [ arch=amd64 ] https://repo.mongodb.org/apt/ubuntu bionic/mongodb-org/4.2 multiverse
    ```
    - `sources.list`
    ```bash
    ## Note, this file is written by cloud-init on first boot of an instance
    ## modifications made here will not survive a re-bundle.
    ## if you wish to make changes you can:
    ## a.) add 'apt_preserve_sources_list: true' to /etc/cloud/cloud.cfg
    ##     or do the same in user-data
    ## b.) add sources in /etc/apt/sources.list.d
    ## c.) make changes to template file /etc/cloud/templates/sources.list.tmpl

    # See http://help.ubuntu.com/community/UpgradeNotes for how to upgrade to
    # newer versions of the distribution.
    # deb http://archive.ubuntu.com/ubuntu bionic main restricted
    # deb-src http://archive.ubuntu.com/ubuntu bionic main restricted

    deb http://boyo.its.ac.id/ubuntu bionic main restricted

    ## Major bug fix updates produced after the final release of the
    ## distribution.
    # deb http://archive.ubuntu.com/ubuntu bionic-updates main restricted
    # deb-src http://archive.ubuntu.com/ubuntu bionic-updates main restricted

    deb http://boyo.its.ac.id/ubuntu bionic-updates main restricted

    ## N.B. software from this repository is ENTIRELY UNSUPPORTED by the Ubuntu
    ## team. Also, please note that software in universe WILL NOT receive any
    ## review or updates from the Ubuntu security team.
    # deb http://archive.ubuntu.com/ubuntu bionic universe
    # deb-src http://archive.ubuntu.com/ubuntu bionic universe
    # deb http://archive.ubuntu.com/ubuntu bionic-updates universe
    # deb-src http://archive.ubuntu.com/ubuntu bionic-updates universe

    deb http://boyo.its.ac.id/ubuntu bionic universe
    deb http://boyo.its.ac.id/ubuntu bionic-updates universe

    ## N.B. software from this repository is ENTIRELY UNSUPPORTED by the Ubuntu
    ## team, and may not be under a free licence. Please satisfy yourself as to
    ## your rights to use the software. Also, please note that software in
    ## multiverse WILL NOT receive any review or updates from the Ubuntu
    ## security team.
    # deb http://archive.ubuntu.com/ubuntu bionic multiverse
    # deb-src http://archive.ubuntu.com/ubuntu bionic multiverse
    # deb http://archive.ubuntu.com/ubuntu bionic-updates multiverse
    # deb-src http://archive.ubuntu.com/ubuntu bionic-updates multiverse

    deb http://boyo.its.ac.id/ubuntu bionic multiverse
    deb http://boyo.its.ac.id/ubuntu bionic-updates multiverse

    ## N.B. software from this repository may not have been tested as
    ## extensively as that contained in the main release, although it includes
    ## newer versions of some applications which may provide useful features.
    ## Also, please note that software in backports WILL NOT receive any review
    ## or updates from the Ubuntu security team.
    # deb http://archive.ubuntu.com/ubuntu bionic-backports main restricted universe multiverse
    # deb-src http://archive.ubuntu.com/ubuntu bionic-backports main restricted universe multiverse

    deb http://boyo.its.ac.id/ubuntu bionic-backports main restricted universe multiverse

    ## Uncomment the following two lines to add software from Canonical's
    ## 'partner' repository.
    ## This software is not part of Ubuntu, but is offered by Canonical and the
    ## respective vendors as a service to Ubuntu users.
    # deb http://archive.canonical.com/ubuntu bionic partner
    # deb-src http://archive.canonical.com/ubuntu bionic partner

    # deb http://security.ubuntu.com/ubuntu bionic-security main restricted
    # deb-src http://security.ubuntu.com/ubuntu bionic-security main restricted
    # deb http://security.ubuntu.com/ubuntu bionic-security universe
    # deb-src http://security.ubuntu.com/ubuntu bionic-security universe
    # deb http://security.ubuntu.com/ubuntu bionic-security multiverse
    # deb-src http://security.ubuntu.com/ubuntu bionic-security multiverse

    deb http://boyo.its.ac.id/ubuntu bionic-security main restricted
    deb http://boyo.its.ac.id/ubuntu bionic-security universe
    deb http://boyo.its.ac.id/ubuntu bionic-security multiverse
    ```
5. File Tambahan
    - `mongos.service`
    ```bash
    [Unit]
    Description=Mongo Cluster Router
    After=network.target

    [Service]
    User=mongodb
    Group=mongodb
    ExecStart=/usr/bin/mongos --config /etc/mongos.conf
    # file size
    LimitFSIZE=infinity
    # cpu time
    LimitCPU=infinity
    # virtual memory size
    LimitAS=infinity
    # open files
    LimitNOFILE=64000
    # processes/threads
    LimitNPROC=64000
    # total threads (user+kernel)
    TasksMax=infinity
    TasksAccounting=false

    [Install]
    WantedBy=multi-user.target
    ```
## Konfigurasi MongoDB
1. Konfigurasi Replica Set
    - Masuk ke salah satu config server
    ```bash
    sudo vagrant ssh config_1
    ```
    - Masuk ke `shell` mongo
    ```bash
    mongo config-1:27019
    ```
    - Instalasi replica set
    ```bash
    rs.initiate( { _id: "configReplSet", configsvr: true, members: [ { _id: 0, host: "config-1:27019" }, { _id: 1, host: "config-2:27019" }] } )
    ```
2. Membuat user admin
    - Masuk ke salah satu config server
    ```bash
    sudo vagrant ssh config_1
    ```
    - Masuk ke `shell` mongo
    ```bash
    mongo config-1:27019
    ```
    - Connect db `admin`
    ```bash
    use admin
    ```
    - Membuat user
    ```bash
    db.createUser({user: "mongo-admin", pwd: "password", roles:[{role: "root", db: "admin"}]})
    ```
3. Menambahkan shard kedalam MongoDB Cluster
    - Masuk ke salah satu shard server
    ```bash
    sudo vagrant shard_1
    ```
    - Connect MongoDB router
    ```bash
    mongo router:27017 -u mongo-admin -p --authenticationDatabase admin
    ```
    - Tambahkan shard
    ```bash
    sh.addShard( "shard-1:27017" )
    sh.addShard( "shard-2:27017" )
    sh.addShard( "shard-3:27017" )
    ```
4. Mengaktifkan sharding
    - Masuk ke router
    ```bash
    sudo vagrant ssh router
    ```
    - Connect ke MongoDB
    ```bash
    mongo router:27017 -u mongo-admin -p --authenticationDatabase admin
    ```
    - Ketikkan
    ```bash
    use crime
    sh.enableSharding("crime")
    db.crimeCollection.ensureIndex( { _id : "hashed" } )
    sh.shardCollection( "crime.crimeCollection", { "_id" : "hashed" } )
    ```
## Import Dataset
1. Setelah semua konfigurasi selesai maka selanjutnya ialah mengimport dataset yang ada di `/vagrant/dataset/crime.csv` ke dalam database. Caranya adalah sebagai berikut.
    - Masuk ke router
    ```bash
    sudo vagrant ssh router
    ```
    - Import dataset
    ```bash
    mongoimport --host 192.168.12.7 --port 27017 --db crime --collection crimeCollection --file /vagrant/dataset/crime.csv --type csv --headerline
    ```
2. Setelah itu saatnya kita mengecek sharding-nya sudah berjalan atau tidak dengan cara:
    - Masuk ke router
    ```bash
    sudo vagrant ssh router
    ```
    - Masuk ke MongoDB
    ```bash
    mongo router:27017 -u mongo-admin -p --authenticationDatabase admin
    ```
    - Cek sharding
    ```bash
    db.crimeCollection.getShardDistribution()
    ```
    - Hasil <br>
    ![test](https://user-images.githubusercontent.com/32433590/69055687-f43c5200-0a40-11ea-87ef-d2e2b4b4b9ae.png)

## PHP-MongoDB
1. Install PHP 7.4-dev
```bash
sudo apt-get install php7.4-dev
```
2. MongoDB PHP Extension v1.6
```bash
wget https://pecl.php.net/get/mongodb-1.6.0.tgz
tar zxf mongodb-1.6.0.tgz -C /tmp
cd /tmp/mongodb-1.6.0
phpize7.4
./configure
sudo make all
sudo make install
```
3. Driver php-mongodb
```bash
cd home/kusuma16/tugas2bdt/web
composer require mongodb/mongodb
```
## Implementasi CRUD MongoDB
1. Create
![create](https://user-images.githubusercontent.com/32433590/69057320-37e48b00-0a44-11ea-8a34-b4ea69958dc4.png)<br>
![create2](https://user-images.githubusercontent.com/32433590/69057322-387d2180-0a44-11ea-9483-f4e3350ddbcc.png)<br>
![create3](https://user-images.githubusercontent.com/32433590/69057323-3915b800-0a44-11ea-84ba-e89d43e02a5f.png)<br>
2. Update
![update](https://user-images.githubusercontent.com/32433590/69057394-5b0f3a80-0a44-11ea-8131-02d3fe762884.png)<br>
![update2](https://user-images.githubusercontent.com/32433590/69057395-5b0f3a80-0a44-11ea-9ef2-5d200958a2cb.png)<br>
![update3](https://user-images.githubusercontent.com/32433590/69057396-5ba7d100-0a44-11ea-96ac-afd4f32980d0.png)<br>
3. Delete
![delete](https://user-images.githubusercontent.com/32433590/69057448-7f6b1700-0a44-11ea-8ebd-14511cc33225.png)<br>
![delete2](https://user-images.githubusercontent.com/32433590/69057449-8003ad80-0a44-11ea-8412-9a5a2e06c55f.png)
4. Read
    - `count` jumlah data dalam database <br>
    ![read](https://user-images.githubusercontent.com/32433590/69057731-dd97fa00-0a44-11ea-8113-2ce91fd2596d.png)<br>
    - Melihat Jumlah murder<br>
    ![read2](https://user-images.githubusercontent.com/32433590/69057732-dd97fa00-0a44-11ea-826d-aaf4c9bf1929.png)
    - Melihat Crime terhadap Wanita<br>
    ![read3](https://user-images.githubusercontent.com/32433590/69057734-de309080-0a44-11ea-9984-6140326a9de6.png)
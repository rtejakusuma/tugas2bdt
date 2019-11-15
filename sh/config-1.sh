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

# bug asdljaskldal
sudo mkdir -p /data/db
sudo rm /tmp/mongodb-27017.sock
sudo chown vagrant:vagrant /data/db
sudo mkdir -p /var/run/mongodb
sudo touch /var/run/mongodb/mongod.pid
sudo chown -R  mongodb:mongodb /var/run/mongodb/
sudo chown mongodb:mongodb /var/run/mongodb/mongod.pid

# Start MongoDB
sudo service mongod start

# Override mongod config with current config
sudo cp /vagrant/config/configserver1.conf /etc/mongod.conf

# Restart the mongo service 
sudo systemctl restart mongod

# weird
# sleep 5 

# Create administratif 
# mongo mongo-config-1:27019 < /vagrant/mongo/create_admin.mongo

# Init replica set
# mongo mongo-config-1:27017 -u mongo-admin -p --authenticationDatabase admin < /vagrant/mongo/init_repl_set.mongo
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
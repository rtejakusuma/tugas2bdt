# Override mongod config with current config
sudo cp /vagrant/config/shardserver2.conf /etc/mongod.conf

# Restart the mongo service 
sudo systemctl restart mongod
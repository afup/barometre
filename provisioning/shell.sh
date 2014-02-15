#!/bin/bash

PROVISIONING_DIR=/var/www/barometre/provisioning

# Update apt source repositories
if [ ! -e dotdeb.gpg ]; then
    /bin/bash -c 'echo "deb http://packages.dotdeb.org wheezy all" >> /etc/apt/sources.list'
    /bin/bash -c 'echo "deb-src http://packages.dotdeb.org wheezy all" >> /etc/apt/sources.list'

    wget http://www.dotdeb.org/dotdeb.gpg
    sudo apt-key add dotdeb.gpg

    apt-get update
    apt-get upgrade -y
fi

# Install packages to install Fabric
apt-get install -y curl linux-headers-2.6.32-5-amd64 python python-setuptools python-dev python-yaml git g++ make checkinstall

apt-get autoremove

# Download Pip
cd /tmp
curl -O https://pypi.python.org/packages/source/p/pip/pip-1.3.1.tar.gz -k
tar xfz pip-1.3.1.tar.gz
cd pip-1.3.1

# Install Pip
sudo python /tmp/pip-1.3.1/setup.py install

# Install Fabric
pip install fabric

rm -rf /tmp/pip-1.3.1
rm /tmp/pip-1.3.1.tar.gz

if [ ! -e ~vagrant/.ssh ]; then
    mkdir ~vagrant/.ssh
fi

chown vagrant ~vagrant/.ssh

# Copy ssh id
cp /var/www/barometre/provisioning/ssh/rsa_vagrant.pub ~vagrant/.ssh
cp /var/www/barometre/provisioning/ssh/rsa_vagrant ~vagrant/.ssh
cp /var/www/barometre/provisioning/ssh/config ~vagrant/.ssh

chown -R vagrant ~vagrant

# Install Node.Js
mkdir $PROVISIONING_DIR/node_js_src && cd $_
wget -N http://nodejs.org/dist/node-latest.tar.gz
tar xzvf $PROVISIONING_DIR/node_js_src/node-latest.tar.gz && cd node-v*
./configure
checkinstall
sudo dpkg -i node_*
rm -rf $PROVISIONING_DIR/node_js_src

# Install Ruby 1.9.3
dpkg -i $PROVISIONING_DIR/ruby-1.9.3_amd64.deb

# TOOD install remaining dependencies
cd $PROVISIONING_DIR
cd ..
sudo -u vagrant fab -f provisioning/deploy.py install_dependencies:role=development -l -p vagrant

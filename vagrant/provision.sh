#! /usr/bin/env bash

echo "Initialization..."
{
apt-get update
apt-get install -y git
} > /dev/null


echo "Configuring Apache..."
{
apt-get install -y apache2
sed -i "/DocumentRoot/r /vagrant/vagrant/apache.conf" /etc/apache2/sites-available/000-default.conf
rm -rf /var/www/html
ln -fs /vagrant/web /var/www/html
a2enmod rewrite
service apache2 restart
} > /dev/null

echo "Installing MySql..."
{
DBPASSWD="password"
echo "mysql-server mysql-server/root_password password $DBPASSWD" | debconf-set-selections
echo "mysql-server mysql-server/root_password_again password $DBPASSWD" | debconf-set-selections
apt-get -y install mysql-server
} > /dev/null

echo "Installing Php & Composer..."
{
apt-get install -y php5 php5-mysql php5-curl
curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer
} > /dev/null


echo "Installing Node, Bower & Grunt..."
{
curl -sL https://deb.nodesource.com/setup_0.12 | bash -
apt-get install -y nodejs
npm install -g bower
npm install -g grunt-cli
} > /dev/null

echo "Installing Ruby & Bundler..."
{
apt-get install -y ruby-full
gem install bundler
} > /dev/null


echo "Installing application..."
{
cd /vagrant
su vagrant << EOF
    composer install
    sed -i "s/database_password: null/database_password: $DBPASSWD/" app/config/parameters.yml
    npm install
    bundle install
    bower install
    grunt
    php app/console doctrine:database:create
    php app/console doctrine:schema:update --force
EOF
} > /dev/null

echo "Done!"

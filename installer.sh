#!/bin/bash
#Bash script to install web server for flower reminder
echo "Installing nginx and php.\n"
sudo apt-get install nginx php-fpm

echo "Copying over new default config file.\n"
#cd /etc/nginx
sudo cp -f $(pwd)/default /etc/nginx/sites-enabled/default

#echo "Reloading config file.\n"
#sudo /etc/init.d/nginx reload

echo "Copying web interface files.\n"
#cd /var/www/html/
#sudo cp -f $(pwd)/index.html /var/www/html/index.html
#sudo cp -f $(pwd)/index.php /var/www/html/index.php
#sudo cp -f $(pwd)/savetofile.php /var/www/html/savetofile.php

echo "Create data dir and fix permissions"
#sudo mkdir /var/www/html/data
#sudo chmod 755 /var/www/html/data
sudo mkdir $(pwd)/data
sudo chmod 755 $(pwd)/data

echo "Starting nginx service.\n"
#sudo /etc/init.d/nginx start
sudo systemctl enable nginx
sudo systemctl start nginx

echo "\nNGINX default web page location: /var/www/html/index.nginx-debian.html\n"
echo "Installation complete.\n"
echo "Raspberry Pi IP Addresses: "
hostname -I

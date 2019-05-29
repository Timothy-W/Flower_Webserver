#!/bin/bash

PURP='\033[0;35m'
NC='\033[0m'

#Bash script to install web server for flower reminder
echo "${PURP}Installing nginx and php.${NC}"
sudo apt install nginx php-fpm

echo "${PURP}Copying over new default config file.${NC}"
#cd /etc/nginx
sudo cp -f $(pwd)/default /etc/nginx/sites-enabled/default

#echo "Reloading config file.\n"
#sudo /etc/init.d/nginx reload

echo "${PURP}Copying web interface files.${NC}"
#cd /var/www/html/
#sudo cp -f $(pwd)/index.html /var/www/html/index.html
#sudo cp -f $(pwd)/index.php /var/www/html/index.php
#sudo cp -f $(pwd)/savetofile.php /var/www/html/savetofile.php

echo "${PURP}Creating data dir and fixing permissions${NC}"
#sudo mkdir /var/www/html/data
#sudo chmod 755 /var/www/html/data
sudo mkdir $(pwd)/data
sudo chmod 755 $(pwd)/data

echo "${PURP}Starting nginx service.${NC}"
#sudo /etc/init.d/nginx start
sudo systemctl enable nginx
sudo systemctl start nginx

echo "${PURP}NGINX default web page location: /var/www/html/index.nginx-debian.html${NC}"
echo "${PURP}Installation complete.${NC}"
echo "${PURP}Raspberry Pi IP Addresses: "
hostname -I

#!/bin/bash
# Author: Timothy Walker
# Date: 13 June 2019
# Description: Simple bash script that;
#     1. Installs nginx, php.
#     2. Make needed data directories and copies over config files
#     3. Sets up nginx services
#     4. Displays IP address of raspberry pi
#
# Notes: This script is intended to be ran on a clean, updated install of 
#        raspbian and assumes such. There is no error checking handling.
#
# The following link can be used to address HTTP Error 413 if it arrises.
#       #https://www.keycdn.com/support/413-request-entity-too-large
#
#######

# Color variables for output.
PURP='\033[0;35m'
NC='\033[0m'

#Bash script to install web server for flower reminder
echo -e "${PURP}Installing nginx and php.${NC}"
sudo apt -y install nginx php-fpm

echo -e "${PURP}Copying over new default config file.${NC}"
#cd /etc/nginx
sudo cp -f $(pwd)/default /etc/nginx/sites-enabled/default

#echo -e "Reloading config file.\n"
#sudo /etc/init.d/nginx reload

echo -e "${PURP}Copying web interface files.${NC}"
#cd /var/www/html/
#sudo cp -f $(pwd)/index.html /var/www/html/index.html
sudo cp -f $(pwd)/index.php /var/www/html/index.php
sudo cp -f $(pwd)/savetofile.php /var/www/html/savetofile.php
sudo cp -f $(pwd)/Ins.png /var/www/html/Ins.png


echo -e "${PURP}Copying PHP config file.${NC}"
sudo cp -f $(pwd)/php.ini /etc/php/7.0/cli/php.ini
sudo cp -f $(pwd)/php.ini /etc/php/7.0/fpm/php.ini

echo -e "${PURP}Creating data dir and fixing permissions${NC}"
#sudo mkdir /var/www/html/data
#sudo chmod 755 /var/www/html/data
sudo mkdir $(pwd)/data
sudo chmod 755 $(pwd)/data

echo -e "${PURP}Starting nginx service.${NC}"
#sudo /etc/init.d/nginx start
sudo systemctl enable nginx
sudo systemctl start nginx
sudo rm -f /var/www/html/index.nginx-debian.html
sudo systemctl restart nginx

echo -e "${PURP}NGINX default web page location: /var/www/html/index.nginx-debian.html${NC}"
echo -e "${PURP}Installation complete.${NC}"
echo -e "${PURP}Raspberry Pi IP Addresses: "
hostname -I

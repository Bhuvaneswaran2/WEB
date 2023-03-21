#!/bin/bash
 
sudo apt update
sudo apt install php php-xml php-fpm libapache2-mod-php php-mysql php-gd php-imap php-curl php-mbstring mariadb-server -y
sudo service apache2 start
sudo sevice mysql start

cat << CD
============================================================================================
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
Please type a commands to create database and exit:
create database mysite;
exit;
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
============================================================================================
CD
sudo mysql

cd /tmp
git clone https://github.com/Bhuvaneswaran2/WEB.git
cat << setup
********************************************************************************************============================================================================================
Setup a Password and Remember
Enter Yes to All
Finally Change the password on database.php
============================================================================================********************************************************************************************
setup
sudo mysql_secure_installation
cd WEB/vulnerable
sudo mysql -u root  -p mysite < mysite.sql
cd ..
sudo mv vulnerable /var/www/html/vulnerable
cd /var/www/html
sudo chmod 777 vulnerable
cd vulnerable
sudo nano login.php
sudo nano home.php
sudo nano register.php
echo "Successfully Completed"
echo "Copy And Paste the URL: http://localhost/vulnerable/login.php"


#!/bin/bash

sudo apt-get update
sudo apt-get install mariadb-server
sudo apt-get install python
sudo apt-get install python-mysqldb

# sudo pip install mysql-connector
sudo pip install mysql-connector-python-rf

sudo apt-get install apache2 -y
sudo apt-get install php5 libapache2-mod-php5 -y
sudo apt-get install php5-mysql

mysql_secure_installation

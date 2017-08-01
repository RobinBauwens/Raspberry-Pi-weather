#!/bin/bash

sudo apt-get update
sudo apt-get install mariadb-server
sudo apt-get install python
sudo apt-get install python-mysqldb

# sudo pip install mysql-connector
sudo pip install mysql-connector-python-rf

mysql_secure_installation

#!/bin/bash

# Kopieer data naar backup

sudo cat /var/www/html/files/weatherdata.json >> ~/backup.json
awk '!a[$0]++' ~/backup.json > uniquedata.json

# Login

  DB_USER='root'
  DB_PASS='mariadb-password'
  echo 'logging into DB $DB as $DB_USER'
  mysql -u "$DB_USER" --password="$DB_PASS" < /home/pi/DeleteFirst200Records.sql

# https://stackoverflow.com/questions/13814413/how-to-auto-login-mysql-in-shell-scripts

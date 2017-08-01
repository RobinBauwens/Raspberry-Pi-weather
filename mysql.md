# MySQL

`SHOW DATABASES;` (de puntkomma niet vergeten!)

`create database WeatherStation;`

`use weatherstation`

`create table WeatherData(ID INTEGER AUTO_INCREMENT PRIMARY KEY, Temperature Double, Humidity Double, Date DATE)`


`ALTER TABLE WeatherData ADD COLUMN ID INTEGER AUTO_INCREMENT UNIQUE KEY;`

`alter table WeatherData Drop column DataID;`

### Verander DB database1 naam naar database2
`shell> mysqldump -hlocalhost -uroot -p  database1  > dump.sql`

`mysql> CREATE DATABASE database2;`

`shell> mysql -hlocalhost -uroot -p database2 < dump.sql`
If you want to drop database1 otherwise leave it.

`mysql> DROP DATABASE database1;`

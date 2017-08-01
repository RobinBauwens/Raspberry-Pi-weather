# MySQL

`SHOW DATABASES;` (de puntkomma niet vergeten!)

`create database WeatherStation;`

`use WeatherStation;`

`create table WeatherData(ID INTEGER AUTO_INCREMENT PRIMARY KEY, Date DATE, Time TIME, Temperature Double, Humidity Double);`

### Andere
`ALTER TABLE WeatherData ADD COLUMN ID INTEGER AUTO_INCREMENT UNIQUE KEY;`

`alter table WeatherData Drop column DataID;`


### Voorbeeld van INSERT
`insert into WeatherData values (1,CURDATE(),CURTIME(),24,90);`


### Verander DB database1 naam naar database2
`shell> mysqldump -hlocalhost -uroot -p  database1  > dump.sql`

`mysql> CREATE DATABASE database2;`

`shell> mysql -hlocalhost -uroot -p database2 < dump.sql`

If you want to drop database1 otherwise leave it.

`mysql> DROP DATABASE database1;`

[Toon alle kolommen van tabellen binnen DB](https://stackoverflow.com/questions/5648420/get-all-columns-from-all-mysql-tables)



CREATE TABLE IF NOT EXISTS `WeatherData` (
  `ID` int(255) NOT NULL AUTO_INCREMENT,
  `Temperature` double NOT NULL,
  `Humidity` varchar(20) NOT NULL,
  `DateMeasured` date NOT NULL,
  `HourMeasured` int(128) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

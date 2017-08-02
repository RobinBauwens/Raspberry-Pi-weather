CREATE TABLE IF NOT EXISTS WeatherData ( 
  ID int(255) NOT NULL AUTO_INCREMENT, 
  Temperature double NOT NULL, 
  Humidity varchar(20) NOT NULL, 
  Timestamp timestamp NOT NULL, 
  PRIMARY KEY (ID) 
) 
  ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

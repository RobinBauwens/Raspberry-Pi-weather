CREATE TABLE IF NOT EXISTS WeatherData ( 
  ID int NOT NULL AUTO_INCREMENT, 
  Temperature double NOT NULL, 
  Humidity int NOT NULL, 
  Timestamp timestamp NOT NULL, 
  PRIMARY KEY (ID) 
);

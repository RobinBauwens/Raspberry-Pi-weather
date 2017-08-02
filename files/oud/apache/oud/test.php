<?php
// create a connection between php and mysql database

$hostname = "localhost";

$username = "root";

$password = "mariadb-password";

// your database name
$databaseName = "WeatherStation";

// create The connection
$connect = mysqli_connect($hostname, $username, $password);
mysqli_select_db($connect, $databaseName);

// the mysql query
$query = "SELECT * FROM `WeatherData;`";

$result = mysqli_query($connect, $query);

// using while loop to dispaly data from database
while($row = mysqli_fetch_array($result))
  {

    echo "$row[0] <br>";

  }
  
// free your result
  mysqli_free_result($result);

// close the connection
  mysqli_close($connect);

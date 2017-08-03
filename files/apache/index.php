<?php
function get_data()
        {
        $connect = mysqli_connect("localhost","root","mariadb-password",WeatherStation);
        $query = "SELECT * FROM WeatherData";
        $result = mysqli_query($connect,$query);
        $data=array();

        while($row = mysqli_fetch_array($result))
        {
                $data[]= array(
                        'ID' => $row['ID'],
                        'Temperature' => $row['Temperature'],
                        'Humidity' => $row['Humidity'],
                        'Timestamp' => $row['Timestamp']
                        );
        }

        return json_encode($data);
}

$file_name= 'weatherdata.json';

$result=file_put_contents($file_name, get_data());

$str   = @file_get_contents('/proc/uptime');
$num   = floatval($str);
$secs  = fmod($num, 60); $num = (int)($num / 60);
$mins  = $num % 60;      $num = (int)($num / 60);
$hours = $num % 24;      $num = (int)($num / 24);
$days  = $num;

echo '<h1>Totale uptime</h1>';
echo 'Dagen: ',$days,PHP_EOL,'<br>';
echo 'Uren: ',$hours,PHP_EOL,'<br>';
echo 'Minuten: ',$mins,PHP_EOL,'<br>';
echo 'Seconden: ',number_format((float)$secs, 2, '.', ''),'<br>';


$uurOmgevormd = $hours + $mins/60 + $secs/3600;
echo '<br>Gemiddeld energieverbuik: ',$uurOmgevormd; //nog maal gemiddeld verbruik per uur


include 'index.html';
?>


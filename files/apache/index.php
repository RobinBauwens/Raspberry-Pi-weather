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

include 'index.html';

echo '<div class="text-center">';
//echo '<h1>UPTIME, ENERGIEVERBRUIK EN VOLGENDE UPDATE</h1>';
//echo '<br><h3>UPTIME: ',$days,' dagen, ',$hours,' uren, ',$mins,' minuten, ',number_format((float)$secs, 2, '.', ''),' seconden.</h3>'; afgerond op 2 cijfers na de komma
echo '<br><h3>UPTIME: ',$days,' dagen, ',$hours,' uren, ',$mins,' minuten, ',(int)$secs,' seconden.</h3>';

//$uurOmgevormd = $hours + $mins/60 + $secs/3600;
//echo '<br><h3>Gemiddeld energieverbuik: ',$uurOmgevormd,'</h3>'; //nog maal gemiddeld verbruik per uur

echo '<h3>Volgende update in ',(date('i')<=30 ? abs(30-date('i')):abs(60-date('i'))),' minuten en ',60-date('s'), ' seconden.</h3>'; //date('i') geeft minuten terug, date('s') geeft seconden terug (lokale tijd, niet tijd na uptime!)
echo '</div>';

?>

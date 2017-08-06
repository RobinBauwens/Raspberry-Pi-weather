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

$file_name= 'files/weatherdata.json';

$result=file_put_contents($file_name, get_data());

$str   = @file_get_contents('/proc/uptime');
$num   = floatval($str);
$secs  = fmod($num, 60); $num = (int)($num / 60);
$mins  = $num % 60;      $num = (int)($num / 60);
$hours = $num % 24;      $num = (int)($num / 24);
$days  = $num;

include 'index.html';

echo '<div class="text-center" id="extra">';
echo '<h4>UPTIME: ',$days,($days==1?' dag, ':' dagen, '),$hours,($hours==1?' uur ':' uren, '),$mins,($mins==1?' minuut':' minuten'),' en ',(int)$secs,((int)$secs==1?' seconde':' seconden'),'.</h4>';

//echo '<h4>Volgende update in ',(date('i')<=30 ? abs(30-date('i')):abs(60-date('i'))),(date('i')==1?' minuut ':' minuten '),'en ',60-date('s'), (60-date('s')==1?' seconde':' seconden'),'.</h4>'; 

//date('i') geeft minuten terug, date('s') geeft seconden terug (lokale tijd, niet tijd na uptime!)

//$cmd='ping -c 10 127.0.0.1';

//echo '<br>';

echo '<h4>';
system('./files/ram.sh 2>&1'); //geen echo erbij, herhaalt onnodig uitvoer dan
echo '</h4>';
//system('./files/disk.sh 2>&1');
//echo '<br>';

echo '<h4>';
system('./files/cpu.sh');
echo '</h4>';

$temp=exec("/opt/vc/bin/vcgencmd measure_temp");
echo '<h4>';
$temp=str_replace("temp=",'Temperatuur Raspberry Pi: ',$temp); //eerst gebruiker "www-data" (zie 'whoami') toevoegen met "sudo usermod -a -G video www-data"
echo str_replace("'", " °", $temp);
// exec() > system()
// https://stackoverflow.com/questions/2568093/system-function-in-php-prints-variable-2-times

echo '</h4>';
//system("whoami");
//echo '<br>';



//echo '<pre>';
//passthru($cmd);
//echo '</pre>';


echo '</div>';
?>

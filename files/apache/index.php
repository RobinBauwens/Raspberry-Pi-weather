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
file_put_contents($file_name, get_data());


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
echo 'Seconden: ',number_format((float)$secs, 2, '.', '');

?>

<html>
<head>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script
  src="http://code.jquery.com/jquery-3.2.1.js"
  integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
  crossorigin="anonymous"></script>
<script type="text/javascript">
window.onload = function () {
var dataPoints = [];	//array voor temperatuur
$.getJSON("weatherdata.json", function(data) {
        $.each(data, function(key, value){
                //console.log(value);
                //console.log(value.ID);
                //console.log(value.Timestamp);
                //console.log(value.Temperature);

                // Split timestamp into [ Y, M, D, h, m, s ]
                var t = value.Timestamp.split(/[- :]/);
                // Apply each element to the Date function
                var d = new Date(t[0], t[1]-1, t[2], t[3], t[4], t[5]);
                //console.log(d);
		
		dataPoints.push({x:d,y:parseFloat(value.Temperature)});

        });
        var chart = new CanvasJS.Chart("chartContainer",{
		zoomEnabled:true,
                title:{
                        text:"Temperatuur ophalen van .json-bestand"
                },
		 axisX:{
                        title: "Timestamp",
			valueFormatString: "HH:mm:ss" 
                },
		axisY:{
			title: "Temperatuur (in Celsius)",
			suffix: " °C"
		},
		data: [{
                        type: "line",
                        dataPoints : dataPoints,
			indexLabel: "{y} °C", 
			toolTipContent: "Datum= {x} </br> Temperatuur= {y} °C"	 
		}]
        });
        chart.render();
});

var dataPoints2 = [];	//array voor luchtvochtigheid (opgeslagen als varchar in DB)
$.getJSON("weatherdata.json", function(data) {
        $.each(data, function(key, value){
                // Split timestamp into [ Y, M, D, h, m, s ]
                var t = value.Timestamp.split(/[- :]/);
                // Apply each element to the Date function
                var d = new Date(t[0], t[1]-1, t[2], t[3], t[4], t[5]);
                //console.log(d);

                dataPoints2.push({x:d,y:parseInt(value.Humidity)});
        });
var chart2 = new CanvasJS.Chart("chartContainer2",{
		zoomEnabled:true,
                title:{
                        text:"Vochtigheid ophalen van .json-bestand"
                },
                 axisX:{
                        title: "Timestamp",
			valueFormatString: "HH:mm:ss" 
                },

                axisY:{
                        title: "Vochtigheid (in procent)",
			suffix: " %"
                },
                data: [{
                        type: "line",
                        dataPoints : dataPoints2,
			indexLabel: "{y} %",
			toolTipContent: "Datum= {x} </br> Vochtigheid= {y} %"	 
                }]
        });

chart2.render();
});
}
</script>

</head>
<body>
<div id="chartContainer" style="height: 300px; width: 100%;"></div>

<div id="chartContainer2" style="height: 300px; width: 100%;"></div>
</body>
</html>

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
var dataPoints_Temperature = [];
var dataPoints_Humidity=[];
$.getJSON("weatherdata.json", function(data) {
        $.each(data, function(key, value){
               // console.log(value);
               // console.log(value.ID);
               // console.log(value.Timestamp);
               // console.log(value.Temperature);


                // Split timestamp into [ Y, M, D, h, m, s ]
                var t = value.Timestamp.split(/[- :]/);
                // Apply each element to the Date function
                var d = new Date(t[0], t[1]-1, t[2], t[3], t[4], t[5]);
                // console.log(d);
		
                dataPoints_Temperature.push({x:d, y:parseFloat(value.Temperature) });
                dataPoints_Humidity.push({x:d,y:parseInt(value.Humidity)});

        });
        var chart = new CanvasJS.Chart("chartContainer",{
		zoomEnabled:true,
        animationEnabled: true,
            title:{
                        text:"Temperatuur ophalen van .json-bestand",
                        fontSize: 30
                },
		    axisX:{
                        title: "Timestamp",
                        gridColor: "Silver",
                        tickColor: "silver",
                },
          //  toolTip:{
          //              shared:true
          //      },
                        theme: "theme2",

		axisY:{
			title: "Temperatuur (in Celsius)",
			suffix: " °C",
            gridColor: "Silver",
            tickColor: "Silver"
		},
        legend:{
                verticalAlign: "center",
                horizontalAlign: "right"
        },
		data: [
        {
                type:"line",
                showInLegend: true,
                lineThickness: 2,
                name: "Temperatuur",
                markerType: "square",
                color: "#F08080",
                dataPoints : dataPoints_Temperature,
			    indexLabel: "{y} °C",
                toolTipContent: "{ID} </br> <strong>Temp</strong> </br> Humidity={Humidity}"
                } //eindigt normaal hier
                
                ],
          legend:{
            cursor:"pointer",
            itemclick:function(e){
              if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                e.dataSeries.visible = false;
              }
              else{
                e.dataSeries.visible = true;
              }
              chart.render();
            }
          }
        });

chart.render();
});
}

</script>

</head>
<body>
<div id="chartContainer" style="height: 300px; width: 100%;"></div>

<div id="chartContainer2" style="height: 300px; width: 100%;"></div>
</body>
</html>
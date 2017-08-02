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

echo '<pre>';
print_r(get_data());
echo '</pre>';



$file_name= 'weatherdata.json';

$result=file_put_contents($file_name, get_data());
if($result === false){
echo "Error";
}
else
{
echo 'Great!';
}
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
var dataPoints = [];
$.getJSON("weatherdata.json", function(data) {
        $.each(data, function(key, value){
                console.log(value);
                console.log(value.ID);
                console.log(value.Timestamp);
                console.log(value.Temperature);


                // Split timestamp into [ Y, M, D, h, m, s ]
                var t = value.Timestamp.split(/[- :]/);
                // Apply each element to the Date function
                var d = new Date(t[0], t[1]-1, t[2], t[3], t[4], t[5]);
                console.log(d);

                dataPoints.push({x:d  , y:5 });

        });
        var chart = new CanvasJS.Chart("chartContainer",{
                title:{
                        text:"Rendering Chart with dataPoints from External JSON"
                },
                data: [{
                        type: "line",
                        dataPoints : dataPoints,
                }]
        });
        chart.render();
});
}
</script>

</head>
<body>
<div id="chartContainer" style="height: 300px; width: 100%;"></div>
</body>
</html>
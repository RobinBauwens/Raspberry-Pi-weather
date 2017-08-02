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

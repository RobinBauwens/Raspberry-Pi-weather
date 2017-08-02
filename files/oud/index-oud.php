<?php

// om te tonen in browser
$connection = mysqli_connect("127.0.0.1","root","mariadb-password","WeatherStation") or die("Error " . mysqli_error($connection));

    //fetch table rows from mysql db
    $sql = "select * from WeatherData";
    $result = mysqli_query($connection, $sql) or die("Error in Selecting " . mysqli_error($connection));

    //create an array
    $emparray = array();
    while($row =mysqli_fetch_assoc($result))
    {
        $emparray[] = $row;
    }
    echo json_encode($emparray);

    //close the db connection
    mysqli_close($connection);
?>
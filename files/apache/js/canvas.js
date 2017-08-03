window.onload = function () {
 var dataPoints = [];
 $.getJSON("weatherdata.json", function (data) {
  $.each(data, function (key, value) {
   //console.log(value);
   //console.log(value.ID);
   //console.log(value.Timestamp);
   //console.log(value.Temperature);


   // Split timestamp into [ Y, M, D, h, m, s ]
   var t = value.Timestamp.split(/[- :]/);
   // Apply each element to the Date function
   var d = new Date(t[0], t[1] - 1, t[2], t[3], t[4], t[5]);
   //console.log(d);

   dataPoints.push({
    x: d,
    y: parseFloat(value.Temperature)
   });

  });
  var chart = new CanvasJS.Chart("chartContainer", {
   zoomEnabled: true,
   title: {
    text: "Temperatuur"
   },

   axisX: {
    title: "Timestamp",
    valueFormatString: "HH:mm"
    //valueFormatString: "HH:mm:ss"
   },

   axisY: {
    title: "Temperatuur (in Celsius)",
    suffix: " °C"
   },
   data: [{
    type: "line",
    dataPoints: dataPoints,
    //indexLabel: "{y} °C",
    toolTipContent: "Datum= {x} </br> Temperatuur= {y} °C"
                }]
  });
  chart.render();
 });

 dataPoints2 = []; //array voor luchtvochtigheid (opgeslagen als varchar in DB)
 $.getJSON("weatherdata.json", function (data) {
  $.each(data, function (key, value) {
   // Split timestamp into [ Y, M, D, h, m, s ]
   var t = value.Timestamp.split(/[- :]/);

   // Apply each element to the Date function
   var d = new Date(t[0], t[1] - 1, t[2], t[3], t[4], t[5]);
   //console.log(d);

   dataPoints2.push({
    x: d,
    y: parseInt(value.Humidity)
   });
  });
  var chart2 = new CanvasJS.Chart("chartContainer2", {
   zoomEnabled: true,
   title: {
    text: "Vochtigheid"
   },
   axisX: {
    title: "Timestamp",
    valueFormatString: "HH:mm"
    //valueFormatString: "HH:mm:ss"
   },

   axisY: {
    title: "Vochtigheid (in procent)",
    suffix: " %"
   },
   data: [{
    type: "line",
    dataPoints: dataPoints2,
    //indexLabel: "{y} %",
    toolTipContent: "Datum= {x} </br> Vochtigheid= {y} %"
                }]
  });

  chart2.render();
 });
}

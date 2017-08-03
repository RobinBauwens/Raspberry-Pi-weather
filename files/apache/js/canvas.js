window.onload = function () {
 var dataPoints = []; //array voor temperatuur (opgeslagen als int in DB)
 var dataPoints2 = []; //array voor luchtvochtigheid (opgeslagen als int in DB)
 $.getJSON("files/weatherdata.json", function (data) {

  //eerste record invullen
  $("#firstRecord").append(data[0].Timestamp);

  //minimumtemperatuur en maximumtemperatuur invullen
  var min = Math.min.apply(Math, data.map(function (o) {
   return o.Temperature;
  }));
  var max = Math.max.apply(Math, data.map(function (o) {
   return o.Temperature;
  }));
  $("#minimumTemp").append(min).append(" °C").append("<br>").append("Geregistreerd op volgende data (eerste 3 datapunten):").append("<hr>");
  $("#maximumTemp").append(max).append(" °C").append("<br>").append("Geregistreerd op volgende data (eerste 3 datapunten):").append("<hr>");

  var minCount = 1;
  var maxCount = 1;

  $.each(data, function (key, value) {

   //min en max temp aanvullen met datum (vult enkel eerste datum in)
   if (min == value.Temperature && minCount <= 3) {
    $("#minimumTemp").append('<p>', value.Timestamp, "</p>");
    minCount++;
   }

   if (max == value.Temperature && maxCount <= 3) {
    $("#maximumTemp").append('<p>', value.Timestamp, "</p>");
    maxCount++;
   }

   // Split timestamp into [ Y, M, D, h, m, s ]
   var t = value.Timestamp.split(/[- :]/);
   // Apply each element to the Date function
   var d = new Date(t[0], t[1] - 1, t[2], t[3], t[4], t[5]);

   dataPoints.push({
    x: d,
    y: parseFloat(value.Temperature)
   });

   dataPoints2.push({
    x: d,
    y: parseInt(value.Humidity)
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
   },

   axisY: {
    title: "Temperatuur (in Celsius)",
    suffix: " °C"
   },
   data: [{
    type: "area",
    dataPoints: dataPoints,
    toolTipContent: "Datum= {x} </br> Temperatuur= {y} °C"
                }]
  });
  chart.render();

 });


 $.getJSON("files/weatherdata.json", function (data) {
  var chart2 = new CanvasJS.Chart("chartContainer2", {
   zoomEnabled: true,
   title: {
    text: "Vochtigheid"
   },
   axisX: {
    title: "Timestamp",
    valueFormatString: "HH:mm"
   },

   axisY: {
    title: "Vochtigheid (in procent)",
    suffix: " %"
   },
   data: [{
    type: "area",
    dataPoints: dataPoints2,
    toolTipContent: "Datum= {x} </br> Vochtigheid= {y} %"
                }]
  });

  chart2.render();
 });
}

window.onload = function () {
 var dataPoints = []; //array voor temperatuur (opgeslagen als int in DB)
 var dataPoints2 = []; //array voor luchtvochtigheid (opgeslagen als int in DB)


 $("#extra h4").hide();

    $("#btnExtra").click(function(){
         $("#extra h4").toggle();
    });


 $.getJSON("files/weatherdata.json", function (data) {

	//duplicate code, anders zit het onnodig in de each lus
 	var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour:"numeric",minute:"numeric" };
 	var t = data[0].Timestamp.split(/[- :]/);
   	// Apply each element to the Date function
   	var d = new Date(t[0], t[1] - 1, t[2], t[3], t[4], t[5]); //month: januari = 0, februari = 1,...



  //eerste record invullen
  $("#firstRecord").append(d.toLocaleDateString("en-US",options));

  //tonen laatste gegevens
  $("#lastData").append(data[data.length-1].Temperature).append("° C; ").append(data[data.length-1].Humidity).append(" %");

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

   // Split timestamp into [ Y, M, D, h, m, s ]
   var t = value.Timestamp.split(/[- :]/);
   // Apply each element to the Date function
   var d = new Date(t[0], t[1] - 1, t[2], t[3], t[4], t[5]); //month: januari = 0, februari = 1,...


   //min en max temp aanvullen met datum (vult enkel eerste datum in)
  
   
   if (min == value.Temperature && minCount <= 3) {
    $("#minimumTemp").append('<p>', d.toLocaleDateString("en-US",options), "</p>");
    minCount++;
   }

   if (max == value.Temperature && maxCount <= 3) {
    $("#maximumTemp").append('<p>', d.toLocaleDateString("en-US",options), "</p>");
    maxCount++;
   }


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
   // valueFormatString: "hh:mm TT",
   // valueFormatString: "HH:mm",
    interval:1,
    intervalType: "day"
   // intervalType:"month",
   //valueFormatString: "DDD HH:mm:ss"
   },

   axisY: {
    title: "Temperatuur (in °C)",
    suffix: " °C"
   },
   data: [{
    type: "area",
    dataPoints: dataPoints,
    xValueFormatString: "DD/MM/YYYY HH:mm",
	yValueFormatString: "Temperatuur: #.## '°C'"
    //toolTipContent: "Datum= {x} </br> Temperatuur= {y} °C"
                }]
  });
  chart.render();

 });


 $.getJSON("files/weatherdata.json", function (data) { //overbodig, maar enkel op F12 drukken zorgt ervoor dat graph op scherm komt (?)
  var chart2 = new CanvasJS.Chart("chartContainer2", {
   zoomEnabled: true,
   title: {
    text: "Vochtigheid"
   },
   axisX: {
    title: "Timestamp",
    //valueFormatString: "HH:mm",
    interval:1,
    intervalType: "day"
   },

   axisY: {
    title: "Vochtigheid (in procent)",
    suffix: " %"
   },
   data: [{
    type: "area",
    dataPoints: dataPoints2,
    xValueFormatString: "DD/MM/YYYY HH:mm",
	yValueFormatString: "Vochtigheid: ##'%'"
    //toolTipContent: "Datum= {x} </br> Vochtigheid= {y} %"
                }]
  });

  chart2.render();
 });
}

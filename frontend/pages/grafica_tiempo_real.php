<?php
 if(!session_id()) 
session_start();

if (isset($_SESSION ["cod_usu"])){ ?>
<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <title>Trafico en vivo!</title>
       <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script> 

<script> 
	var chart;
	function requestDatta(interface) {
		$.ajax({
			
			url: '../../backend/clase/api/data.php?interface='+interface+'&contrato=<?php echo $con;?>',
			datatype: "json",
			success: function(data) {
			
			console.log(data);
				var midata = JSON.parse(data);
				
				
				
				//console.log(midata);
				if( midata.length > 0 ) {
					var TX=parseInt(midata[0].data);
					var RX=parseInt(midata[1].data);
					var x = (new Date()).getTime(); 
					shift=chart.series[0].data.length > 19;
					chart.series[0].addPoint([x, TX], true, shift);
					chart.series[1].addPoint([x, RX], true, shift);
					document.getElementById("trafico").innerHTML=TX + " / " + RX;
				}else{
					document.getElementById("trafico").innerHTML="- / -";
				}
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) { 
				console.error("Status: " + textStatus + " request: " + XMLHttpRequest); console.error("Error: " + errorThrown); 
			}       
		});
		
	}	

	$(document).ready(function() {
			Highcharts.setOptions({
				global: {
					useUTC: false
				}
			});
	

           chart = new Highcharts.Chart({
			   chart: {
				renderTo: 'container',
				animation: Highcharts.svg,
				type: 'spline',
				events: {
					load: function () {
						setInterval(function () {
							requestDatta(document.getElementById("interface").value);
						}, 1000);
					}				
			}
		 },
		 title: {
			text: 'Monitoring'
		 },
		 xAxis: {
			type: 'datetime',
				tickPixelInterval: 150,
				maxZoom: 20 * 1000
		 },
		 yAxis: {
			minPadding: 0.2,
				maxPadding: 0.2,
				title: {
					text: 'Trafico',
					margin: 80
				}
		 },
            series: [{
                name: 'TX',
                data: []
            }, {
                name: 'RX',
                data: []
            }]
	  });
  });
</script>

</head>
<body>
	<script type="text/javascript" src="../../backend/clase/api/highchart/js/highcharts.js"></script>
    <script type="text/javascript" src="../../backend/clase/api/highchart/js/themes/gray.js"></script>

	<div id="container" style="min-width: 100%; height: 400px; margin: 0 auto"></div>
	<input name="interface" id="interface" type="text" value="<?php echo $cli; ?>" readonly class="form-control"/>
	<strong>Color Amarillo: Descarga / Color Azul: Subida</strong>
    <div id="trafico"></div>
</body>
</html>
<?php   

}
else{
    header("location: ../index.php");
    exit();

}
?>



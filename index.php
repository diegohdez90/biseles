<!DOCTYPE html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=utf-8 "/>
    <title>Biseles</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script><link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" type="text/css" href="css/main.css">
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<?php

	$servername = "localhost";
	$user = "root";
	$pwd = "veotek";
	$db = "inventario1";


	$my_sql_conn =  new mysqli($servername,$user,$pwd,$db);

    $fechas = array();
    $result = $my_sql_conn->query("select fecha, count(*) as biseles from pedido where fecha>'2015-09-01' and fecha<'2016-09-01' group by fecha");

    while($rs = $result->fetch_array(MYSQLI_ASSOC)){
      $fechas[$rs['fecha']] = $rs['biseles']; 
    }



?>

  </head>

  <body>

  	<nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myMenu">
            </button>
            <a class="navbar-brand" href="index.php">Proyectos</a>
          </div>
          <div class="collapse navbar-collapse" id="myMenu">
            <ul class="nav navbar-nav">
              <li class="active"><a href="index.php"><p class="text-center"><i class="material-icons">home</i></p><p class="text-center">Inicio</p></a></li>
              <li><a href="armazones.php"><p class="text-center"><img src="img/png/rectangular35.png"></p><p class="text-center">Armazones</p></a></li>
              <li><a href="micas.php"><p class="text-center"><img src="img/png/rectangular30.png"></p><p class="text-center">Micas</p></a></li>
              <li><a href="materiales.php"><p class="text-center"><img src="img/png/eyeglasses4.png"></p><p class="text-center">Materiales</p></a></li>
              <li><a href="tratamiento.php"><p class="text-center"><img src="img/png/tool700.png"></p><p class="text-center">Tratamiento</p></a></li>
              <li><a href="tipo.php"><p class="text-center"><img src="img/png/glasses48.png"></p><p class="text-center">Tipo</p></a></li>              
              <li><a href="tecnico.php"><p class="text-center"><img src="img/png/user219.png"></p><p class="text-center">Tecnico</p></a></li>              
            </ul>
            <ul class="nav navbar-nav navbar-right veoteimg">
            </ul>
          </div>
        </div>
      </nav>
  	<div class="jumbotron">
  		<div class="container">
  			<div class="row">
		        <div id="chart_div"></div>
		    </div>
  		</div>
  	</div>
    <footer class="container-fluid text-center">
      <p>Veotek<i class="material-icons" style="font-size:16px;">copyright</i> <span id="theYear"></span></p>
      <div class"row">Icons made by <a href="http://www.freepik.com" title="Freepik">Freepik</a>, <a href="http://www.flaticon.com/authors/round-icons" title="Round Icons">Round Icons</a> from <a href="http://www.flaticon.com" title="Flaticon">www.flaticon.com</a>             is licensed by <a href="http://creativecommons.org/licenses/by/3.0/" title="Creative Commons BY 3.0">CC BY 3.0</a></div>
    </footer>
  </body>

  <script type="text/javascript">
google.charts.load('current', {packages: ['corechart', 'line']});
google.charts.setOnLoadCallback(drawBackgroundColor);

function drawBackgroundColor() {
      var data = new google.visualization.DataTable();
      data.addColumn('date', 'Dia');
      data.addColumn('number', 'Biseles');

      data.addRows([
        <?php
          foreach ($fechas as $key => $value) {
            $annio = substr($key, 0,4);
            $mes = substr($key, 5,2);
            $dia = substr($key, 8,2);
        ?>
          [new Date(<?php echo $annio;?>,<?php echo $mes-1;?>,<?php echo $dia;?>),<?php echo $value;?>],
        <?php    
          } 

        ?>
      ]);

      var options = {
      	title: 'Biseles por dia',
        height: 600,
        hAxis: {
          title: 'Dia'
        },
        vAxis: {
          title: 'Biseles'
        },
        backgroundColor: '#f1f8e9'
      };

      var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
      chart.draw(data, options);
    }
  </script>

<script type="text/javascript">
    var d = new Date();
    var n = d.getFullYear();
    document.getElementById("theYear").innerHTML = n;
</script>

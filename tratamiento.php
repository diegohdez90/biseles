<!DOCTYPE html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=utf-8 "/>
    <title>Trataiento</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script><link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<style type="text/css">

	.jumbotron{
		padding-top: 10%;
	}
</style>
<?php

	$servername = "localhost";
	$user = "root";
	$pwd = "veotek";
	$db = "inventario1";


	$my_sql_conn =  new mysqli($servername,$user,$pwd,$db);

    $resultTratamiento = $my_sql_conn->query("select tratamiento from pedido where tratamiento!=' ' group by tratamiento");
    $i=0;
	while($rs = $resultTratamiento->fetch_array(MYSQLI_ASSOC)){
      $tratamiento[$i] = $rs['tratamiento']; 
      $i += 1;
    }

	$fechas = array();
	$getFechas = $my_sql_conn->query("select distinct fecha from pedido where tratamiento!=' ' and fecha<='2016-09-01'");
	while($rs = $getFechas->fetch_array(MYSQLI_ASSOC)){
		$fechas[] = $rs['fecha'];
	}


	
?>

  </head>

  <body>

  	<nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myMenu">
            </button>
            <a class="navbar-brand" href="index.html">Proyectos</a>
          </div>
          <div class="collapse navbar-collapse" id="myMenu">
            <ul class="nav navbar-nav">
              <li class="active"><a href="index.html"><p class="text-center"><i class="material-icons">home</i></p><p class="text-center">Inicio</p></a></li>
              <li><a href="index.html"><p class="text-center"><i class="material-icons">home</i></p><p class="text-center">Armazones</p></a></li>
              <li><a href="index.html"><p class="text-center"><i class="material-icons">home</i></p><p class="text-center">Micas</p></a></li>
              <li><a href="index.html"><p class="text-center"><i class="material-icons">home</i></p><p class="text-center">Materiales</p></a></li>
              <li><a href="index.html"><p class="text-center"><i class="material-icons">home</i></p><p class="text-center">Tratamiento</p></a></li>
              <li><a href="index.html"><p class="text-center"><i class="material-icons">home</i></p><p class="text-center">Tipo</p></a></li>              
            </ul>
            <ul class="nav navbar-nav navbar-right veoteimg">
            </ul>
          </div>
        </div>
      </nav>
  	<div class="jumbotron">
  		<div class="container">
  			<div class="row">
            <h4>Tratamiento realizados</h4>
  			    <div id="chart_div"></div>
		    </div>
  		</div>
  	</div>
  </body>

  <script type="text/javascript">
google.charts.load('current', {packages: ['corechart', 'line']});
google.charts.setOnLoadCallback(drawBackgroundColor);

function drawBackgroundColor() {
      var data = new google.visualization.DataTable();
      data.addColumn('date', 'Dia');
    <?php
	    foreach ($tratamiento as $key => $value) {
	?>  	

    	data.addColumn('number', '<?php echo $value ?>');
	<?php
		}
    ?>

      data.addRows([
        <?php
            for ($i=0; $i<count($fechas) ; $i++) { 
                $selectFecha = $fechas[$i];
                $annio = substr($fechas[$i], 0,4);
                $mes = substr($fechas[$i], 5,2);
                $dia = substr($fechas[$i], 8,2);
        ?>
         <?php echo "[new Date(".$annio.",".($mes-1).",".$dia."),";?>
         <?php 

          foreach ($tratamiento as $key => $value) { 
            $total = $my_sql_conn->query("select count(*) as total from pedido where fecha = '$selectFecha' and tratamiento='$value'"); 
            while($rs = $total->fetch_array(MYSQLI_ASSOC)){ 
                echo $rs['total'].",";
          }; 
        };
        echo "],";
        } 
        ?>

    
    ]);

      var options = {
      	title: 'Tratamiento por dia',
        height: 600,
        hAxis: {
          title: 'Dia'
        },
        vAxis: {
          title: 'Cantidad'
        },
        backgroundColor: '#f1f8e9'
      };

      var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
      chart.draw(data, options);
    }
  </script>

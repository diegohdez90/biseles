<!DOCTYPE html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=utf-8 "/>
    <title>Biseles</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script><link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" type="text/css" href="../css/main.css">
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <style type="text/css">
    footer{
          min-height: 1%;
    }
    .jumbotron{
      padding-top: 5%;
    }
  </style>
<?php

	$servername = "localhost";
	$user = "root";
	$pwd = "veotek";
	$db = "inventario1";


	$my_sql_conn =  new mysqli($servername,$user,$pwd,$db);

    $fechas = array();
    $result = $my_sql_conn->query("select fecha, count(*) as biseles from pedido where (armazon or materiales or micas or tratamiento or tipo or tecnico)!=' ' group by fecha");

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
              <li class="active"><a href="index.php"><p class="text-center"><img src="../img/png/home153.png"></p><p class="text-center">Inicio</p></a></li>
              <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  <p class="text-center"><img src="../img/png/rectangular35.png"></p><p class="text-center">Armazones</p>
                  <p class="text-center"><span class="caret"></span></p>
                </a>
                <ul class="dropdown-menu">
                  <?php
                      $resultArmazones = $my_sql_conn->query("select armazon from pedido where armazon!=' ' group by armazon");
                      $i=0;
                      while($rs = $resultArmazones->fetch_array(MYSQLI_ASSOC)){
                        $armazon[$i] = $rs['armazon'];
                        $thearmazon[$armazon[$i]] = str_replace(' ', '', $armazon[$i]);
                        echo "<li><a href='#".$thearmazon[$armazon[$i]]."link' class='".$thearmazon[$armazon[$i]]."graph'>".$armazon[$i]."</a></li>";
                        $i += 1;
                      }

                  ?>
                </ul>
              </li>
              <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  <p class="text-center"><img src="../img/png/rectangular30.png"></p><p class="text-center">Micas</p>
                  <p class="text-center"><span class="caret"></span></p>
                </a>
                <ul class="dropdown-menu">
                  <?php
                      $resultMicas = $my_sql_conn->query("select micas from pedido where micas!=' ' group by micas");
                      $i=0;
                      while($rs = $resultMicas->fetch_array(MYSQLI_ASSOC)){
                        $micas[$i] = $rs['micas'];
                        $themicas[$micas[$i]] = str_replace('-', '', $micas[$i]);
                        echo "<li><a href='#".$themicas[$micas[$i]]."link' class='".$themicas[$micas[$i]]."graph'>".$micas[$i]."</a></li>";
                        $i += 1;
                      }

                  ?>
                </ul>
              </li>
              <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  <p class="text-center"><img src="../img/png/eyeglasses4.png"></p><p class="text-center">Materiales</p>
                  <p class="text-center"><span class="caret"></span></p>
                </a>
                <ul class="dropdown-menu">
                  <?php
                      $resultMateriales = $my_sql_conn->query("select materiales from pedido where materiales!=' ' group by materiales");
                      $i=0;
                      while($rs = $resultMateriales->fetch_array(MYSQLI_ASSOC)){
                        $materiales[$i] = $rs['materiales'];
                        $themateriales[$materiales[$i]] = str_replace('-', '', $materiales[$i]);
                        echo "<li><a href='#material".$themateriales[$materiales[$i]]."link' class='".$themateriales[$materiales[$i]]."graph'>".$materiales[$i]."</a></li>";
                        $i += 1;
                      }

                  ?>                  
                </ul>
              </li>
              <li><a href="tratamiento.php"><p class="text-center"><img src="../img/png/tool700.png"></p><p class="text-center">Tratamiento</p></a></li>
              <li><a href="tipo.php"><p class="text-center"><img src="../img/png/glasses48.png"></p><p class="text-center">Tipo</p></a></li>              
              <li><a href="tecnico.php"><p class="text-center"><img src="../img/png/user219.png"></p><p class="text-center">Tecnico</p></a></li>              
              <li><a href="tecnico.php"><p class="text-center"><img src="../img/png/next21.png"></p><p class="text-center">Otro Modelo</p></a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right veoteimg">
            </ul>
          </div>
        </div>
      </nav>

    <div class="jumbotron">
<?php
    foreach ($thearmazon as $key => $value) {
      echo '
      <div class="container" id="'.$value.'link">
        <div class="row"><h3 class="text-center">'.$key.'</h3></div>
        <div class="row">
            <div id="'.$value.'"></div>
        </div>
      </div>';      
    }
?>


    <div class="jumbotron">
<?php
    foreach ($themicas as $key => $value) {
      echo '
      <div class="container" id="'.$value.'link">
        <div class="row"><h3 class="text-center">'.$key.'</h3></div>
        <div class="row">
            <div id="'.$value.'"></div>
        </div>
      </div>';      
    }
?>

    <div class="jumbotron">
<?php
    foreach ($themateriales as $key => $value) {
      echo '
      <div class="container" id="material'.$value.'link">
        <div class="row"><h3 class="text-center">'.$key.'</h3></div>
        <div class="row">
            <div id="'.$value.'"></div>
        </div>
      </div>';      
    }
?>
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
  <?php
    foreach ($thearmazon as $keyarm => $arm) {
      # code...

  ?>
              var data<?php echo $arm ?> = new google.visualization.DataTable();
              data<?php echo $arm ?>.addColumn('date', 'Dia');
              data<?php echo $arm ?>.addColumn('number', '<?php echo $keyarm; ?>');

              data<?php echo $arm ?>.addRows([
                <?php
                  foreach ($fechas as $key => $value) {
                    $annio = substr($key, 0,4);
                    $mes = substr($key, 5,2);
                    $dia = substr($key, 8,2);

                    $total = $my_sql_conn->query("select count(*) as total from pedido where fecha = '$key' and armazon='$keyarm'"); 
                    while($rs = $total->fetch_array(MYSQLI_ASSOC)){ 
                      $cantidad =  $rs['total'];
                    }; 
                ?>
                  [new Date(<?php echo $annio;?>,<?php echo $mes-1;?>,<?php echo $dia;?>),<?php echo $cantidad;?>],
                <?php    
                  } 

                ?>
              ]);
    <?php

        }

  ?>

  <?php
    foreach ($themicas as $keymicas => $mica) {
      # code...

  ?>
              var data<?php echo $mica ?> = new google.visualization.DataTable();
              data<?php echo $mica ?>.addColumn('date', 'Dia');
              data<?php echo $mica ?>.addColumn('number', '<?php echo $keymicas; ?>');

              data<?php echo $mica ?>.addRows([
                <?php
                  foreach ($fechas as $key => $value) {
                    $annio = substr($key, 0,4);
                    $mes = substr($key, 5,2);
                    $dia = substr($key, 8,2);

                    $total = $my_sql_conn->query("select count(*) as total from pedido where fecha = '$key' and micas='$keymicas'"); 
                    while($rs = $total->fetch_array(MYSQLI_ASSOC)){ 
                      $cantidad =  $rs['total'];
                    }; 
                ?>
                  [new Date(<?php echo $annio;?>,<?php echo $mes-1;?>,<?php echo $dia;?>),<?php echo $cantidad;?>],
                <?php    
                  } 

                ?>
              ]);
    <?php

        }

  ?>

  <?php
    foreach ($themateriales as $keymat => $mat) {
      # code...

  ?>
              var data<?php echo $mat ?> = new google.visualization.DataTable();
              data<?php echo $mat ?>.addColumn('date', 'Dia');
              data<?php echo $mat ?>.addColumn('number', '<?php echo $keymat; ?>');

              data<?php echo $mat ?>.addRows([
                <?php
                  foreach ($fechas as $key => $value) {
                    $annio = substr($key, 0,4);
                    $mes = substr($key, 5,2);
                    $dia = substr($key, 8,2);

                    $total = $my_sql_conn->query("select count(*) as total from pedido where fecha = '$key' and materiales='$keymat'"); 
                    while($rs = $total->fetch_array(MYSQLI_ASSOC)){ 
                      $cantidad =  $rs['total'];
                    }; 
                ?>
                  [new Date(<?php echo $annio;?>,<?php echo $mes-1;?>,<?php echo $dia;?>),<?php echo $cantidad;?>],
                <?php    
                  } 

                ?>
              ]);
    <?php

        }

  ?>


  <?php
    foreach ($thearmazon as $key => $arm) {
      # code...

  ?>

              var options<?php echo $arm ?> = {
              	title: '<?php echo $key ?> por dia',
                height: 600,
                hAxis: {
                  title: 'Dia'
                },
                vAxis: {
                  title: 'Biseles'
                },
                backgroundColor: '#f1f8e9'
              };
    <?php

        }

  ?>
  <?php
    foreach ($themicas as $key => $mica) {
      # code...

  ?>

              var options<?php echo $mica ?> = {
                title: '<?php echo $key ?> por dia',
                height: 600,
                hAxis: {
                  title: 'Dia'
                },
                vAxis: {
                  title: 'Biseles'
                },
                backgroundColor: '#f1f8e9'
              };
    <?php

        }

  ?>

  <?php
    foreach ($themateriales as $key => $mat) {
      # code...

  ?>

              var options<?php echo $mat ?> = {
                title: '<?php echo $key ?> por dia',
                height: 600,
                hAxis: {
                  title: 'Dia'
                },
                vAxis: {
                  title: 'Biseles'
                },
                backgroundColor: '#f1f8e9'
              };
    <?php

        }

  ?>
  <?php
    foreach ($thearmazon as $key => $arm) {
      # code...

  ?>
              var chart<?php echo $arm ?> = new google.visualization.LineChart(document.getElementById('<?php echo $arm; ?>'));
              chart<?php echo $arm ?>.draw(data<?php echo $arm ?>, options<?php echo $arm ?>);

    <?php

        }

  ?>

    <?php
    foreach ($themicas as $key => $mica) {
      # code...

  ?>
              var chart<?php echo $mica ?> = new google.visualization.LineChart(document.getElementById('<?php echo $mica; ?>'));
              chart<?php echo $mica ?>.draw(data<?php echo $mica ?>, options<?php echo $mica ?>);

    <?php

        }

  ?>

    <?php
    foreach ($themateriales as $key => $mat) {
      # code...

  ?>
              var chart<?php echo $mat ?> = new google.visualization.LineChart(document.getElementById('<?php echo $mat; ?>'));
              chart<?php echo $mat ?>.draw(data<?php echo $mat ?>, options<?php echo $mat ?>);

    <?php

        }

  ?>



            }



  </script>

<script type="text/javascript">
    var d = new Date();
    var n = d.getFullYear();
    document.getElementById("theYear").innerHTML = n;
</script>


<script type="text/javascript">

/*
  $('document').ready( function () {
    $('.jumbotron').css('display','none');

  <?php
    foreach ($thearmazon as $key => $value) {
      echo '
    $(".'.$value.'graph").click(function(){
      $(".jumbotron").css("display","none");
      $("#'.$value.'").slideDown("fast");
      $("#'.$value.'").css("display","inline");
    });';

    }
  ?>
  });
*/
</script>

<script type="text/javascript">

/*
  $('document').ready( function () {

  <?php
    foreach ($thearmazon as $key => $value) {
      echo '
      $("#'.$value.'").css("display","block")';

    }
  ?>
  });
*/
</script>
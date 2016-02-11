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
          min-height: 0.25%;
    }
    .jumbotron{
      padding-top: 5%;
    }

    ul li{
      list-style-type: none;
    }

    .back{
      -ms-transform: rotate(180deg); /* IE 9 */
      -webkit-transform: rotate(180deg); /* Safari */
      transform: rotate(180deg);
    }
  </style>
<?php

  include '../connection.php';


	$my_sql_conn =  new mysqli($servername,$user,$pwd,$db);

    $fechas = array();
    $result = $my_sql_conn->query("select fecha, count(*) as biseles from pedido where (armazon or materiales or micas or tratamiento or tipo or tecnico)!=' ' group by fecha");

    while($rs = $result->fetch_array(MYSQLI_ASSOC)){
      $fechas[$rs['fecha']] = $rs['biseles']; 
    }

    $fechasArmazon = array();
    $resultA = $my_sql_conn->query("select fecha, count(*) as biseles from pedido where armazon!=' ' and fecha>'2015-09-01' and fecha<'2016-09-01' group by fecha");

    while($rs = $resultA->fetch_array(MYSQLI_ASSOC)){
      $fechasArmazon[$rs['fecha']] = $rs['biseles']; 
    }

    $fechasMicas = array();
    $resultM = $my_sql_conn->query("select fecha, count(*) as biseles from pedido where micas!=' ' and fecha>'2015-09-01' and fecha<'2016-09-01' group by fecha");

    while($rs = $resultM->fetch_array(MYSQLI_ASSOC)){
      $fechasMicas[$rs['fecha']] = $rs['biseles']; 
    }

    $fechasMateriales = array();
    $resultMtles = $my_sql_conn->query("select fecha, count(*) as biseles from pedido where materiales!=' ' and fecha>'2015-09-01' and fecha<'2016-09-01'  group by fecha");

    while($rs = $resultMtles->fetch_array(MYSQLI_ASSOC)){
      $fechasMateriales[$rs['fecha']] = $rs['biseles']; 
    }

    $fechasTratamiento = array();
    $resultTmto = $my_sql_conn->query("select fecha, count(*) as biseles from pedido where tratamiento!=' ' and fecha>'2015-09-01' and fecha<'2016-09-01' group by fecha");

    while($rs = $resultTmto->fetch_array(MYSQLI_ASSOC)){
      $fechasTratamiento[$rs['fecha']] = $rs['biseles']; 
    }

    $fechasTipo = array();
    $resultType = $my_sql_conn->query("select fecha, count(*) as biseles from pedido where tipo!=' ' and fecha>'2015-09-01' and fecha<'2016-09-01' group by fecha");

    while($rs = $resultType->fetch_array(MYSQLI_ASSOC)){
      $fechasTipo[$rs['fecha']] = $rs['biseles']; 
    }

    $fechasTecnico = array();
    $resultTech = $my_sql_conn->query("select fecha, count(*) as biseles from pedido where tecnico!=' ' and fecha>'2015-09-01' and fecha<'2016-09-01' and fecha>'2015-09-13' group by fecha");

    while($rs = $resultTech->fetch_array(MYSQLI_ASSOC)){
      $fechasTecnico[$rs['fecha']] = $rs['biseles']; 
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
              <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  <p class="text-center"><img src="../img/png/tool700.png"></p><p class="text-center">Tratamiento</p>
                  <p class="text-center"><span class="caret"></span></p>
                </a>
                <ul class="dropdown-menu">
                  <?php
                      $resultTratamiento = $my_sql_conn->query("select tratamiento from pedido where tratamiento!=' ' group by tratamiento");
                      $i=0;
                      while($rs = $resultTratamiento->fetch_array(MYSQLI_ASSOC)){
                        $tratamiento[$i] = $rs['tratamiento'];
                        $thetratamiento[$tratamiento[$i]] = str_replace('-', '', $tratamiento[$i]);
                        $thetratamiento[$tratamiento[$i]] = str_replace(' ', '', $thetratamiento[$tratamiento[$i]]);
                        echo "<li><a href='#trat".$thetratamiento[$tratamiento[$i]]."link' class='".$thetratamiento[$tratamiento[$i]]."graph'>".$tratamiento[$i]."</a></li>";
                        $i += 1;
                      }

                  ?>                  
                </ul>
              </li>
              <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  <p class="text-center"><img src="../img/png/glasses48.png"></p><p class="text-center">Tipo</p>
                  <p class="text-center"><span class="caret"></span></p>
                </a>
                <ul class="dropdown-menu">
                  <?php
                      $resultTipo = $my_sql_conn->query("select tipo from pedido where tipo!=' ' group by tipo");
                      $i=0;
                      while($rs = $resultTipo->fetch_array(MYSQLI_ASSOC)){
                        $tipo[$i] = $rs['tipo'];
                        $thetipo[$tipo[$i]] = str_replace('-', '', $tipo[$i]);
                        $thetipo[$tipo[$i]] = str_replace(' ', '', $thetipo[$tipo[$i]]);
                        echo "<li><a href='#tipo".$thetipo[$tipo[$i]]."link' class='".$thetipo[$tipo[$i]]."graph'>".$tipo[$i]."</a></li>";
                        $i += 1;
                      }

                  ?>   
                </ul>
              </li>              
              <li>
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  <p class="text-center"><img src="../img/png/user219.png"></p><p class="text-center">Tecnico</p>
                  <p class="text-center"><span class="caret"></span></p>
              </a>
              <ul class="dropdown-menu">
                <?php
                      $resultTecnico = $my_sql_conn->query("select tecnico from pedido where tecnico!=' ' group by tecnico");
                      $i=0;
                      while($rs = $resultTecnico->fetch_array(MYSQLI_ASSOC)){
                        $tecnico[$i] = $rs['tecnico'];
                        $thetech[$tecnico[$i]] = str_replace('-', '', $tecnico[$i]);
                        $thetech[$tecnico[$i]] = str_replace(' ', '', $thetech[$tecnico[$i]]);
                        echo "<li><a href='#tech".$thetech[$tecnico[$i]]."link' class='".$thetech[$tecnico[$i]]."graph'>".$tecnico[$i]."</a></li>";
                        $i += 1;
                      }

                  ?>
              </ul>
              </li>              
              <li><a href="../"><p class="text-center"><img class="back" src="../img/png/next21.png"></p><p class="text-center">Volver</p></a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right veoteimg">
            </ul>
          </div>
        </div>
      </nav>

    <div id="armazones" class="jumbotron">
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

</div>
    <div id="micas" class="jumbotron">
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
</div>

    <div id="materiales"class="jumbotron">
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

    <div id="tratamiento" class="jumbotron">
<?php
    foreach ($thetratamiento as $key => $value) {
      echo '
      <div class="container" id="trat'.$value.'link">
        <div class="row"><h3 class="text-center">'.$key.'</h3></div>
        <div class="row">
            <div id="'.$value.'"></div>
        </div>
      </div>';      
    }
?>
  </div>
    

    <div id="tipo" class="jumbotron">
<?php
    foreach ($thetipo as $key => $value) {
      echo '
      <div class="container" id="tipo'.$value.'link">
        <div class="row"><h3 class="text-center">'.$key.'</h3></div>
        <div class="row">
            <div id="'.$value.'"></div>
        </div>
      </div>';      
    }
?>

    </div>

    <div id="tecnico" class="jumbotron">
<?php
    foreach ($thetech as $key => $value) {
      echo '
      <div class="container" id="tech'.$value.'link">
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
  ?>
              var data<?php echo $arm ?> = new google.visualization.DataTable();
              data<?php echo $arm ?>.addColumn('date', 'Dia');
              data<?php echo $arm ?>.addColumn('number', '<?php echo $keyarm; ?>');

              data<?php echo $arm ?>.addRows([
                <?php
                  foreach ($fechasArmazon as $key => $value) {
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
  ?>
              var data<?php echo $mica ?> = new google.visualization.DataTable();
              data<?php echo $mica ?>.addColumn('date', 'Dia');
              data<?php echo $mica ?>.addColumn('number', '<?php echo $keymicas; ?>');

              data<?php echo $mica ?>.addRows([
                <?php
                  foreach ($fechasMicas as $key => $value) {
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
  ?>
              var data<?php echo $mat ?> = new google.visualization.DataTable();
              data<?php echo $mat ?>.addColumn('date', 'Dia');
              data<?php echo $mat ?>.addColumn('number', '<?php echo $keymat; ?>');

              data<?php echo $mat ?>.addRows([
                <?php
                  foreach ($fechasMateriales as $key => $value) {
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
    foreach ($thetratamiento as $keytrat => $trat) {
  ?>
              var data<?php echo $trat ?> = new google.visualization.DataTable();
              data<?php echo $trat ?>.addColumn('date', 'Dia');
              data<?php echo $trat ?>.addColumn('number', '<?php echo $keytrat; ?>');

              data<?php echo $trat ?>.addRows([
                <?php
                  foreach ($fechasTratamiento as $key => $value) {
                    $annio = substr($key, 0,4);
                    $mes = substr($key, 5,2);
                    $dia = substr($key, 8,2);

                    $total = $my_sql_conn->query("select count(*) as total from pedido where fecha = '$key' and tratamiento='$keytrat'"); 
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
    foreach ($thetipo as $keytype => $tipo) {
  ?>
              var data<?php echo $tipo ?> = new google.visualization.DataTable();
              data<?php echo $tipo ?>.addColumn('date', 'Dia');
              data<?php echo $tipo ?>.addColumn('number', '<?php echo $keytype; ?>');

              data<?php echo $tipo ?>.addRows([
                <?php
                  foreach ($fechasTipo as $key => $value) {
                    $annio = substr($key, 0,4);
                    $mes = substr($key, 5,2);
                    $dia = substr($key, 8,2);

                    $total = $my_sql_conn->query("select count(*) as total from pedido where fecha = '$key' and tipo='$keytype'"); 
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
    foreach ($thetech as $keytech => $tech) {
  ?>
              var data<?php echo $tech ?> = new google.visualization.DataTable();
              data<?php echo $tech ?>.addColumn('date', 'Dia');
              data<?php echo $tech ?>.addColumn('number', '<?php echo $keytech; ?>');

              data<?php echo $tech ?>.addRows([
                <?php
                  foreach ($fechasTecnico as $key => $value) {
                    $annio = substr($key, 0,4);
                    $mes = substr($key, 5,2);
                    $dia = substr($key, 8,2);

                    $total = $my_sql_conn->query("select count(*) as total from pedido where fecha = '$key' and tecnico='$keytech'"); 
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
    foreach ($themicas as $key => $mica) {
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
    foreach ($thetipo as $key => $tipo) {
  ?>

              var options<?php echo $tipo ?> = {
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
    foreach ($thetratamiento as $key => $trat) {
  ?>

              var options<?php echo $trat ?> = {
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
    foreach ($thetech as $key => $tech) {
  ?>

              var options<?php echo $tech ?> = {
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
  ?>
              var chart<?php echo $arm ?> = new google.visualization.LineChart(document.getElementById('<?php echo $arm; ?>'));
              chart<?php echo $arm ?>.draw(data<?php echo $arm ?>, options<?php echo $arm ?>);

    <?php

        }

  ?>

  <?php
    foreach ($themicas as $key => $mica) {
  ?>
              var chart<?php echo $mica ?> = new google.visualization.LineChart(document.getElementById('<?php echo $mica; ?>'));
              chart<?php echo $mica ?>.draw(data<?php echo $mica ?>, options<?php echo $mica ?>);

    <?php
        }
  ?>

    <?php
    foreach ($themateriales as $key => $mat) {
  ?>
              var chart<?php echo $mat ?> = new google.visualization.LineChart(document.getElementById('<?php echo $mat; ?>'));
              chart<?php echo $mat ?>.draw(data<?php echo $mat ?>, options<?php echo $mat ?>);

    <?php

        }

  ?>


    <?php
    foreach ($thetratamiento as $key => $trat) {
  ?>
              var chart<?php echo $trat ?> = new google.visualization.LineChart(document.getElementById('<?php echo $trat; ?>'));
              chart<?php echo $trat ?>.draw(data<?php echo $trat ?>, options<?php echo $trat ?>);

    <?php

        }

  ?>

    <?php
    foreach ($thetipo as $key => $tipo) {
  ?>
              var chart<?php echo $tipo ?> = new google.visualization.LineChart(document.getElementById('<?php echo $tipo; ?>'));
              chart<?php echo $tipo ?>.draw(data<?php echo $tipo ?>, options<?php echo $tipo ?>);

    <?php

        }

  ?>


    <?php
    foreach ($thetech as $key => $tech) {
  ?>
              var chart<?php echo $tech ?> = new google.visualization.LineChart(document.getElementById('<?php echo $tech; ?>'));
              chart<?php echo $tech ?>.draw(data<?php echo $tech ?>, options<?php echo $tech ?>);

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
  $('document').ready( function () { 
    $('h2').addClass('text-center');

      $('#micas, #armazones, #materiales, #tratamiento, #tipo, #tecnico').fadeOut();

<?php
      foreach ($themicas as $key => $value) {
?>
        $('.<?php echo $value ?>graph').click(function(){
          //$(this).parents('ul').children('*').removeClass('active');
          //$(this).parent('li').addClass('active');
          $('#micas, #armazones, #materiales, #tratamiento, #tipo, #tecnico').fadeOut();
          $('#micas').fadeIn();
        });

<?php } ?>

<?php
      foreach ($thearmazon as $key => $value) {
?>
        $('.<?php echo $value ?>graph').click(function(){
          //$(this).parents('ul').children('*').removeClass('active');
          //$(this).parent('li').addClass('active');
          $('#micas, #armazones, #materiales, #tratamiento, #tipo, #tecnico').fadeOut();
          $('#armazones').fadeIn();
        });

<?php } ?>


<?php
      foreach ($themateriales as $key => $value) {
?>
        $('.<?php echo $value ?>graph').click(function(){
          //$(this).parents('ul').children('*').removeClass('active');
          //$(this).parent('li').addClass('active');
          $('#micas, #armazones, #materiales, #tratamiento, #tipo, #tecnico').fadeOut();
          $('#materiales').fadeIn();
        });

<?php } ?>


<?php
      foreach ($thetratamiento as $key => $value) {
?>
        $('.<?php echo $value ?>graph').click(function(){
          //$(this).parents('ul').children('*').removeClass('active');
          //$(this).parent('li').addClass('active');
          $('#micas, #armazones, #materiales, #tratamiento, #tipo, #tecnico').fadeOut();
          $('#tratamiento').fadeIn();
        });

<?php } ?>


<?php
      foreach ($thetipo as $key => $value) {
?>
        $('.<?php echo $value ?>graph').click(function(){
          //$(this).parents('ul').children('*').removeClass('active');
          //$(this).parent('li').addClass('active');
          $('#micas, #armazones, #materiales, #tratamiento, #tipo, #tecnico').fadeOut();
          $('#tipo').fadeIn();
        });

<?php } ?>


<?php
      foreach ($thetech as $key => $value) {
?>
        $('.<?php echo $value ?>graph').click(function(){
          //$(this).parents('ul').children('*').removeClass('active');
          //$(this).parent('li').addClass('active');
          $('#micas, #armazones, #materiales, #tratamiento, #tipo, #tecnico').fadeOut();
          $('#tecnico').fadeIn();
        });

<?php } ?>


  });

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
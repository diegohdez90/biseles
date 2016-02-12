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
  <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300' rel='stylesheet' type='text/css'>


  <style type="text/css">
    .nav-pills>li.active>a, .nav-pills>li.active>a:focus, .nav-pills>li.active>a:hover {
        color: #fff;
        background-color: rgb(0,172,200);
    }

  </style>
<?php

  include '../connection.php';


  $my_sql_conn =  new mysqli($servername,$user,$pwd,$db);

    $fechas = array();
    $result = $my_sql_conn->query("select fecha, count(*) as biseles from pedido where fecha>'2015-09-01' and fecha<'2016-09-01' group by fecha");

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

                      $resultArmazones = $my_sql_conn->query("select armazon from pedido where armazon!=' ' group by armazon");
                      $i=0;
                      while($rs = $resultArmazones->fetch_array(MYSQLI_ASSOC)){
                        $armazon[$i] = $rs['armazon'];
                        $thearmazon[$armazon[$i]] = str_replace(' ', '', $armazon[$i]);
                        $i += 1;
                      }

                      $resultMicas = $my_sql_conn->query("select micas from pedido where micas!=' ' group by micas");
                      $i=0;
                      while($rs = $resultMicas->fetch_array(MYSQLI_ASSOC)){
                        $micas[$i] = $rs['micas'];
                        $themicas[$micas[$i]] = str_replace('-', '', $micas[$i]);
                        $i += 1;
                      }

                      $resultMateriales = $my_sql_conn->query("select materiales from pedido where materiales!=' ' group by materiales");
                      $i=0;
                      while($rs = $resultMateriales->fetch_array(MYSQLI_ASSOC)){
                        $materiales[$i] = $rs['materiales'];
                        $themateriales[$materiales[$i]] = str_replace('-', '', $materiales[$i]);
                        $i += 1;
                      }

                      $resultTratamiento = $my_sql_conn->query("select tratamiento from pedido where tratamiento!=' ' group by tratamiento");
                      $i=0;
                      while($rs = $resultTratamiento->fetch_array(MYSQLI_ASSOC)){
                        $tratamiento[$i] = $rs['tratamiento'];
                        $thetratamiento[$tratamiento[$i]] = str_replace('-', '', $tratamiento[$i]);
                        $thetratamiento[$tratamiento[$i]] = str_replace(' ', '', $thetratamiento[$tratamiento[$i]]);
                        $i += 1;
                      }

                      $resultTipo = $my_sql_conn->query("select tipo from pedido where tipo!=' ' group by tipo");
                      $i=0;
                      while($rs = $resultTipo->fetch_array(MYSQLI_ASSOC)){
                        $tipo[$i] = $rs['tipo'];
                        $thetipo[$tipo[$i]] = str_replace('-', '', $tipo[$i]);
                        $thetipo[$tipo[$i]] = str_replace(' ', '', $thetipo[$tipo[$i]]);
                        $i += 1;
                      }

                      $resultTecnico = $my_sql_conn->query("select tecnico from pedido where tecnico!=' ' group by tecnico");
                      $i=0;
                      while($rs = $resultTecnico->fetch_array(MYSQLI_ASSOC)){
                        $tecnico[$i] = $rs['tecnico'];
                        $thetech[$tecnico[$i]] = str_replace('-', '', $tecnico[$i]);
                        $thetech[$tecnico[$i]] = str_replace(' ', '', $thetech[$tecnico[$i]]);
                        $i += 1;
                      }


?>

  <script type="text/javascript">
  </script>


  <script type="text/javascript">
    $('document').ready(function () {
      $('body').append('<div class="container"></div>');
      $('.container').append('<div class="row"></div>');
      $('.row').addClass('header');
      $('.header').html('<h1>Biseles</h1>');
      $('h1').addClass('text-center');
      $('.container').append('<div class="col-md-2"></div>');
      $('.col-md-2').append('<ul role="tablist"></ul>');
      $('ul').addClass('nav nav-pills nav-stacked content');
      $('.nav, .nav-pills, .nav-stacked').append(' <li class="active"><a class="a" href="#inicio">Inicio</a></li>'+
        '<li><a class="b" href="#armazones">Armazones</a></li>'+
        '<li><a class="c" href="#micas">Micas</a></li>'+
        '<li><a class="d" href="#materiales">Materiales</a></li>'+
        '<li><a class="e" href="#tratamiento">Tratamiento</a></li>'+
        '<li><a class="f" href="#tipo">Tipo</a></li>'+
        '<li><a class="g" href="#tecnico">Tecnico</a></li>'+
        '<li><a class="h" href="#acerca">Acerca De</a></li>        ');
      $('.container').append('<div class="col-md-8"></div>');
      $('.col-md-8').append('<div id="chart"></div>');
      $('.col-md-8').append('<div id="armazones"></div>');
      $('.col-md-8').append('<div id="micas"></div>');
      $('.col-md-8').append('<div id="materiales"></div>');
      $('.col-md-8').append('<div id="tratamiento"></div>');
      $('.col-md-8').append('<div id="tipo"></div>');
      $('.col-md-8').append('<div id="tecnico"></div>');
      $('.col-md-8').append('<div id="acerca"></div>');
      $('#micas, #armazones, #materiales, #tratamiento, #tipo, #tecnico, #acerca').fadeOut();

      $('#micas').append('<div class="container-fluid">'+
        '</div>');

      $('#micas').children('.container-fluid').append('<div id="micas_chart"></div>');




      $('#armazones').append('<div class="container-fluid">'+
        '</div>');

      $('#armazones').children('.container-fluid').append('<div id="armazon_chart"></div>');



      $('#materiales').append('<div class="container-fluid">'+
        '</div>');

      $('#materiales').children('.container-fluid').append('<div id="materiales_chart"></div>');



      $('#tratamiento').append('<div class="container-fluid">'+
        '</div>');

      $('#tratamiento').children('.container-fluid').append('<div id="tratamiento_chart"></div>');



      $('#tipo').append('<div class="container-fluid">'+
        '</div>');

      $('#tipo').children('.container-fluid').append('<div id="tipo_chart"></div>');


      $('#tecnico').append('<div class="container-fluid">'+
        '</div>');

      $('#tecnico').children('.container-fluid').append('<div id="tecnico_chart"></div>?>');


      $('#acerca').append('<div class="container-fluid"></div>');
      $('#acerca').children('div').append('<h1>Diego Arturo Hernandez Fuentes</h1>');
      $('#acerca').children('div').find('h1').addClass('text-center');
      $('#acerca').children('div').find('h1').append(' <small>Desarrollador</small>');

      var extracto = 'Alumno egresado de la Facultad de Ciencias de la Computacion de la Benemerita Universidad'+
      ' Autonoma de Puebla con el grado de Licenciado en Ingenieria en Ciencias de la Computacion.';
      var habilidades = 'Desde temprana edad mostre habilidades para las matematicas, materia donde mostre tener '+
      'gran desempe&ntilde;o en la escuela. Adem&aacute;s, desde la eduaci&oacute;n primaria estuve interesado en la Computaci&oacute;n, '+
      'materia que me ense&ntilde;aron desde primer a&ntilde;o. Pasando por el nivel de Secundaria, obtuve habilidades en '+
      'el uso del Sistema Operativo Windows y en el uso de Microsoft Office. En el Bachillerato obtuve los mismos conomientos '+
      'de Office y de mantenimiento del equipo y un poco de desarollo en Visual Basic, primer lenguaje de Progrmaci&oacute;n que us&eacute. '+
      'Durante la Universidad mostre gran desempe&ntilde;o en la metodolog&iacute;a de la programaci&oacute;n y en el lenguaje C, '+
      'primer lenguaje que domino en la Universidad. Despu&eacute;es aprend&iacute; Java, primero, fue el lenguaje que me complic&oacute '+
      'aprender, pero fue en la materia de Estructuras de Datos y Programaci&oacute;n Concurrente y Paralela donde desarrolle '+
      'mi habilidad en el uso de este lenguaje de Programaci&oacute;n Orientado a Objetos. Desarrolle habilidades en materias de '+
      'Ingenier&iacute;a de Software, Modelo de Redes, Desarrollo de Apliciones Moviles, Aplicaciones Multimedia, Aplicaciones Web, Bases de Datos y Sistemas Operativos. '+
      'En la materia de Aplicaciones Web use la herramienta de Google App Engine que nos proporcin&oacute; para este curso para desarrollar un blog '+
      'de las herramientas que estamos viendo durante el curso. Durante mis Pr&aacute;cticas Profesionales, actualice la p&aacute;gina web de la '+
      'Facultad de Ingenier&iacute;a Qu&iacute;mica con el modelo que usa la Universidad debido al cambio de imagen. Use las herramientas desarrollo '+
      'responsivo de Bootstrap y desarroll&eacute; algunas secciones con jQuery, un plus al nuevo sitio de esta Facultad. '+
      'PHP lo aprend&iacute; a usar hasta el final de la carrera, y ahora que obtuve mi '+
      'primera oportunidad laboral desarrolle aplicciones usando las herramientas responsivas de Bootstrap y los API de Google, como: Google Fonts, '+
      'Google Chart, Google Maps; adem&aacute;s algunos proyectos us&eacute; AngularJS para los formularios y extracci&oacute;n de informaci&oacute;n de '+
      'Bases de Datos MySQL.';

      $('#acerca').children('div').append('<p>'+extracto+'</p><p>'+habilidades+'</p>');


      $('#acerca').children('div').find('p').addClass('text-justify')

      $('.a').click(function(){
        $('.content').children().removeClass('active');
        $('#micas, #armazones, #materiales, #tratamiento, #tipo, #tecnico, #acerca').fadeOut();
        $('#chart').fadeIn();
        $(this).parent().addClass('active');
      });
      $('.b').click(function(){
        $('.content').children().removeClass('active');
        $('#chart, #micas, #materiales, #tratamiento, #tipo, #tecnico, #acerca').fadeOut();
        $('#armazones').fadeIn();
        $(this).parent().addClass('active');
      });
      $('.c').click(function(){
        $('.content').children().removeClass('active');
        $('#chart, #armazones, #materiales, #tratamiento, #tipo, #tecnico, #acerca').fadeOut();
        $('#micas').fadeIn();
        $(this).parent().addClass('active');
      });
      $('.d').click(function(){
        $('.content').children().removeClass('active');
        $('#chart, #armazones, #micas, #tratamiento, #tipo, #tecnico, #acerca').fadeOut();
        $('#materiales').fadeIn();
        $(this).parent().addClass('active');
      });
      $('.e').click(function(){
        $('.content').children().removeClass('active');
        $('#chart, #armazones, #materiales, #micas, #tipo, #tecnico, #acerca').fadeOut();
        $('#tratamiento').fadeIn();
        $(this).parent().addClass('active');
      });
      $('.f').click(function(){
        $('.content').children().removeClass('active');
        $('#chart, #armazones, #materiales, #tratamiento, #micas, #tecnico, #acerca').fadeOut();
        $('#tipo').fadeIn();
        $(this).parent().addClass('active');
      });
      $('.g').click(function(){
        $('.content').children().removeClass('active');
        $('#chart, #armazones, #materiales, #tratamiento, #tipo, #micas, #acerca').fadeOut();
        $('#tecnico').fadeIn();
        $(this).parent().addClass('active');
      });
      $('.h').click(function(){
        $('.content').children().removeClass('active');
        $('#chart, #armazones, #materiales, #tratamiento, #tipo, #micas, #tecnico').fadeOut();
        $('#acerca').fadeIn();
        $(this).parent().addClass('active');
      });

      $('body').append('<footer></footer>');
      $('footer').append('<p>Veotek<i class="material-icons" style="font-size:16px;">copyright</i> <span id="Today"></span></p>');
      $('footer').children('p').addClass('text-center');

      var d = new Date();
      var n = d.getFullYear();
      document.getElementById("Today").innerHTML = n;


    });
      
  </script>


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
        height: 400,
        hAxis: {
          title: 'Dia'
        },
        vAxis: {
          title: 'Biseles'
        },
        backgroundColor: '#f1f8e9'
      };
      var chart = new google.visualization.LineChart(document.getElementById('chart'));
      chart.draw(data, options);

      var dataArmazon = new google.visualization.DataTable();
      dataArmazon.addColumn('date', 'Dia');
    <?php
      foreach ($armazon as $key => $value) {
  ?>    

      dataArmazon.addColumn('number', '<?php echo $value ?>');
  <?php
    }
    ?>

      dataArmazon.addRows([
        <?php
            foreach($fechasArmazon as $f => $cantidad) { 
                $selectFecha = $f;
                $annio = substr($f, 0,4);
                $mes = substr($f, 5,2);
                $dia = substr($f, 8,2);
        ?>
         <?php echo "[new Date(".$annio.",".($mes-1).",".$dia."),";?>
         <?php 

          foreach ($armazon as $key => $value) { 
            $total = $my_sql_conn->query("select count(*) as total from pedido where fecha = '$selectFecha' and armazon='$value'"); 
            while($rs = $total->fetch_array(MYSQLI_ASSOC)){ 
                echo $rs['total'].",";
          } 
        }
        echo "],";
        } 
        ?>

    
    ]);

      var optionsArmazon = {
        title: 'Armazones por dia',
        height: 400,
        hAxis: {
          title: 'Dia'
        },
        vAxis: {
          title: 'Cantidad'
        },
        backgroundColor: '#f1f8e9'
      };

      var chartArmazon = new google.visualization.LineChart(document.getElementById('armazon_chart'));
      chartArmazon.draw(dataArmazon, optionsArmazon);


      var dataMicas = new google.visualization.DataTable();
      dataMicas.addColumn('date', 'Dia');
    <?php
      foreach ($micas as $key => $value) {
  ?>    

      dataMicas.addColumn('number', '<?php echo $value ?>');
  <?php
    }
    ?>

      dataMicas.addRows([
        <?php
            foreach($fechasMicas as $f => $cantidad) { 
                $selectFecha = $f;
                $annio = substr($f, 0,4);
                $mes = substr($f, 5,2);
                $dia = substr($f, 8,2);
        ?>
         <?php echo "[new Date(".$annio.",".($mes-1).",".$dia."),";?>
         <?php 

          foreach ($micas as $key => $value) { 
            $total = $my_sql_conn->query("select count(*) as total from pedido where fecha = '$selectFecha' and micas='$value'"); 
            while($rs = $total->fetch_array(MYSQLI_ASSOC)){ 
                echo $rs['total'].",";
          } 
        }
        echo "],";
        } 
        ?>

    
    ]);

      var optionsMicas = {
        title: 'Micas por dia',
        height: 400,
        hAxis: {
          title: 'Dia'
        },
        vAxis: {
          title: 'Cantidad'
        },
        backgroundColor: '#f1f8e9'
      };

      var chartMicas = new google.visualization.LineChart(document.getElementById('micas_chart'));
      chartMicas.draw(dataMicas, optionsMicas);


      var dataMateriales = new google.visualization.DataTable();
      dataMateriales.addColumn('date', 'Dia');
    <?php
      foreach ($materiales as $key => $value) {
  ?>    

      dataMateriales.addColumn('number', '<?php echo $value ?>');
  <?php
    }
    ?>

      dataMateriales.addRows([
        <?php
            foreach($fechasMateriales as $f => $cantidad) { 
                $selectFecha = $f;
                $annio = substr($f, 0,4);
                $mes = substr($f, 5,2);
                $dia = substr($f, 8,2);
        ?>
         <?php echo "[new Date(".$annio.",".($mes-1).",".$dia."),";?>
         <?php 

          foreach ($materiales as $key => $value) { 
            $total = $my_sql_conn->query("select count(*) as total from pedido where fecha = '$selectFecha' and materiales='$value'"); 
            while($rs = $total->fetch_array(MYSQLI_ASSOC)){ 
                echo $rs['total'].",";
          } 
        }
        echo "],";
        } 
        ?>

    
    ]);

      var optionsMateriales = {
        title: 'Materiales por dia',
        height: 400,
        hAxis: {
          title: 'Dia'
        },
        vAxis: {
          title: 'Cantidad'
        },
        backgroundColor: '#f1f8e9'
      };

      var chartMateriales = new google.visualization.LineChart(document.getElementById('materiales_chart'));
      chartMateriales.draw(dataMateriales, optionsMateriales);



      var dataTecnico = new google.visualization.DataTable();
      dataTecnico.addColumn('date', 'Dia');
    <?php
      foreach ($tecnico as $key => $value) {
  ?>    

      dataTecnico.addColumn('number', '<?php echo $value ?>');
  <?php
    }
    ?>

      dataTecnico.addRows([
        <?php
            foreach($fechasTecnico as $f => $cantidad) { 
                $selectFecha = $f;
                $annio = substr($f, 0,4);
                $mes = substr($f, 5,2);
                $dia = substr($f, 8,2);
        ?>
         <?php echo "[new Date(".$annio.",".($mes-1).",".$dia."),";?>
         <?php 

          foreach ($tecnico as $key => $value) { 
            $total = $my_sql_conn->query("select count(*) as total from pedido where fecha = '$selectFecha' and tecnico='$value'"); 
            while($rs = $total->fetch_array(MYSQLI_ASSOC)){ 
                echo $rs['total'].",";
          } 
        }
        echo "],";
        } 
        ?>

    
    ]);

      var optionsTecnico = {
        title: 'Tecnico por dia',
        height: 400,
        hAxis: {
          title: 'Dia'
        },
        vAxis: {
          title: 'Cantidad'
        },
        backgroundColor: '#f1f8e9'
      };

      var chartTecnico = new google.visualization.LineChart(document.getElementById('tecnico_chart'));
      chartTecnico.draw(dataTecnico, optionsTecnico);


      var dataTipo = new google.visualization.DataTable();
      dataTipo.addColumn('date', 'Dia');
    <?php
      foreach ($tipo as $key => $value) {
  ?>    

      dataTipo.addColumn('number', '<?php echo $value ?>');
  <?php
    }
    ?>

      dataTipo.addRows([
        <?php
            foreach($fechasTipo as $f => $cantidad) { 
                $selectFecha = $f;
                $annio = substr($f, 0,4);
                $mes = substr($f, 5,2);
                $dia = substr($f, 8,2);
        ?>
         <?php echo "[new Date(".$annio.",".($mes-1).",".$dia."),";?>
         <?php 

          foreach ($tipo as $key => $value) { 
            $total = $my_sql_conn->query("select count(*) as total from pedido where fecha = '$selectFecha' and tipo='$value'"); 
            while($rs = $total->fetch_array(MYSQLI_ASSOC)){ 
                echo $rs['total'].",";
          } 
        }
        echo "],";
        } 
        ?>

    
    ]);

      var optionsTipo = {
        title: 'Tipo por dia',
        height: 400,
        hAxis: {
          title: 'Dia'
        },
        vAxis: {
          title: 'Cantidad'
        },
        backgroundColor: '#f1f8e9'
      };

      var chartTipo = new google.visualization.LineChart(document.getElementById('tipo_chart'));
      chartTipo.draw(dataTipo, optionsTipo);


      var dataTratamiento = new google.visualization.DataTable();
      dataTratamiento.addColumn('date', 'Dia');
    <?php
      foreach ($tratamiento as $key => $value) {
  ?>    

      dataTratamiento.addColumn('number', '<?php echo $value ?>');
  <?php
    }
    ?>

      dataTratamiento.addRows([
        <?php
            foreach($fechasTratamiento as $f => $cantidad) { 
                $selectFecha = $f;
                $annio = substr($f, 0,4);
                $mes = substr($f, 5,2);
                $dia = substr($f, 8,2);
        ?>
         <?php echo "[new Date(".$annio.",".($mes-1).",".$dia."),";?>
         <?php 

          foreach ($tratamiento as $key => $value) { 
            $total = $my_sql_conn->query("select count(*) as total from pedido where fecha = '$selectFecha' and tratamiento='$value'"); 
            while($rs = $total->fetch_array(MYSQLI_ASSOC)){ 
                echo $rs['total'].",";
          } 
        }
        echo "],";
        } 
        ?>

    
    ]);

      var optionsTratamiento = {
        title: 'Tratamientos por dia',
        height: 400,
        hAxis: {
          title: 'Dia'
        },
        vAxis: {
          title: 'Cantidad'
        },
        backgroundColor: '#f1f8e9'
      };

      var chartTratamiento = new google.visualization.LineChart(document.getElementById('tratamiento_chart'));
      chartTratamiento.draw(dataTratamiento, optionsTratamiento);






    }

  </script>



  <style type="text/css">

    footer{
      min-height: 2%;
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




  </head>




  <body>

  </body>


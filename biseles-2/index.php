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

    $fechasArmazon = array();
    $resultA = $my_sql_conn->query("select fecha, count(*) as biseles from pedido where armazon!=' ' and fecha<'2016-09-01' group by fecha");

    while($rs = $resultA->fetch_array(MYSQLI_ASSOC)){
      $fechasArmazon[$rs['fecha']] = $rs['biseles']; 
    }

    $fechasMicas = array();
    $resultM = $my_sql_conn->query("select fecha, count(*) as biseles from pedido where micas!=' ' and fecha<'2016-09-01' group by fecha");

    while($rs = $resultM->fetch_array(MYSQLI_ASSOC)){
      $fechasMicas[$rs['fecha']] = $rs['biseles']; 
    }

    $fechasMateriales = array();
    $resultMtles = $my_sql_conn->query("select fecha, count(*) as biseles from pedido where materiales!=' ' and fecha<'2016-09-01'  group by fecha");

    while($rs = $resultMtles->fetch_array(MYSQLI_ASSOC)){
      $fechasMateriales[$rs['fecha']] = $rs['biseles']; 
    }

    $fechasTratamiento = array();
    $resultTmto = $my_sql_conn->query("select fecha, count(*) as biseles from pedido where tratamiento!=' ' and fecha<'2016-09-01' group by fecha");

    while($rs = $resultTmto->fetch_array(MYSQLI_ASSOC)){
      $fechasTratamiento[$rs['fecha']] = $rs['biseles']; 
    }

    $fechasTipo = array();
    $resultType = $my_sql_conn->query("select fecha, count(*) as biseles from pedido where tipo!=' ' and fecha<'2016-09-01' group by fecha");

    while($rs = $resultType->fetch_array(MYSQLI_ASSOC)){
      $fechasTipo[$rs['fecha']] = $rs['biseles']; 
    }

    $fechasTecnico = array();
    $resultTech = $my_sql_conn->query("select fecha, count(*) as biseles from pedido where tecnico!=' ' and fecha<'2016-09-01' and fecha>'2015-09-13' group by fecha");

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
        '<ul class="nav nav-tabs" role="tablist">'+
<?php
      foreach ($themicas as $key => $value) {
?>
          '<li><a class="<?php echo $key ?>link" href="#<?php echo $value; ?>_chart"><?php echo $key; ?></a></li>'+
<?php
      }
?>
        '</ul>'+
        +'</div>');

      $('#micas').children('.container-fluid').append('<?php foreach ($themicas as $key => $value) { ?><div id="<?php echo $value ?>_chart"></div><?php } ?>');
      $('#micas').children('.container-fluid').children('div').fadeOut();
      $('#micas').children('.container-fluid').children('div:first').fadeIn(); 
      $('#micas').children('.container-fluid').children('ul').children('li:first').addClass("active");


<?php
      foreach ($themicas as $key => $value) {
?>
        $('.<?php echo $key ?>link').click(function(){
          $(this).parents('ul').children('*').removeClass('active');
          $(this).parent('li').addClass('active');
          $('#micas').children('.container-fluid').children('div').fadeOut();
          $('#micas').children('.container-fluid').children('#<?php echo $value ?>_chart').fadeIn(); 
        });

<?php } ?>


      $('#armazones').append('<div class="container-fluid">'+
        '<ul class="nav nav-tabs" role="tablist">'+
<?php
      foreach ($thearmazon as $key => $value) {
?>
          '<li><a class="<?php echo $value ?>link" href="#<?php echo $value; ?>_chart"><?php echo $key; ?></a></li>'+
<?php
      }
?>
        '</ul>'+
        +'</div>');

      $('#armazones').children('.container-fluid').append('<?php foreach ($thearmazon as $key => $value) { ?><div id="<?php echo $value ?>_chart"></div><?php } ?>');
      $('#armazones').children('.container-fluid').children('div').fadeOut();
      $('#armazones').children('.container-fluid').children('div:first').fadeIn(); 
      $('#armazones').children('.container-fluid').children('ul').children('li:first').addClass("active");


<?php
      foreach ($thearmazon as $key => $value) {
?>
        $('.<?php echo $value ?>link').click(function(){
          $(this).parents('ul').children('*').removeClass('active');
          $(this).parent('li').addClass('active');
          $('#armazones').children('.container-fluid').children('div').fadeOut();
          $('#armazones').children('.container-fluid').children('#<?php echo $value ?>_chart').fadeIn(); 
        });

<?php } ?>


      $('#materiales').append('<div class="container-fluid">'+
        '<ul class="nav nav-tabs" role="tablist">'+
<?php
      foreach ($themateriales as $key => $value) {
?>
          '<li><a class="<?php echo $key ?>link" href="#<?php echo $key; ?>_chart"><?php echo $key; ?></a></li>'+
<?php
      }
?>
        '</ul>'+
        +'</div>');

      $('#materiales').children('.container-fluid').append('<?php foreach ($themateriales as $key => $value) { ?><div id="<?php echo $value ?>_chart"></div><?php } ?>');
      $('#materiales').children('.container-fluid').children('div').fadeOut();
      $('#materiales').children('.container-fluid').children('div:first').fadeIn(); 
      $('#materiales').children('.container-fluid').children('ul').children('li:first').addClass("active");


<?php
      foreach ($themateriales as $key => $value) {
?>
        $('.<?php echo $key ?>link').click(function(){
          $(this).parents('ul').children('*').removeClass('active');
          $(this).parent('li').addClass('active');
          $('#materiales').children('.container-fluid').children('div').fadeOut();
          $('#materiales').children('.container-fluid').children('#<?php echo $value ?>_chart').fadeIn(); 
        });

<?php } ?>

      $('#tratamiento').append('<div class="container-fluid">'+
        '<ul class="nav nav-tabs" role="tablist">'+
<?php
      foreach ($thetratamiento as $key => $value) {
?>
          '<li><a class="<?php echo $key ?>link" href="#<?php echo $key; ?>_chart"><?php echo $key; ?></a></li>'+
<?php
      }
?>
        '</ul>'+
        +'</div>');

      $('#tratamiento').children('.container-fluid').append('<?php foreach ($thetratamiento as $key => $value) { ?><div id="<?php echo $value ?>_chart"></div><?php } ?>');
      $('#tratamiento').children('.container-fluid').children('div').fadeOut();
      $('#tratamiento').children('.container-fluid').children('div:first').fadeIn(); 
      $('#tratamiento').children('.container-fluid').children('ul').children('li:first').addClass("active");

<?php
      foreach ($thetratamiento as $key => $value) {
?>
        $('.<?php echo $key ?>link').click(function(){
          $(this).parents('ul').children('*').removeClass('active');
          $(this).parent('li').addClass('active');
          $('#tratamiento').children('.container-fluid').children('div').fadeOut();
          $('#tratamiento').children('.container-fluid').children('#<?php echo $value ?>_chart').fadeIn(); 
        });

<?php } ?>

      $('#tipo').append('<div class="container-fluid">'+
        '<ul class="nav nav-tabs" role="tablist">'+
<?php
      foreach ($thetipo as $key => $value) {
?>
          '<li><a class="<?php echo $key ?>link" href="#<?php echo $key; ?>_chart"><?php echo $key; ?></a></li>'+
<?php
      }
?>
        '</ul>'+
        +'</div>');

      $('#tipo').children('.container-fluid').append('<?php foreach ($thetipo as $key => $value) { ?><div id="<?php echo $value ?>_chart"></div><?php } ?>');
      $('#tipo').children('.container-fluid').children('div').fadeOut();
      $('#tipo').children('.container-fluid').children('div:first').fadeIn(); 
      $('#tipo').children('.container-fluid').children('ul').children('li:first').addClass("active");

<?php
      foreach ($thetipo as $key => $value) {
?>
        $('.<?php echo $key ?>link').click(function(){
          $(this).parents('ul').children('*').removeClass('active');
          $(this).parent('li').addClass('active');
          $('#tipo').children('.container-fluid').children('div').fadeOut();
          $('#tipo').children('.container-fluid').children('#<?php echo $value ?>_chart').fadeIn(); 
        });

<?php } ?>

      $('#tecnico').append('<div class="container-fluid">'+
        '<ul class="nav nav-tabs" role="tablist">'+
<?php
      foreach ($thetech as $key => $value) {
?>
          '<li><a class="<?php echo $key ?>link" href="#<?php echo $key; ?>_chart"><?php echo $key; ?></a></li>'+
<?php
      }
?>
        '</ul>'+
        +'</div>');

      $('#tecnico').children('.container-fluid').append('<?php foreach ($thetech as $key => $value) { ?><div id="<?php echo $value ?>_chart"></div><?php } ?>');
      $('#tecnico').children('.container-fluid').children('div').fadeOut();
      $('#tecnico').children('.container-fluid').children('div:first').fadeIn(); 
      $('#tecnico').children('.container-fluid').children('ul').children('li:first').addClass("active");

<?php
      foreach ($thetech as $key => $value) {
?>
        $('.<?php echo $key ?>link').click(function(){
          $(this).parents('ul').children('*').removeClass('active');
          $(this).parent('li').addClass('active');
          $('#tecnico').children('.container-fluid').children('div').fadeOut();
          $('#tecnico').children('.container-fluid').children('#<?php echo $value ?>_chart').fadeIn(); 
        });

<?php } ?>

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
      'Bases de Datos MySQL';
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

  <?php
    foreach ($themicas as $key => $mica) {
  ?>

              var options<?php echo $mica ?> = {
                title: '<?php echo $key ?> por dia',
                height: 400,
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

              var options<?php echo $arm ?> = {
                title: '<?php echo $key ?> por dia',
                height: 400,
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
    foreach ($themateriales as $key => $arm) {
  ?>

              var options<?php echo $arm ?> = {
                title: '<?php echo $key ?> por dia',
                height: 400,
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
                height: 400,
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
                height: 400,
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
                height: 400,
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


      var chart = new google.visualization.LineChart(document.getElementById('chart'));
      chart.draw(data, options);

  <?php
    foreach ($themicas as $key => $mica) {
  ?>
              var chart<?php echo $mica ?> = new google.visualization.LineChart(document.getElementById('<?php echo $mica; ?>_chart'));
              chart<?php echo $mica ?>.draw(data<?php echo $mica ?>, options<?php echo $mica ?>);

    <?php
        }
  ?>
  <?php
    foreach ($thearmazon as $key => $arm) {
  ?>
              var chart<?php echo $arm ?> = new google.visualization.LineChart(document.getElementById('<?php echo $arm; ?>_chart'));
              chart<?php echo $arm ?>.draw(data<?php echo $arm ?>, options<?php echo $arm ?>);

    <?php

        }

  ?>

    <?php
    foreach ($themateriales as $key => $mat) {
  ?>
              var chart<?php echo $mat ?> = new google.visualization.LineChart(document.getElementById('<?php echo $mat; ?>_chart'));
              chart<?php echo $mat ?>.draw(data<?php echo $mat ?>, options<?php echo $mat ?>);

    <?php

        }
  ?>


    <?php
    foreach ($thetratamiento as $key => $trat) {
  ?>
              var chart<?php echo $trat ?> = new google.visualization.LineChart(document.getElementById('<?php echo $trat; ?>_chart'));
              chart<?php echo $trat ?>.draw(data<?php echo $trat ?>, options<?php echo $trat ?>);

    <?php

        }

  ?>

    <?php
    foreach ($thetipo as $key => $tipo) {
  ?>
              var chart<?php echo $tipo ?> = new google.visualization.LineChart(document.getElementById('<?php echo $tipo; ?>_chart'));
              chart<?php echo $tipo ?>.draw(data<?php echo $tipo ?>, options<?php echo $tipo ?>);

    <?php

        }

  ?>

    <?php
    foreach ($thetech as $key => $tech) {
  ?>
              var chart<?php echo $tech ?> = new google.visualization.LineChart(document.getElementById('<?php echo $tech; ?>_chart'));
              chart<?php echo $tech ?>.draw(data<?php echo $tech ?>, options<?php echo $tech ?>);

    <?php

        }

  ?>



    }
  </script>



  <style type="text/css">
    footer{
          min-height: 10%;
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


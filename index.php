<<<<<<< HEAD
<?php session_start(); error_reporting(E_ALL ^ E_NOTICE);if($_SESSION['us-mail']=='') header('Location: sessions.php');?>
<html lang="es">
<head>
  <title>WorkEvent</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="./js/moment.min.js" type="text/javascript"></script><!-- Moment -->
  <script src="./js/jquery.min.js"></script><!-- jQuery -->
  <link href="./css/bootstrap.min.css" rel="stylesheet"><!-- Bootstrap -->
  <script src="./js/bootstrap.min.js"></script>
  <link href="./css/bootstrap-datepicker.min.css" rel="stylesheet" > <!-- DatePicker -->
  <script src="./js/bootstrap-datepicker.min.js" type="text/javascript"></script>
  <script src="./js/bootstrap-datepicker.es.min.js" type="text/javascript"></script>
  <link href="./css/extraline.css" rel="stylesheet"> <!-- NoResponsive -->
  <link href="./css/colorpicker.css" rel="stylesheet"><!-- ColorPicker -->
  <script src="./js/colorpicker.js" type="text/javascript"></script>
  <link rel="stylesheet" href="./css/fullcalendar.min.css"><!-- FullCalendar -->
  <script src="./js/fullcalendar.min.js" type="text/javascript"></script>
  <script src="./js/es.js" type="text/javascript"></script>
  <link rel="stylesheet" href="./css/animate.css"><!-- FullCalendar -->
  <script src="./js/bootstrap-notify.js" type="text/javascript"></script><!-- Notifies -->

<script>

function refrescarEvento(){$('#calendar').fullCalendar("refetchEvents");}
function lanzarAjax(funcion,array){
  jQuery.ajax({
    type: "POST",
    url: 'functions.php',
    data: {fn: funcion, arg: array},
    success: function (data) {
      if(funcion=='consultarTodasAsignaturas'){
        document.getElementById('e-input-sub').innerHTML = data;
      }
      else if(funcion=='consultarTodosTipos'){
        document.getElementById('e-input-type').innerHTML = data;
      }else {
        var respuesta = JSON.parse(data);
        prueba(String(respuesta[0]),String(respuesta[1]));
        //$('#mostrarResult').html(respuesta[0]+'|'+respuesta[1]);
      }
    }
  });
}
function toggleStatus(element) {
  if(element=='div_ev'){
    var a = document.getElementById('div_asig');
    if(a.style.display=='') {//Modificamos boton ajeno
      $(a).toggle();
      var a = document.getElementById('n-addsub').innerHTML
      document.getElementById('n-addsub').innerHTML = a.replace('minus','plus');
    }
    var b = document.getElementById('div_ev');
    if(b.style.display=='none') {//Cositas nacis
      $(b).show();
      var a = document.getElementById('n-addevent').innerHTML
      document.getElementById('n-addevent').innerHTML = a.replace('plus','minus');
      lanzarAjax('consultarTodasAsignaturas','<?php echo $_SESSION["us-mail"];?>');
      lanzarAjax('consultarTodosTipos',null);

    }
    else {
      $(b).hide();
      var a = document.getElementById('n-addevent').innerHTML
      document.getElementById('n-addevent').innerHTML = a.replace('minus','plus');
    }
  }
  else {
    var a = document.getElementById('div_ev');
    if(a.style.display=='') {//Modificamos boton ajeno
      $(a).toggle();
      var a = document.getElementById('n-addevent').innerHTML
      document.getElementById('n-addevent').innerHTML = a.replace('minus','plus');
    }
    var b = document.getElementById('div_asig');
    if(b.style.display=='none') {//Cositas nacis
      $(b).show();
      var a = document.getElementById('n-addsub').innerHTML
      document.getElementById('n-addsub').innerHTML = a.replace('plus','minus');
    }
    else {
      $(b).hide();
      var a = document.getElementById('n-addsub').innerHTML
      document.getElementById('n-addsub').innerHTML = a.replace('minus','plus');
    }
  }
}
</script>

</head>
<body>
  <!--//NAVBAR-->
  <nav id="nav-top" class="navbar navbar-default" style="margin:0 auto;width:315px;text-align: center;">
    <button id="n-addevent" style="margin-top:10px;margin-right:10px" type="button" class="btn btn-default btn-sm" onclick="toggleStatus('div_ev')";>
      <span class="glyphicon glyphicon-plus"></span> Evento
    </button>
    <button id="n-addsub" style="margin-top:10px;margin-right:10px" type="button" class="btn btn-default btn-sm" onclick="toggleStatus('div_asig')";>
      <span class="glyphicon glyphicon-plus"></span> Asign.
    </button>
    <button style="margin-top:10px" type="button" class="btn btn-default btn-sm" onclick="<?php session_destroy() ?>;location.reload(true)">
      <span class="glyphicon glyphicon-minus"></span> Salir
    </button>
  </nav>
<!--//MENU1-->
  <div id="div_ev" style="display:none"><br><br>
    <form action="POST"  class="navbar navbar-default" style="margin:0 auto;min-width:600px;width:600px;text-align: center;padding-bottom:10px">
      <div class="col-xs-9" style="max-height:88px">
        <div class="form-inline" style="padding-top:10px;max-height:44px">
          <label class="control-label " for="email">Asignatura:
            <select id="e-input-sub" class="form-control" style="width:100px" selected="ASORC">
            </select></label>
          <label class="control-label " for="email">Tipo:
            <select id="e-input-type" class="form-control" style="width:80px">
            </select></label>
        </div>
        <div class="form-inline" style="padding-top:10px;max-height:44px">
          <label class="control-label " for="email">Fecha:
            <div class="input-group date dp-input">
              <input id="e-input-date" style="width:100px" type="text" class="form-control"><span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
            </div></label>
          <label class="control-label " for="email">Porcentaje:
            <input id="e-input-%" style="width:100px" type="text" class="form-control"></label>
        </div>
      </div>
      <div class="col-xs-3" style="max-height:88px;height:80px">
        <button id="e-button-add" style="margin-top:10px;margin-right:10px;height:100%" type="button" class="btn btn-default btn-block" onclick="lanzarAjax('crearEvento',['<?php echo $_SESSION["us-mail"];?>',document.getElementById('e-input-sub').value,document.getElementById('e-input-type').value,document.getElementById('e-input-date').value.split('-').reverse().join('-'),document.getElementById('e-input-%').value]);refrescarEvento();">
          <span style="font-size: 61px;" class="glyphicon glyphicon-plus"></span></button>
      </div>
    </form>
  </div>
<!--//MENU2-->
  <div id="div_asig" style="display:none"><br><br>
    <form action="POST" class="navbar navbar-default" style="margin:0 auto;min-width:600px;width:600px;text-align: center;padding-bottom:10px">
      <div class="col-xs-9" style="max-height:88px">
        <div class="form-inline" style="padding-top:10px;max-height:44px">
          <label class="control-label " for="email">Siglas:
            <input id="a-sigla" style="width:100px" type="text" class="form-control"></label>

          <label class="control-label " for="email">Color:
            <input  id="colorSelector" style="width:34px" class="form-control" type="text" readonly></label>
        </div>
        <div class="form-inline" style="padding-top:10px;max-height:44px">
          <label class="control-label " for="email">Descripcion:
            <input id="a-desc" type="text" class="form-control" style="width:auto"></label>
        </div>
      </div>
      <div class="col-xs-3" style="max-height:88px;height:80px">
        <button style="margin-top:10px;margin-right:10px;height:100%" type="button" class="btn btn-default btn-block" onclick="lanzarAjax('crearAsignatura',['<?php echo $_SESSION["us-mail"];?>',document.getElementById('a-sigla').value,document.getElementById('colorSelector').value,document.getElementById('a-desc').value]);refrescarEvento();">
          <span style="font-size: 61px;" class="glyphicon glyphicon-plus"></span>
        </button>
      </div>
    </form>
  </div>
<div><br><br>
  <div id="calendar" style="width:800px;height:800px;margin:0 auto">
</div>
  </div>

  <div id="mostrarResult"> </div>

  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">×</button>
          <h4 class="modal-title">Editar Evento</h4>
        </div>
        <div class="modal-body" style="height:230px">
          <div class="form-group">
            <div class="col-xs-6" style="padding:0;padding-right:5px">
              <label>Asignatura</label>
              <input readonly id="modal-sign" type="text" class="form-control" style="background-color:#fff">
            </div>
            <div class="col-xs-6" style="padding:0;padding-left:5px">
              <label>Tipo</label>
              <input readonly id="modal-type" type="text" class="form-control" style="background-color:#fff">
            </div>
          </div>
          <div class="form-group">

            <label class="control-label " for="email">Fecha:</label>
              <div class="input-group">
                <input readonly id="modal-date" style="width:100%;background-color:#fff" type="text" class="form-control">
                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
              </div>
          </div>
          <div class="form-group">
            <div class="col-xs-6" style="padding:0;padding-right:5px">
              <label>Porcentaje</label>
              <div class="input-group">
                <input id="modal-%" style="width:100%" type="text" class="form-control">
                <span class="input-group-addon"><i class="glyphicon"><b>%</b></i></span>
              </div>
            </div>
            <div class="col-xs-6" style="padding:0;padding-right:5px">
              <label>Nota</label>
              <input id="modal-note" type="text" class="form-control" >
            </div>
          </div>
        </div>
        <div class="modal-footer" style="text-align: left;">
        	<div class="form-inline">
    				<div class="form-group" >
      				<input type="button" class="btn btn-info" id="modal-update" value="Actualizar">
              <input type="button" class="btn btn-danger" id="modal-delete" value="Borrar">
     				</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
  <script>
    $('.dp-input').datepicker({format: "dd-mm-yyyy",language: "es",autoclose: true,todayHighlight: true});
    $('#colorSelector').ColorPicker({
        color: '#0000ff',onShow: function (colpkr) {$(colpkr).fadeIn(500);return false;	},
        onHide: function (colpkr) {$(colpkr).fadeOut(500);return false;	},
        onChange: function (hsb, hex, rgb) {$('#colorSelector').css('backgroundColor', '#' + hex);$('#colorSelector').val('#' + hex);}
      });
    $(document).ready(function() {
    	$('#calendar').fullCalendar({
    			header: {
    				left: 'prev,next today',
    				center: 'title',
    				right: 'listDay,listWeek,month'
    			},
          views: {
    				listDay: { buttonText: 'Listar dia' },
    				listWeek: { buttonText: 'Listar Semana' }
    			},
          events: {
            url: '/functions.php',
            type: 'POST',
            data: { fn: 'consultarTodosEventos', arg: null },
            error: function() { prueba('danger','there was an error while fetching events!'); },
          },
          eventRender: function(event, element) {
            return $("<div class='fc-h-event fc-event fc-start fc-end' style=border-color:" + event.color +";background-color:"+event.color+"><b><p style=font-size:15px;margin-bottom:0px>" + event.title + "</p></b>"+event.description+"</div>");
          },
          eventClick: function(calEvent, jsEvent) {
            $('#myModal').modal('show');
            document.getElementById('modal-sign').value = calEvent.title;
            document.getElementById('modal-type').value = calEvent.description;
            document.getElementById('modal-date').value = moment(calEvent.start).format('DD-MM-YYYY');
            document.getElementById('modal-%').value = calEvent.porcentaje;
            document.getElementById('modal-note').value = calEvent.nota;
            document.getElementById('modal-update').onclick = function(){lanzarAjax('actualizarEvento',[calEvent.id,document.getElementById('modal-%').value,document.getElementById('modal-note').value]);refrescarEvento();$('#myModal').modal('hide');};
            document.getElementById('modal-delete').onclick = function(){lanzarAjax('eliminarEvento',calEvent.id);refrescarEvento();$('#myModal').modal('hide');};
          },
          defaultView: 'month',
    		  navLinks: true, // can click day/week names to navigate views
    	});
    });
    function prueba(p1,p2) {
      $.notify({message:p2},
      { type: p1,
        newest_on_top: true,
        delay: 1000,
        animate: {enter: 'animated fadeInDown',exit: 'animated fadeOutUp'},
      });
    }
  </script>
</html>
=======
<?php session_start(); error_reporting(E_ALL ^ E_NOTICE);if($_SESSION['us-mail']=='') header('Location: sessions.php');?>
<html lang="es">
<head>
  <title>WorkEvent</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="./js/moment.min.js" type="text/javascript"></script><!-- Moment -->
  <script src="./js/jquery.min.js"></script><!-- jQuery -->
  <link href="./css/bootstrap.min.css" rel="stylesheet"><!-- Bootstrap -->
  <script src="./js/bootstrap.min.js"></script>
  <link href="./css/bootstrap-datepicker.min.css" rel="stylesheet" > <!-- DatePicker -->
  <script src="./js/bootstrap-datepicker.min.js" type="text/javascript"></script>
  <script src="./js/bootstrap-datepicker.es.min.js" type="text/javascript"></script>
  <link href="./css/extraline.css" rel="stylesheet"> <!-- NoResponsive -->
  <link href="./css/colorpicker.css" rel="stylesheet"><!-- ColorPicker -->
  <script src="./js/colorpicker.js" type="text/javascript"></script>
  <link rel="stylesheet" href="./css/fullcalendar.min.css"><!-- FullCalendar -->
  <script src="./js/fullcalendar.min.js" type="text/javascript"></script>
  <script src="./js/es.js" type="text/javascript"></script>
  <link rel="stylesheet" href="./css/animate.css"><!-- FullCalendar -->
  <script src="./js/bootstrap-notify.js" type="text/javascript"></script><!-- Notifies -->

<script>

function refrescarEvento(){$('#calendar').fullCalendar("refetchEvents");}
function lanzarAjax(funcion,array){
  jQuery.ajax({
    type: "POST",
    url: 'functions.php',
    data: {fn: funcion, arg: array},
    success: function (data) {
      if(funcion=='consultarTodasAsignaturas'){
        document.getElementById('e-input-sub').innerHTML = data;
      }
      else if(funcion=='consultarTodosTipos'){
        document.getElementById('e-input-type').innerHTML = data;
      }else {
        var respuesta = JSON.parse(data);
        prueba(String(respuesta[0]),String(respuesta[1]));
        //$('#mostrarResult').html(respuesta[0]+'|'+respuesta[1]);
      }
    }
  });
}
function toggleStatus(element) {
  if(element=='div_ev'){
    var a = document.getElementById('div_asig');
    if(a.style.display=='') {//Modificamos boton ajeno
      $(a).toggle();
      var a = document.getElementById('n-addsub').innerHTML
      document.getElementById('n-addsub').innerHTML = a.replace('minus','plus');
    }
    var b = document.getElementById('div_ev');
    if(b.style.display=='none') {//Cositas nacis
      $(b).show();
      var a = document.getElementById('n-addevent').innerHTML
      document.getElementById('n-addevent').innerHTML = a.replace('plus','minus');
      lanzarAjax('consultarTodasAsignaturas','<?php echo $_SESSION["us-mail"];?>');
      lanzarAjax('consultarTodosTipos',null);

    }
    else {
      $(b).hide();
      var a = document.getElementById('n-addevent').innerHTML
      document.getElementById('n-addevent').innerHTML = a.replace('minus','plus');
    }
  }
  else {
    var a = document.getElementById('div_ev');
    if(a.style.display=='') {//Modificamos boton ajeno
      $(a).toggle();
      var a = document.getElementById('n-addevent').innerHTML
      document.getElementById('n-addevent').innerHTML = a.replace('minus','plus');
    }
    var b = document.getElementById('div_asig');
    if(b.style.display=='none') {//Cositas nacis
      $(b).show();
      var a = document.getElementById('n-addsub').innerHTML
      document.getElementById('n-addsub').innerHTML = a.replace('plus','minus');
    }
    else {
      $(b).hide();
      var a = document.getElementById('n-addsub').innerHTML
      document.getElementById('n-addsub').innerHTML = a.replace('minus','plus');
    }
  }
}
</script>

</head>
<body>
  <!--//NAVBAR-->
  <nav id="nav-top" class="navbar navbar-default" style="margin:0 auto;width:315px;text-align: center;">
    <button id="n-addevent" style="margin-top:10px;margin-right:10px" type="button" class="btn btn-default btn-sm" onclick="toggleStatus('div_ev')";>
      <span class="glyphicon glyphicon-plus"></span> Evento
    </button>
    <button id="n-addsub" style="margin-top:10px;margin-right:10px" type="button" class="btn btn-default btn-sm" onclick="toggleStatus('div_asig')";>
      <span class="glyphicon glyphicon-plus"></span> Asign.
    </button>
    <button style="margin-top:10px" type="button" class="btn btn-default btn-sm" onclick="<?php session_destroy() ?>;location.reload(true)">
      <span class="glyphicon glyphicon-minus"></span> Salir
    </button>
  </nav>
<!--//MENU1-->
  <div id="div_ev" style="display:none"><br><br>
    <form action="POST"  class="navbar navbar-default" style="margin:0 auto;min-width:600px;width:600px;text-align: center;padding-bottom:10px">
      <div class="col-xs-9" style="max-height:88px">
        <div class="form-inline" style="padding-top:10px;max-height:44px">
          <label class="control-label " for="email">Asignatura:
            <select id="e-input-sub" class="form-control" style="width:100px" selected="ASORC">
            </select></label>
          <label class="control-label " for="email">Tipo:
            <select id="e-input-type" class="form-control" style="width:80px">
            </select></label>
        </div>
        <div class="form-inline" style="padding-top:10px;max-height:44px">
          <label class="control-label " for="email">Fecha:
            <div class="input-group date dp-input">
              <input id="e-input-date" style="width:100px" type="text" class="form-control"><span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
            </div></label>
          <label class="control-label " for="email">Porcentaje:
            <input id="e-input-%" style="width:100px" type="text" class="form-control"></label>
        </div>
      </div>
      <div class="col-xs-3" style="max-height:88px;height:80px">
        <button id="e-button-add" style="margin-top:10px;margin-right:10px;height:100%" type="button" class="btn btn-default btn-block" onclick="lanzarAjax('crearEvento',['<?php echo $_SESSION["us-mail"];?>',document.getElementById('e-input-sub').value,document.getElementById('e-input-type').value,document.getElementById('e-input-date').value.split('-').reverse().join('-'),document.getElementById('e-input-%').value]);refrescarEvento();">
          <span style="font-size: 61px;" class="glyphicon glyphicon-plus"></span></button>
      </div>
    </form>
  </div>
<!--//MENU2-->
  <div id="div_asig" style="display:none"><br><br>
    <form action="POST" class="navbar navbar-default" style="margin:0 auto;min-width:600px;width:600px;text-align: center;padding-bottom:10px">
      <div class="col-xs-9" style="max-height:88px">
        <div class="form-inline" style="padding-top:10px;max-height:44px">
          <label class="control-label " for="email">Siglas:
            <input id="a-sigla" style="width:100px" type="text" class="form-control"></label>

          <label class="control-label " for="email">Color:
            <input  id="colorSelector" style="width:34px" class="form-control" type="text" readonly></label>
        </div>
        <div class="form-inline" style="padding-top:10px;max-height:44px">
          <label class="control-label " for="email">Descripcion:
            <input id="a-desc" type="text" class="form-control" style="width:auto"></label>
        </div>
      </div>
      <div class="col-xs-3" style="max-height:88px;height:80px">
        <button style="margin-top:10px;margin-right:10px;height:100%" type="button" class="btn btn-default btn-block" onclick="lanzarAjax('crearAsignatura',['<?php echo $_SESSION["us-mail"];?>',document.getElementById('a-sigla').value,document.getElementById('colorSelector').value,document.getElementById('a-desc').value]);refrescarEvento();">
          <span style="font-size: 61px;" class="glyphicon glyphicon-plus"></span>
        </button>
      </div>
    </form>
  </div>
<div><br><br>
  <div id="calendar" style="width:800px;height:800px;margin:0 auto">
</div>
  </div>

  <div id="mostrarResult"> </div>

  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">×</button>
          <h4 class="modal-title">Editar Evento</h4>
        </div>
        <div class="modal-body" style="height:230px">
          <div class="form-group">
            <div class="col-xs-6" style="padding:0;padding-right:5px">
              <label>Asignatura</label>
              <div class="input-group">
                <input readonly id="modal-sign" type="text" class="form-control" style="background-color:#fff">
                <span class="input-group-addon"><label id="label_status" style="margin-bottom: 0px"></label></span>
              </div>
            </div>
            <div class="col-xs-6" style="padding:0;padding-left:5px">
              <label>Tipo</label>
              <input readonly id="modal-type" type="text" class="form-control" style="background-color:#fff">
            </div>
          </div>
          <div class="form-group">

            <label class="control-label " for="email">Fecha:</label>
              <div class="input-group">
                <input readonly id="modal-date" style="width:100%;background-color:#fff" type="text" class="form-control">
                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
              </div>
          </div>
          <div class="form-group">
            <div class="col-xs-6" style="padding:0;padding-right:5px">
              <label>Porcentaje</label>
              <div class="input-group">
                <input id="modal-%" style="width:100%" type="text" class="form-control">
                <span class="input-group-addon"><i class="glyphicon"><b>%</b></i></span>
              </div>
            </div>
            <div class="col-xs-6" style="padding:0;padding-right:5px">
              <label>Nota</label>
              <input id="modal-note" type="text" class="form-control" >
            </div>
          </div>
        </div>
        <div class="modal-footer" style="text-align: left;">
        	<div class="form-inline">
    				<div class="form-group">
      				<input type="button" class="btn btn-info" id="modal-update" value="Actualizar">
              <input type="button" class="btn btn-danger" id="modal-delete" value="Borrar">
              <input type="button" class="btn btn-warning" id="modal-grey">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
  <script>
    $('.dp-input').datepicker({format: "dd-mm-yyyy",language: "es",autoclose: true,todayHighlight: true});
    $('#colorSelector').ColorPicker({
        color: '#0000ff',onShow: function (colpkr) {$(colpkr).fadeIn(500);return false;	},
        onHide: function (colpkr) {$(colpkr).fadeOut(500);return false;	},
        onChange: function (hsb, hex, rgb) {$('#colorSelector').css('backgroundColor', '#' + hex);$('#colorSelector').val('#' + hex);}
      });
    $(document).ready(function() {
    	$('#calendar').fullCalendar({
    			header: {
    				left: 'prev,next today',
    				center: 'title',
    				right: 'listDay,listWeek,month'
    			},
          views: {
    				listDay: { buttonText: 'Listar dia' },
    				listWeek: { buttonText: 'Listar Semana' }
    			},
          events: {
            url: '/functions.php',
            type: 'POST',
            data: { fn: 'consultarTodosEventos', arg: null },
            error: function() { prueba('danger','there was an error while fetching events!'); },
          },
          eventRender: function(event, element) {
            return $("<div class='fc-h-event fc-event fc-start fc-end' style=border-color:" + ((event.status==1) ? event.color:"#505050") + ";background-color:" + ((event.status==1) ? event.color:"#505050") + "><b><p style=font-size:15px;margin-bottom:0px>" + event.title + "</p></b>"+event.description+"</div>");
          },
          eventClick: function(calEvent, jsEvent) {
            $('#myModal').modal('show');
            document.getElementById('modal-sign').value = calEvent.title;
            document.getElementById('modal-type').value = calEvent.description;
            document.getElementById('modal-date').value = moment(calEvent.start).format('DD-MM-YYYY');
            document.getElementById('modal-%').value = calEvent.porcentaje;
            document.getElementById('modal-note').value = calEvent.nota;
            document.getElementById('modal-update').onclick = function(){lanzarAjax('actualizarEvento',[calEvent.id,document.getElementById('modal-%').value,document.getElementById('modal-note').value]);refrescarEvento();$('#myModal').modal('hide');};
            document.getElementById('modal-delete').onclick = function(){lanzarAjax('eliminarEvento',calEvent.id);refrescarEvento();$('#myModal').modal('hide');};
            if(calEvent.status==1) {
              document.getElementById('label_status').innerHTML = "NO ENTREGADA";
              document.getElementById('modal-grey').value = "Entregada"
              document.getElementById('modal-grey').onclick = function(){lanzarAjax('entregadoEvento',[calEvent.id,0]);refrescarEvento();$('#myModal').modal('hide');};
            }else {
              document.getElementById('modal-grey').value = "No Entregada"
              document.getElementById('label_status').innerHTML = "ENTREGADA";
              document.getElementById('modal-grey').onclick = function(){lanzarAjax('entregadoEvento',[calEvent.id,1]);refrescarEvento();$('#myModal').modal('hide');};
            }
          },
          defaultView: 'month',
    		  navLinks: true, // can click day/week names to navigate views
    	});
    });
    function prueba(p1,p2) {
      $.notify({message:p2},
      { type: p1,
        newest_on_top: true,
        delay: 1000,
        animate: {enter: 'animated fadeInDown',exit: 'animated fadeOutUp'},
      });
    }
  </script>
</html>
>>>>>>> 256a4c780e6b47d03b1e7d8650333887364e6139

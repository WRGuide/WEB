<!DOCTYPE html>
<html lang="es">
<head>
  <title>WorkEvent</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="./js/moment.min.js" type="text/javascript"></script><!-- Moment -->
  <script src="./js/jquery.min.js"></script><!-- jQuery -->
  <link href="./css/bootstrap.min.css" rel="stylesheet"><!-- Bootstrap -->
  <script src="./js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css"> <!-- DatePicker -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/locales/bootstrap-datepicker.es.min.js" type="text/javascript"></script>
  <link href="./css/extraline.css" rel="stylesheet"> <!-- NoResponsive -->
  <link href="./css/colorpicker.css" rel="stylesheet"><!-- ColorPicker -->
  <script src="./js/colorpicker.js" type="text/javascript"></script>
    <link rel="stylesheet" href="./css/fullcalendar.min.css"><!-- FullCalendar -->
  <script src="./js/fullcalendar.min.js" type="text/javascript"></script>
  <script src="./js/es.js" type="text/javascript"></script>
  <?php session_start(['cookie_lifetime' => 86400,]); ?>
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
        console.log(data);
        $('#mostrarResult').html(data);
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
<body onclick="<?php if($_SESSION['us-mail']=='') header('Location: sessions.php');?>">
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
            <select id="e-input-sub" class="form-control" style="width:100px">
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
        <button style="margin-top:10px;margin-right:10px;height:100%" type="button" class="btn btn-default btn-block" onclick="lanzarAjax('crearAsignatura',['<?php echo $_SESSION["us-mail"];?>',document.getElementById('a-sigla').value,document.getElementById('colorSelector').value,document.getElementById('a-desc').value]);">
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
        error: function() { alert('there was an error while fetching events!'); },
      },
      defaultView: 'month',
			navLinks: true, // can click day/week names to navigate views
			editable: true,
		});
	});

</script>
</html>

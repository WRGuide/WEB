function loadModel(modo,evento){
  var a = `<div class='modal-dialog'><div class='modal-content'><div class='modal-header'><button type='button' class='close' data-dismiss='modal'>×</button><h4 class='modal-title'>` + modo + `Evento</h4></div><div class='modal-body' style='height:230px'><div class='form-group'><div class='col-xs-6' style='padding:0;padding-right:5px'><label>Asignatura</label><div class='input-group'><input readonly='' id='modal-sign' type='text' class='form-control'  style='background-color:#fff'><span class='input-group-addon'><label id='label_status' style='margin-bottom: 0px;color: forestgreen;'>NO ENTREGADA</label></span></div></div><div class='col-xs-6' style='padding:0;padding-left:5px'> <div class='col-xs-6' style='padding:0;padding-left:5px'> <label>Tipo</label><span class='align-right'><a>+</a></span> <input readonly='' id='modal-type' type='text' class='form-control' style='background-color:#fff'> </div> <div class='col-xs-6' style='padding:0;padding-left:5px'> 	<label>Tipo</label> <input readonly='' id='modal-type' type='text' class='form-control' style='background-color:#fff'></div></div></div><div class='form-group'><div class='col-xs-12' style='padding:0;padding-right:5px;margin-bottom:5px'><label class='control-label ' for='email'>Fecha:</label><div class='input-group'><input readonly='' id='modal-date' style='width:100%;background-color:#fff' type='text' class='form-control'><span class='input-group-addon'><i class='glyphicon glyphicon-calendar'></i></span></div></div></div><div class='form-group'><div class='col-xs-6' style='padding:0;padding-right:5px'><label>Porcentaje</label><div class='input-group'><input id='modal-%' style='width:100%' type='text' class='form-control'><span class='input-group-addon'><i class='glyphicon'><b>%</b></i></span></div></div><div class='col-xs-6' style='padding:0;padding-right:5px'><label>Nota</label><input id='modal-note' type='text' class='form-control'></div></div></div><div class='modal-footer' style='text-align: left;'>	<div class='form-inline'><div class='form-group'><input type='button' class='btn btn-info' id='modal-update' value='Actualizar'><input type='button' class='btn btn-danger' id='modal-delete' value='Borrar'><input type='button' class='btn btn-warning' id='modal-grey' value='Entregada'></div></div></div></div></div>`
  return a;
}

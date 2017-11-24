
function loadModel(modo){
  var a = `
  <div class='modal-dialog'>
    <div class='modal-content'>
      <div class='modal-header'>
        <button type='button' class='close' data-dismiss='modal'>×</button>
        <h4 class='modal-title'>` + modo + ` Evento</h4>
      </div>
      <div class='modal-body' style='height:160px'>
        <div class='form-group'>
          <div class='col-xs-5' style='padding:0;padding-right:10px'>
            <label>Asignatura</label>
            <div class='input-group'>
              <select id='modal-sign' type='text' class='form-control' style='background-color:#fff'></select>
              <span class='input-group-addon'>
                <label id='label_status' style='margin-bottom: 0px;'></label>
              </span>
            </div>
          </div>
          <div class='col-xs-5' style='padding:0;padding-right:10px'>
              <label>Tipo</label>
              <select id='modal-type' type='text' class='form-control' style='background-color:#fff'> </select>
          </div>
          <div class='col-xs-2' style='padding:0'>
            <label>Numero</label>
            <input id='modal-tnumber' type='text' class='form-control' style='background-color:#fff'>
          </div>
        </div>
        <div class='form-group' style='margin-top:70px'>
          <div class='col-xs-4' style='padding:0;padding-right:10px'>
            <label class='control-label'>Fecha:</label>
            <div class='input-group date dp-input'>
              <input readonly='' id='modal-date' style='width:100%;background-color:#fff' type='text' class='form-control'>
              <span class='input-group-addon'><i class='glyphicon glyphicon-calendar'></i></span>
            </div>
          </div>

          <div class='col-xs-4' style='padding:0;padding-right:10px'>
            <label>Porcentaje</label>
            <div class='input-group'>
              <input id='modal-%' style='width:100%' type='text' class='form-control'>
              <span class='input-group-addon'><i class='glyphicon'><b>%</b></i></span>
            </div>

        </div>

          <div class='col-xs-4' style='padding:0'>
            <label>Nota</label>
            <input id='modal-note' type='text' class='form-control'>
          </div>

        </div>
      </div>
      <div class='modal-footer' style='text-align: left;'>
        <div class='form-inline'>
          <div class='form-group'>
            <input type='button' class='btn btn-info' id='modal-update' value='Actualizar'>
            <input type='button' class='btn btn-danger' id='modal-delete' value='Borrar'>
            <input type='button' class='btn btn-warning' id='modal-grey' value='Entregada'>
          </div>
        </div>
      </div>
    </div>
  </div>
      `
  return a;
}

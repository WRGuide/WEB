<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <script src="./js/jquery.min.js"></script><!-- jQuery -->
  <link href="./css/bootstrap.min.css"  rel="stylesheet"><!-- Bootstrap -->
  <script src="./js/bootstrap.min.js"></script>

  <link href="./css/reglog.css" rel="stylesheet">
  <script src="./js/reglog.js" type="text/javascript"></script>

  <script>
  function lanzarAjax(funcion,array){
    jQuery.ajax({
        type: "POST",
        url: 'functions.php',
        data: {fn: funcion, arg: array},
        success: function (data) {
          if(funcion=='iniciarSesion' && data=='true') {
              window.location.replace("./index.php");
          } else {
            $('#mostrarResult').html(data);
          }
        }
    });
  }
  </script>

</head>
<body onload="<?php session_start((['cookie_lifetime' => 86400,])); ?>">

  <div class="container">
      	<div class="row">
  			<div class="col-md-6 col-md-offset-3">
  				<div class="panel panel-login">
  					<div class="panel-heading">
  						<div class="row">
  							<div class="col-xs-6">
  								<a href="#" class="active" id="login-form-link">Login</a>
  							</div>
  							<div class="col-xs-6">
  								<a href="#" id="register-form-link">Register</a>
  							</div>
  						</div>
  						<hr>
  					</div>
            <!--LOGIN-->
  					<div class="panel-body">
  						<div class="row">
  							<div class="col-lg-12">
  								<form id="login-form" style="display: block;">
  									<div class="form-group">
  										<input type="text" name="username" id="l-email" tabindex="1" class="form-control" placeholder="Email" value="">
  									</div>
  									<div class="form-group">
  										<input type="password" name="password" id="l-pass" tabindex="2" class="form-control" placeholder="Password">
  									</div>
  									<div class="form-group">
  										<div class="row">
  											<div class="col-sm-6 col-sm-offset-3">
  												<input type="button" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In" onclick="lanzarAjax('iniciarSesion',[document.getElementById('l-email').value,document.getElementById('l-pass').value])">
  											</div>
  										</div>
  									</div>
  								</form>
                  <!--REGISTRO-->
  								<form id="register-form" style="display: none;">
  									<div class="form-group">
  										<input type="text" name="email" id="r-email" tabindex="1" class="form-control" placeholder="Email Address" value="">
  									</div>
  									<div class="form-group">
  										<input type="password" name="password" id="r-pass" tabindex="2" class="form-control" placeholder="Password">
  									</div>
  									<div class="form-group">
  										<div class="row">
  											<div class="col-sm-6 col-sm-offset-3">
  												<input type="button" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Register Now" onclick="lanzarAjax('crearUsuario',[document.getElementById('r-email').value,document.getElementById('r-pass').value])">
  											</div>
  										</div>
  									</div>
  								</form>
  							</div>
  						</div>
  					</div>
  				</div>
  			</div>
  		</div>
  	</div>

    <div id="mostrarResult"></div>


</body></html>

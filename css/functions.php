<?php
  session_start();
  error_reporting(E_ALL ^ E_NOTICE);
  $servername = "localhost";
  $username = "id2958630_userroot";
  $password = "pscalendarioroot";
  $bdname = "id2958630_web";

  // Create connection
  $conn = new mysqli($servername, $username, $password,  $bdname);

  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  function crearUsuario($array){
    global $conn;

    $email = $array[0];
    $sql = "SELECT email FROM usuarios Where email='" . $email . "'";
    $result = $conn->query($sql);

    if ($result->num_rows == 0) {
      $sql = "INSERT INTO usuarios (email, contra) VALUES ('".$email."', '".$array[1]."')";

      if ($conn->query($sql) === TRUE) {
          echo json_encode(array("success","Usuario registrado correctamente."));
      } else {
          echo json_encode(array("danger","Error: " . $sql . "<br>" . $conn->error));
      }
    } else {
        echo json_encode(array("danger","Usuario ya registrado"));
    }
  }

  function iniciarSesion($array){

    global $conn;
    $email = $array[0];
    $pass = $array[1];
    $sql = "SELECT email FROM usuarios Where email='" . $email . "' and contra='".$pass."';";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {

      $_SESSION["us-mail"] = $email;
      echo "true";
    }
    else {
      echo json_encode(array("danger","No se ha encontado un usuario con esos datos."));
    }
  }

  function crearAsignatura($array){

    global $conn;
    $email = $array[0]; $siglas = $array[1]; $color = $array[2]; $descripcion = $array[3];

    $sql = "SELECT siglas FROM asignaturas Where email='" . $email . "' and siglas ='" . $siglas . "';";
    $result = $conn->query($sql);

    if ($result->num_rows == 0) {
      $sql = "INSERT INTO asignaturas (email, siglas, descripcion, color) VALUES ('".$email."', '".$siglas."', '".$descripcion."', '". $color. "');";

      if ($conn->query($sql) === TRUE) {
        echo json_encode(array("success","Asignatura añadida correctamente."));
      } else {
          echo json_encode(array("danger","Error: " . $sql . "<br>" . $conn->error));
      }
    } else {
        echo json_encode(array("danger","Asignatura ya registrada"));
    }

  }

  function consultarTodasAsignaturas($email){

    global $conn;

    $sql = "SELECT siglas FROM asignaturas Where email='" . $email . "';";

    $rdata = ""; $result = $conn->query($sql);
    if ($result->num_rows != 0) {
        while($row = mysqli_fetch_assoc($result)) {
        $rdata = $rdata."<option>".$row['siglas']."</option>";
      }
    }
    echo $rdata;

  }

  function crearEvento($array){
    global $conn;
    $email = $array[0]; $siglas = $array[1]; $tipo = $array[2]; $fecha = $array[3];$porcentaje = $array[4];

    $sql = "SELECT email FROM eventos Where email='" . $email . "' and siglas ='" . $siglas. "' and nivel ='" . $tipo . "';";
    $result = $conn->query($sql);
    if ($result->num_rows == 0) {
      $sql = "INSERT INTO eventos (email, siglas, nivel, fecha, porcentaje,nota) VALUES ('".$email."', '".$siglas."', '".$tipo."', '". $fecha."', '". $porcentaje. "',0);";

      if ($conn->query($sql) === TRUE) {
          echo json_encode(array("success","Evento añadido correctamente."));
      } else {
          echo json_encode(array("danger","Error: " . $sql . "<br>" . $conn->error));
      }
    } else {
        echo json_encode(array("danger","Evento ya añadido"));
    }
  }

  function consultarTodosEventos(){
    global $conn;

    $myArray = array();//concat_ws('\n', e.siglas, n.descripcion) as 'title'
    if ($result = $conn->query("SELECT id, fecha as 'start', e.nota as 'nota',e.porcentaje as 'porcentaje',e.siglas as 'title', n.descripcion as 'description','true' as 'allDay',a.color FROM eventos e, asignaturas a, niveles n where e.siglas = a.siglas and e.nivel = n.nivel")) {

      while($row = mysqli_fetch_assoc($result)) {
              //$aux = $'{'."'title':".$row['siglas'].'-'.$row['nivel']."','start':'".$row['fecha']."','end':'".$row['fecha']."}";
              $myArray[] = $row;
      }
      echo json_encode($myArray);
    }

  }

  function consultarTodosTipos(){
    global $conn;

    $sql = "SELECT nivel FROM niveles;";

    $rdata = ""; $result = $conn->query($sql);
    if ($result->num_rows != 0) {
        while($row = mysqli_fetch_assoc($result)) {
        $rdata = $rdata."<option>".$row['nivel']."</option>";
      }

    }

    echo $rdata;
  }

  function actualizarEvento($array){
      global $conn;

      $sql = "UPDATE eventos SET porcentaje = '" . $array[1] . "', nota = '" . $array[2] . "' where id = '" . $array[0] . "';";

      if ($conn->query($sql) === TRUE) {
        echo json_encode(array("success","Asignatura actualizada correctamente."));
      } else {
        echo json_encode(array("danger","Error updating record: " . $conn->error));
      }
  }

  function eliminarEvento($array){
    global $conn;

    $sql = "DELETE FROM eventos WHERE id = '" . $array . "';";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("success","Record deleted successfully"));
    } else {
        echo json_encode(array("danger","Error deleting record: " . $conn->error));
    }
  }

  $funcion = $_POST['fn'];
  $array = $_POST['arg'];
  switch ($funcion) {
    case 'crearUsuario':
      crearUsuario($array);break;
    case 'iniciarSesion':
      iniciarSesion($array);break;
    case 'crearAsignatura':
      crearAsignatura($array);break;
    case 'consultarTodasAsignaturas':
      consultarTodasAsignaturas($array);break;
    case 'crearEvento':
      crearEvento($array);break;
    case 'consultarTodosEventos':
      consultarTodosEventos();break;
    case 'consultarTodosTipos':
      consultarTodosTipos();break;
    case 'actualizarEvento':
      actualizarEvento($array);break;
    case 'eliminarEvento':
      eliminarEvento($array);break;
    default:break;
  }

?>

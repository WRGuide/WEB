<?php
  error_reporting(E_ALL ^ E_NOTICE);
  session_start((['cookie_lifetime' => 86400,]));
  $servername = "localhost";
  $username = "root";
  $password = "";
  $bdname = "web";

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
      $sql = "INSERT INTO Usuarios (email, contra) VALUES ('".$email."', '".$array[1]."')";

      if ($conn->query($sql) === TRUE) {
          echo "Usuario registrado correctamente.";
      } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
      }
    } else {
        echo "Usuario ya registrado";
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
      echo "No se ha encontado un usuario con esos datos.";
    }
  }

  function crearAsignatura($array){

    global $conn;
    $email = $array[0]; $siglas = $array[1]; $color = $array[2]; $descripcion = $array[3];

    $sql = "SELECT asignatura FROM Asignaturas Where email='" . $email . "' and siglas ='" . $siglas . "';";
    $result = $conn->query($sql);

    if ($result->num_rows == 0) {
      $sql = "INSERT INTO Asignaturas (email, siglas, descripcion, color) VALUES ('".$email."', '".$siglas."', '".$descripcion."', '". $color. "');";

      if ($conn->query($sql) === TRUE) {
          echo "Asignatura añadida correctamente.";
      } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
      }
    } else {
        echo "Asignatura ya registrada";
    }

  }

  function consultarTodasAsignaturas($email){

    global $conn;

    $sql = "SELECT siglas FROM Asignaturas Where email='" . $email . "';";

    $rdata = ""; $result = $conn->query($sql);
    if ($result->num_rows == 0) {
      $rdata = "---";
    }else {
      while($row = mysqli_fetch_assoc($result)) {
        $rdata = $rdata."<option>".$row['siglas']."</option>";
      }

    }
    echo $rdata;

  }

  function crearEvento($array){
    global $conn;
    $email = $array[0]; $siglas = $array[1]; $tipo = $array[2]; $fecha = $array[3];$porcentaje = $array[4];

    $sql = "SELECT evento FROM eventos Where email='" . $email . "' and siglas ='" . $siglas. "' and tipo ='" . $tipo . ";";
    $result = $conn->query($sql);
    if ($result->num_rows == 0) {
      $sql = "INSERT INTO Eventos (email, siglas, nivel, fecha, porcentaje) VALUES ('".$email."', '".$siglas."', '".$tipo."', '". $fecha."', '". $porcentaje. "');";

      if ($conn->query($sql) === TRUE) {
          echo "Evento añadida correctamente.";
      } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
      }
    } else {
        echo "Evento ya añadido";
    }
  }

  function consultarTodosEventos(){
    global $conn;

    $myArray = array();
    if ($result = $conn->query("SELECT id,fecha as 'start', e.siglas as 'title', n.descripcion as 'description','true' as 'allDay',a.color FROM eventos e, asignaturas a, niveles n where e.siglas = a.siglas and e.nivel = n.nivel")) {

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
    if ($result->num_rows == 0) {
      $rdata = "<option>---</option>";
    }else {
      while($row = mysqli_fetch_assoc($result)) {
        $rdata = $rdata."<option>".$row['nivel']."</option>";
      }

    }

    echo $rdata;
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
    default:break;
  }

?>

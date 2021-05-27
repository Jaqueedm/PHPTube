<?php
//se prepara variable para guardar posibles mensajes de respuesta
$msg="";

//se crean las variables para guardar datos del usuario a crear.
//estas variables también servirán para repoblar los formularios.
$email="";
$password="";
$repite_password="";
$nombre="";


if( isset($_POST['email']) && isset($_POST['password']) && isset($_POST['repite_password']) && isset($_POST['nombre'])) {

  if ($_POST['email']==""){
    $msg.= "Debe ingresar un email <br>";
  }

  if ($_POST['password'] ==""){
    $msg.="Debe ingresar una clave <br>";
  }

  if ($_POST['repite_password'] ==""){
    $msg.="Debe repetir la clave <br>";
  }

  if ($_POST['nombre']==""){
    $msg.= "Ingresa tu nombre <br>";
  }

  $email = strip_tags($_POST['email']);
  $password = strip_tags($_POST['password']);
  $repite_password = strip_tags($_POST['repite_password']);
  $nombre = strip_tags($_POST['nombre']);

  if ($password != $repite_password){
    $msg.="Las claves no coinciden <br>";
  }else if (strlen($password)<6){
    $msg.="La clave debe tener al menos 6 caracteres <br>";
  }else{
    //noa conectamos a db
    $mysqli = mysqli_connect("localhost","root","","phptube");

    if ($mysqli==false){
      echo "Hubo un problema al conectarse";
      die();
    }

    $ip = $_SERVER['REMOTE_ADDR'];

    //aquí como todo estuvo OK, resta controlar que no exista previamente el mail ingresado.
    $resultado = $mysqli->query("SELECT * FROM `usuarios` WHERE `usuarios_email` = '$email' ");
    $usuarios = $resultado->fetch_all(MYSQLI_ASSOC);

    //cuento cuantos elementos tiene $tabla,
    $cantidad = count($usuarios);

    //solo si no hay un usuario con mismo mail, procedemos a insertar fila con nuevo usuario
    if ($cantidad == 0){
      $password = sha1($password); //encripta la clave con sha1
      $mysqli->query("INSERT INTO `usuarios` (`usuarios_email`, `usuarios_password`, `usuarios_ip`,`usuario_nombre`) VALUES ('$email', '$password', '$ip', '$nombre')");
      $msg.="Usuario creado correctamente";
    }else{
      $msg.="El mail ingresado ya existe <br>";
    }

  }


}

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Registro</title>
    <link rel="stylesheet" href="css/master2.css">
  </head>
  <body>

    <div class="login-box">
    <form action=" registrarse.php" method="POST"> <!--regristo-->
      <a href="#" ><img src="img/2.png" class="avatar" alt="Avatar Image"></a>
      <h1>Regístrate</h1>
      <form>
        
        <label>Correo</label>
        <input type="email" name="email" placeholder="Escribe tu correo" value="<?php echo $email; ?>" >
        <label>Contraseña</label>
        <input type="password" name="password" placeholder="Escribe tu contraseña" required="requerido">
        
        <label>Confirmacion de contraseña</label>
        <input type="password" name="repite_password" placeholder="confirmar tu contraseña" required="requerido">

        <label>Nombre</label>
        <input type="text" name="nombre" placeholder="Escribe tu nombre" value="<?php echo $nombre; ?>">
      
        
        <input type="submit" value="Regístrate">
        <a href="inicio.sesion.php" class="text-center">Ya tengo una cuenta...</a>
      </form>
       <div style="color:red">
        <?php echo $msg; ?>
      </div>
    </div>
    
        <script src="js/jquery.js"></script>
  </body>
</html>



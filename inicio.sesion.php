<?php

session_start(); //variables de sesion

$_SESSION['autorizado'] = false; 

$msg="";
$email="";

if(isset($_POST['email']) && isset($_POST['password'])) {

  if ($_POST['email']==""){
    $msg.="Ingresa tu correo<br>";
  }else if ($_POST['password']=="") {
    $msg.="Ingresa tu contraseña <br>";
  }else {
    $email = strip_tags($_POST['email']);
    $password= sha1(strip_tags($_POST['password']));

    $mysqli = mysqli_connect("localhost","root","","phptube");

    if ($mysqli==false){
      echo "Hubo un problema al conectarse";
      die();
    }

    $resultado = $mysqli->query("SELECT * FROM `usuarios` WHERE `usuarios_email` = '$email' AND  `usuarios_password` = '$password' ");
    $usuarios = $resultado->fetch_all(MYSQLI_ASSOC);


    //cargo datos del usuario en variables de sesión
    $_SESSION['usuarios_id'] = $usuarios[0]['usuarios_id'];
    $_SESSION['usuarios_email'] = $usuarios[0]['usuarios_email'];
    $_SESSION['usuarios_ultimo_login'] = $usuarios[0]['usuarios_ultimo_login'];
    $_SESSION['usuario_nombre'] = $usuarios[0]['usuario_nombre'];

    //cuento cuantos elementos tiene $tabla,
    $cantidad = count($usuarios);
 
 //si todo esta bien te deja ingresar
    if ($cantidad == 1){
      $hoy = gmdate ( 'Y-m-d H:i:s' ); 
      $resultado = $mysqli->query("UPDATE `usuarios` SET `usuarios_ultimo_login`,'usuario_nombre' = '$hoy' WHERE `usuarios_email` =  '$email' ");
      $msg .= "Bienvenido";
      $_SESSION['autorizado'] = true; //redireccionamos y epera 1 segundo
      echo '<meta http-equiv="refresh" content="2; url=principal.php">';
    }else{ //si contraseña o correo esta incorrecto te manda error.
      $msg .= "Correo o contraseña incorrecta, intenta de nuevo.!";
      $_SESSION['autorizado'] = false;
    }


   }
}

    ?>

 <!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>inicio de sesión</title>
    <link rel="stylesheet" href="css/master.css">
  </head>
  <body>

    <div class="login-box">
      <a href="inicio.sesion.php" ><img src="img/2.png" class="avatar" alt="Avatar Image"></a>

      <form action="#" method="POST">
      <h1>Inicia sesión</h1>
        <!-- Correo -->
        <label>Correo</label>
        <input type="email" name="email" placeholder="Escribe el correo" value="<?php echo $email; ?>">
        <!-- Contraseña -->
        <label>Contraseña</label>
        <input type="password" name="password" placeholder="Escribe tu contraseña">

            
        <input type="submit" value="Iniciar sesión">

        <a href="#">Olvidé mi contraseña</a><br>
        <a href="registrarse.php">¿No tienes una cuenta? Registrate</a>
      </form>
       <div style="color:red">
        <?php echo $msg; ?>
      </div>
    </div>
  </body>
</html>
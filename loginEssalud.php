<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sistema Pacientes</title>
  <link rel="stylesheet" href="./login.css">
</head>

<body>

  <article class="container">
    <div class="title">
      <img src="./images/essalud-azul-2.png" alt="Essalud">
      <h1>¡Bienvenidos a la <b>Plataforma Tecnológica De Orientación</b> !</h1>
    </div>
    <div class="login-box">
      <p>Login</p>
      <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off">
        <div class="user-box">
          <input name="user" type="text" required>
          <label>Usuario</label>
        </div>
        <div class="user-box">
          <input name="password" type="password" id="password">
          <label>Contraseña</label>
          <div class="view">
            <p><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye-closed" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M21 9c-2.4 2.667 -5.4 4 -9 4c-3.6 0 -6.6 -1.333 -9 -4" /><path d="M3 15l2.5 -3.8" /><path d="M21 14.976l-2.492 -3.776" /><path d="M9 17l.5 -4" /><path d="M15 17l-.5 -4" /></svg></p>
          </div>
        </div>
        <button name="enviar" class="login">Ingresar</button>
        <a href="./recuperateAccount/recuperateAccount.php">Olvidaste tu contraseña?</a>
      </form>
    </div>
    <?php

    if (isset($_POST["enviar"])) {
      include './php/conexion.php';


      if (empty(trim($_POST['user'])) || empty(trim($_POST['password']))) {
        $sql2 = "SELECT timesSession FROM usuarios WHERE username='admin'";

        $result2 = mysqli_query($conn, $sql2) or die('Error comando sql');

        while ($row2 = mysqli_fetch_assoc($result2)) {
          // if ($row2['timesSession'] == 0) {
          $timesSession = $row2['timesSession'];
          // }
        }

        if ($_POST['user'] == 'admin') {

          $sql3 = "SELECT usuario_id, username FROM usuarios WHERE username = 'admin'";
          $result3 = mysqli_query($conn, $sql3) or die('Error comando sql');

          // if ($timesSession == '0') {
          //   while ($row3 = mysqli_fetch_assoc($result3)) {
          //     session_start();
          //     $_SESSION["usuario_id"] = $row3['usuario_id'];
          //     // echo "falla";
          //     header("Location: {$hostname}/vistas/admin/personal/index.php");
          //   }
          // } else if ($timesSession == '1') {
          //   while ($row3 = mysqli_fetch_assoc($result3)) {
          //     session_start();
          //     $_SESSION["usuario_id"] = $row3['usuario_id'];
          //     $_SESSION["timesSession"] = 1;
          //     header("Location: {$hostname}/vistas/admin/access/access.php");
          //   }
          // } else {
          //   echo '<div class="error"><p class="error__title">Ingrese nuevamente los datos</p></div>';
          //   die();
          // }
          if ($timesSession == '0') {
            while ($row3 = mysqli_fetch_assoc($result3)) {
              session_start();
              $_SESSION["usuario_id"] = $row3['usuario_id'];
              $_SESSION["timesSession"] = 0;
              header("Location: {$hostname}/vistas/admin/access/access.php");
            }
          // } else if ($timesSession == '1') {
          //   while ($row3 = mysqli_fetch_assoc($result3)) {
          //     session_start();
          //         $_SESSION["usuario_id"] = $row3['usuario_id'];
          //     //     // echo "falla";
          //         header("Location: {$hostname}/vistas/admin/personal/index.php");
          //   }
          } else {
            echo '<div class="error"><p class="error__title">Ingrese nuevamente los datos</p></div>';
            die();
          }
        } else {
          echo '<div class="error"><p class="error__title">Ingrese nuevamente los datos</p></div>';
          die();
        }
      } else {
        $user = trim($_POST["user"]);
        $password = trim($_POST["password"]);
        function encrypt_decrypt($action, $string, $secret_key)
        {
          $output = false;
          $encrypt_method = "AES-256-CBC";
          //
          $secret_iv = 'This is my secret iv';
          // hash
          $key = hash('sha256', $secret_key);

          // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
          $iv = substr(hash('sha256', $secret_iv), 0, 16);
          if ($action == 'encrypt') {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
          } else if ($action == 'decrypt') {
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
          }
          return $output;
        }

        $key = 'essalud';


        $encrypted_txt = encrypt_decrypt('encrypt', $password, $key);


        $sql = "SELECT usuarios.usuario_id, usuarios.username, usuarios.password, usuarios.timesSession ,roles.rol_nombre FROM roles_x_usuario
        INNER JOIN usuarios ON roles_x_usuario.usuario = usuarios.usuario_id 
        INNER JOIN roles  ON roles_x_usuario.rol = roles.rol_id
        WHERE usuarios.username = '{$user}' AND usuarios.password = '{$encrypted_txt}'";

        $result = mysqli_query($conn, $sql) or die('Error comando sql');

        if (mysqli_num_rows($result) > 0) {

          while ($row = mysqli_fetch_assoc($result)) {
            session_start();
            // $sessId   = ini_get('session.id');
            // $_SESSION[$row['username']] = $row['username'];
            // $_SESSION[$row['usuario_id']] = $row['usuario_id'];
            // $_SESSION["usuario_rol"] = $row['rol_nombre'];
            // $_SESSION['usuario_id'] = $row['usuario_id'];
    
            // $session_id = uniqid();
            // $_SESSION["session_id"] = $session_id;
            // $session_id = uniqid();
            $_SESSION["usuario_id"] = $row['usuario_id'];
            // $_SESSION["session_id"] = $session_id;
    
            if ($row['rol_nombre'] === 'admin' && $row['rol_nombre'] !== 'paciente'&& $row['timesSession'] == '1') {
              header("Location: {$hostname}/vistas/admin/personal/index.php");
            } else if ($row['rol_nombre'] === 'personal' && $row['rol_nombre'] !== 'paciente') {
              header("Location: {$hostname}/vistas/personal/camillas/index.php");
            } else {
              // echo 'falla';
              header("Location: loginEssalud.php");
            }
          }

        } else {
          echo ' <div class="error"><p class="error__title">El usuario y la contraseña no coinciden</p></div>';
        }
      }
    }
    ?>
  </article>
  <script src="./index.js"></script>
</body>

</html>
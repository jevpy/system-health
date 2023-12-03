<?php
include "./php/conexion.php";

session_start();

$sql = "SELECT timesSession FROM usuarios WHERE username = 'admin'";
$result = mysqli_query($conn, $sql) or die('Error comando sql');

while ($row = mysqli_fetch_array($result)) {
  $timesSession = $row['timesSession'];
  if ($timesSession == '0') {
    if (!isset($_SESSION["usuario_id"]) || !isset($_SESSION['timesSession'])) {
      header("Location: {$hostname}/loginEssalud.php");
    }

  } else {
    if (!isset($_SESSION["usuario_id"])) {
      header("Location: {$hostname}/loginEssalud.php");
    }
  }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sistema Pacientes</title>
  <link rel="stylesheet" href="./access.css">
</head>

<body>

  <div id="main-content">
    <form class="update-form" action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
      <div class="inputs">
        <h1>Ingrese su contraseña</h1>
        <div class="form-group">
          <input name="password" type="password" id="password" placeholder="Ingrese su contraseña">
          <div class="view">
            <p><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye-closed" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M21 9c-2.4 2.667 -5.4 4 -9 4c-3.6 0 -6.6 -1.333 -9 -4" /><path d="M3 15l2.5 -3.8" /><path d="M21 14.976l-2.492 -3.776" /><path d="M9 17l.5 -4" /><path d="M15 17l-.5 -4" /></svg></p>
          </div>
        </div>
        <div class="form-group">
          <input type="password" name="passwordRepeat" id="passwordRepeat" placeholder="Ingrese nuevamente su contraseña"/>
          <div class="view2">
            <p><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye-closed" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M21 9c-2.4 2.667 -5.4 4 -9 4c-3.6 0 -6.6 -1.333 -9 -4" /><path d="M3 15l2.5 -3.8" /><path d="M21 14.976l-2.492 -3.776" /><path d="M9 17l.5 -4" /><path d="M15 17l-.5 -4" /></svg></p>
          </div>
        </div>

        <div class="buttons">
          <button class="back" name="back">Regresar</button>
          <input class="submit" type="submit" name="enviar" value="Enviar" />
        </div>
    </form>
  </div>
  <script src="./js/index.js"></script>
</body>

</html>

<?php

if (isset($_POST['back'])) {
  header("location: ../../../loginEssalud.php");
}



if (isset($_POST['enviar'])) {

  $password = trim($_POST["password"]);
  $passwordRepeat = trim($_POST["passwordRepeat"]);

  // $sql = "SELECT timesSession FROM usuarios";

  // $result = mysqli_query($conn, $sql) or die('Error comando sql');

  if (empty($password) || !$password || empty($passwordRepeat) || !$passwordRepeat) {
    header("location: warning.php");
  } else {



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
    if ($password === $passwordRepeat) {
      $encrypted_txt = encrypt_decrypt('encrypt', $passwordRepeat, $key);
      $sql2 = "UPDATE usuarios SET password = '{$encrypted_txt}' WHERE username = 'admin'";
      $result2 = mysqli_query($conn, $sql2) or die("Query Unsuccessful.");

      $_SESSION['access'] = true;
      header("location: ../personal/index.php");
    } else {
      header("location: warning.php");
    }
  }


}







?>
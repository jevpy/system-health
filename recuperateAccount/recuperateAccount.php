<?php
include_once("../php/conexion.php");
include_once("./phpmailer.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sistemas Pacientes</title>
  <link rel="stylesheet" href="./css/recuperateAccount.css">
</head>

<body>
  <div id="main-content">
    <form class="update-form" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
      <div class="inputs">
        <h1>Ingrese su correo</h1>
        <div class="form-group">
          <label>Correo</label>
          <input type="text" name="correo" required />
        </div>
      </div>
      <input class="submit" type="submit" name="enviar" value="Enviar" />
    </form>
  </div>

</body>

</html>

<?php

if (isset($_POST['enviar'])) {

  $correo = $_POST['correo'];

  if (empty($correo) || !$correo) {
    header("location: ./correoNotFound.php");
  }

  $sql = "SELECT * FROM usuarios ";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
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

    while ($row = mysqli_fetch_assoc($result)) {
      $email = $row['correo'];
      $password = $row['password'];

      if (trim($correo) == $row['correo']) {
        $key = 'essalud';
        $decrypted_txt = encrypt_decrypt('decrypt', $password, $key);
        phpmailer($email, $decrypted_txt);
        header("Location: ./succesfully.php");
      } else {
        header("location: ./correoNotFound.php");
      }
    }
  }
}












?>
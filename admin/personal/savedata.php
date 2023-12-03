<?php
include("./phpmailer.php");

$name = trim($_POST['name']);
$surname = trim($_POST['surname']);
$username = trim($_POST['username']);
$correo = trim($_POST['correo']);
$rol = 2;



$conn = mysqli_connect("localhost", "root", "", "sistemapacientes") or die("Connection Failed");

if (empty($name) || empty($surname) || empty($username) || empty($correo) || empty($rol)) {
  header("Location: warning.php");
  die();
}

if (strlen($username) !== 8 || !preg_match('/^\d+$/', $username)) {
  header("Location: errorPassword.php");
  die();
}


if (isset($_POST['agregar'])) {

  $sql4 = "SELECT * FROM usuarios";
  $result4 = mysqli_query($conn, $sql4);

  while ($row4 = mysqli_fetch_assoc($result4)) {
    if (($name === $row4['nombre'] && $surname === $row4['apellido']) || $correo === $row4['correo'] || $username === $row4['username']) {
      header("Location: warning.php");
      die();
    }
  }

  // Genera una contraseña aleatoria
  function generarContrasenaAleatoria($longitud = 12)
  {
    $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $contrasena = '';
    for ($i = 0; $i < $longitud; $i++) {
      $contrasena .= $caracteres[rand(0, strlen($caracteres) - 1)];
    }
    return $contrasena;
  }

  // Genera la contraseña

  $contrasena_generada = generarContrasenaAleatoria();

  // Destinatario y asunto del correo
  // $destinatario = $correo;
  // $asunto = 'Contraseña generada';

  // // Mensaje del correo
  // $mensaje = 'Tu contraseña generada es: ' . $contrasena_generada;

  // // Encabezados del correo
  // $headers = 'From: essalud@gmail.com' . "\r\n" .
  //   'Reply-To: essalud@gmail.com' . "\r\n" .
  //   'X-Mailer: PHP/' . phpversion();

  // // Envía el correo
  // if (mail('jeanpiav14@gmail.com', $asunto, $mensaje, $headers)) {
  //   echo 'Correo enviado con éxito';
  // } else {
  //   echo 'Error al enviar el correo';
  // }


  // include('phpmailer.php')

  phpmailer($correo, $contrasena_generada);

  // $cipher = "AES-256-CBC";
  // $secret = "12345678901234567890123456789012";
  // $options = 0;
  // $iv = str_repeat(0, openssl_cipher_iv_length($cipher));

  // $encryptString = openssl_encrypt($contrasena_generada, $cipher, $secret, $options, $iv);


  // error_reporting(0);
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

  $encrypted_txt = encrypt_decrypt('encrypt', $contrasena_generada, $key);



  $sql = "INSERT INTO usuarios(nombre,apellido,username,correo, password) VALUES ('{$name}','{$surname}','{$username}','{$correo}', '{$encrypted_txt}')";
  $result = mysqli_query($conn, $sql) or die("Query Unsuccessful.");

  $sql2 = "SELECT usuario_id FROM usuarios WHERE nombre='{$name}'";
  $result2 = mysqli_query($conn, $sql2) or die("Query Unsuccessful.");

  $row = mysqli_fetch_assoc($result2);

  $id_usuario = $row['usuario_id'];

  $sql3 = "INSERT INTO roles_x_usuario(usuario,rol) VALUES ($id_usuario, $rol)";
  $result3 = mysqli_query($conn, $sql3) or die("Query Unsuccessful.");

  header("Location: ./index.php");

  mysqli_close($conn);

}
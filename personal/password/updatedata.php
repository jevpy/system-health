<?php
include './php/conexion.php';
session_start();

$usuario_id = $_SESSION["usuario_id"];

$rol = 2;

$cipher = "AES-256-CBC";
$secret = "12345678901234567890123456789012";
$options = 0;
$iv = str_repeat(0, openssl_cipher_iv_length($cipher));


$passwordActual = trim($_POST['password']);
$newPassword = trim($_POST['newPassword']);
$newPasswordRepeat = trim($_POST['newPasswordRepeat']);

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


if (empty($passwordActual) || empty($newPassword) || empty($newPasswordRepeat)) {
  header("Location: warning-edit.php?id=$usuario_id");
  die();
}

if ($newPassword != $newPasswordRepeat) {
  header("Location: warning-edit.php?id=$usuario_id");
  die();
} else {
  // $cipher = "AES-256-CBC";
  // $secret = "12345678901234567890123456789012";
  // $options = 0;
  // $iv = str_repeat(0, openssl_cipher_iv_length($cipher));
  // $encryptedString = openssl_encrypt($newPasswordRepeat, $cipher, $secret, $options, 0, $iv);
  $key = 'essalud';
  $encrypted_txt = encrypt_decrypt('encrypt', $newPasswordRepeat, $key);
}


$sql4 = "SELECT * FROM usuarios WHERE usuario_id = $usuario_id";
try {
  $result4 = mysqli_query($conn, $sql4) or die("Query Unsuccesful");

} catch (\Throwable $th) {
  header("location: $hostname/404.php");
}


if ($row4 = mysqli_fetch_assoc($result4)) {
  // $passnow = openssl_encrypt($passwordActual, $cipher, $secret, $options, 0, $iv);

  $encrypted_txt2 = encrypt_decrypt('encrypt', $passwordActual, $key);

  if ($encrypted_txt2 != $row4['password']) {
    header("Location: warning-edit.php?id=$usuario_id");
    die();
  }
}


$sql = "UPDATE usuarios SET password = '{$encrypted_txt}' WHERE usuario_id = {$usuario_id}";
$result = mysqli_query($conn, $sql) or die("Query Unsuccessful.");

/*$sql2 = "UPDATE roles_x_usuario SET rol = {$rol} WHERE usuario = {$usuario_id}";
$result = mysqli_query($conn, $sql2) or die("Query Unsuccessful.");*/


header("Location: ./index.php");

mysqli_close($conn);

?>
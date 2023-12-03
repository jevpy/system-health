<?php
function encryptor($action, $string)
{
  $output = false;
  $encrypt_method = "AES-256-CBC";

  $secret_key = 'Essalud';
  $secret_iv = 'ESSALUD@_';


  $key = hash('sha256', $secret_key);


  $iv = substr(hash('sha256', $secret_iv), 0, 16);


  if ($action == 'encrypt') {
    $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
    $output = base64_encode($output);
  } else if ($action == 'decrypt') {

    $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
  }

  return $output;
}

// $id = encryptor('encrypt', '2');
// $id2 = encryptor('encrypt', 2);
// echo $id . '<br>';
// echo $id2;
// // T29rVStZano3WUlmb3Z0MEhyQ3Mzdz09 - 1

?>
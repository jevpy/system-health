<?php
include_once ("./encrypt.php");

$number = trim($_POST['number']);
$grupo = trim($_POST['grupo']);


$conn = mysqli_connect("localhost", "root", "", "sistemapacientes") or die("Connection Failed");

if (empty($number) || empty($grupo)) {
  header("Location: warning.php");
  die();
}


if (isset($_POST['agregar'])) {
  
  $sql = "SELECT numero FROM camillas ";
  $result = mysqli_query($conn, $sql);

  while ($row = mysqli_fetch_assoc($result)) {
    if ($number === $row['numero']) {
      header("Location: warning.php");
      die();
    }
  }

  $sql2 = "INSERT INTO camillas(numero, grupo) VALUES ('{$number}', {$grupo})";
  $result2 = mysqli_query($conn, $sql2) or die("Query Unsuccessful.");

  header("Location: ./index.php");

  mysqli_close($conn);

}
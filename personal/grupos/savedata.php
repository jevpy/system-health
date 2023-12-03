<?php

$nombre_grupo = trim($_POST['name']);


include './php/conexion.php';

if(empty($nombre_grupo)){
  header("Location: warning.php");
  die();
}

if (isset($_POST['agregar'])) {

  $sql4 = "SELECT * FROM grupo";
  $result4 = mysqli_query($conn, $sql4);

  while ($row4 = mysqli_fetch_assoc($result4)) {
    if ($nombre_grupo === $row4['nombre_grupo']) {
      header("Location: warning.php");
      die();
    }
  }

  $sql = "INSERT INTO grupo(nombre_grupo) VALUES ('{$nombre_grupo}')";
  $result = mysqli_query($conn, $sql) or die("Query Unsuccessful.");



  header("Location: ./index.php");

  mysqli_close($conn);

}












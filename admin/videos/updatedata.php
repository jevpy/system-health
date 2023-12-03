<?php
$video_id = $_POST['video_id'];
$grupoid = $_POST['grupoid'];
$nombre = trim($_POST['name_video']);
$url = trim($_POST['url']);
$descripcion = trim($_POST['descripcion_video']);
// $grupo = $_POST['grupo'];

include './php/conexion.php';

if (empty($nombre) || empty($url) || empty($descripcion)) {
  header("Location: warning-edit.php?id=$video_id");
  die();
}

try {
  $sql4 = "SELECT * FROM video WHERE video_id != $video_id";
  $result4 = mysqli_query($conn, $sql4);
  
  while ($row4 = mysqli_fetch_assoc($result4)) {
    if ($nombre == $row4['nombre_video'] || $url == $row4['url']) {
      header("Location: warning-edit.php?id=$video_id");
      die();
    }
  }
  
  
  $sql = "UPDATE video SET nombre_video = '{$nombre}', descripcion_video = '{$descripcion}', url = '{$url}' WHERE video_id = {$video_id}";
  $result = mysqli_query($conn, $sql) or die("Query Unsuccessful.");

} catch (\Throwable $th) {
  header("location: {$hostname}/404.php");
}


// $sql2 = "UPDATE grupo_x_video SET grupo = {$grupo} WHERE video = {$video_id}";
// $result = mysqli_query($conn, $sql2) or die("Query Unsuccessful.");

header("Location: ./index.php?id={$grupoid}");

mysqli_close($conn);


?>
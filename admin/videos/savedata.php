<?php

include_once("./php/conexion.php");

$name = trim($_POST['name_video']);
$url = trim($_POST['url']);
$description = trim($_POST['description_video']);
$grupo = $_POST['grupo'];
$grupoid = $_POST['grupoid'];

$conn = mysqli_connect("localhost", "root", "", "sistemapacientes") or die("Connection Failed");

if (empty($name) || empty($url) || empty($description) || empty($grupo)) {
  header("Location: warning.php?id=$grupo");
  die();
}


if (isset($_POST['agregar'])) {
  $sql4 = "SELECT * FROM video";
  $result4 = mysqli_query($conn, $sql4);

  while ($row4 = mysqli_fetch_assoc($result4)) {
    if ($name === $row4['nombre_video'] || $url === $row4['url']) {
      header("Location: warning.php?id=$grupo");
      die();
    }
  }

  try {
    $sql = "INSERT INTO  video(nombre_video, url, descripcion_video) VALUES ('{$name}','{$url}','{$description}')";
    $result = mysqli_query($conn, $sql) or die("Query Unsuccessful.");

    $sql2 = "SELECT video_id FROM video WHERE nombre_video ='{$name}'";
    $result2 = mysqli_query($conn, $sql2) or die("Query Unsuccessful.");

    $row = mysqli_fetch_assoc($result2);

    $video_id = $row['video_id'];

    $sql3 = "INSERT INTO grupo_x_video(video, grupo) VALUES ($video_id, $grupo)";
    $result3 = mysqli_query($conn, $sql3) or die("Query Unsuccessful.");

  } catch (\Throwable $th) {
    header("location: $hostname/404.php");
  }


  header("Location: ./index.php?id={$grupoid}");

  mysqli_close($conn);

}












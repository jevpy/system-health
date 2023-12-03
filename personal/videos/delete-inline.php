<?php

$video_id = $_GET['id'];
$grupoid = $_GET['grupo'];

if (!$video_id || empty($grupoid) || empty($video_id) || !$video_id) {
  header("location: /proyecto3/404.php");
}

include './php/conexion.php';

$sql = "DELETE FROM video WHERE video_id = {$video_id}";
$sql1 = "DELETE FROM grupo_x_video WHERE video = {$video_id}";

$result1 = mysqli_query($conn, $sql1) or die("Query Unsuccessful.");
$result = mysqli_query($conn, $sql) or die("Query Unsuccessful.");


header("Location: ./index.php?id={$grupoid}");

mysqli_close($conn);

?>
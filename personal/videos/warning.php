<?php
include_once "./inc/header.php";
include_once "./php/conexion.php";

$video_id = $_GET['id'];

if (empty($video_id) || !$video_id) {
  header("location: $hostname/404.php");
}


?>
<article class="container">
  <article class="warning">
    <h2>¡Lo sentimos, ha ocurrido un problema inesperado!</h2>
    <p>Esto se debe a que no ha completado todos los campos o el video que desea añadir ya existe</p>
    <a href="add.php?grupo=<?php echo $video_id ?>">Ok</a>
  </article>
</article>

<script src="./js/index.js"></script>
</body>

</html>
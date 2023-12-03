<?php
include_once "./inc/header.php";
include_once "./php/conexion.php";

$usuario_id = $_GET['id'];

if (!empty($usuario_id) || !$usuario_id) {
  header("location: {$hostname}/404.php");
}



?>
<article class="container">
  <article class="warning">
    <h2>¡Lo sentimos, ha ocurrido un problema inesperado!</h2>
    <p>Esto se debe a que no ha completado todos los campos o el usuario que desea actualizar ya existe</p>
    <a href="edit.php?id=<?php echo $usuario_id ?>">Ok</a>
  </article>
</article>

<script src="./js/index.js"></script>
</body>

</html>
<?php
include './php/conexion.php';
include_once "./inc/header.php";
include_once "./encrypt.php";
?>

<div id="main-content">

  <?php

  $grupo_id = $_GET['id'];

  // $sql = "SELECT * FROM usuarios WHERE usuario_id = {$usuario_id}";
  $sql = "SELECT  grupo_id, nombre_grupo
      FROM grupo
      WHERE grupo_id = $grupo_id "
  ;

  try {
    $result = mysqli_query($conn, $sql) or die("Query Unsuccessful.");

  } catch (\Throwable $th) {
    header("location: $hostname/404.php");
  }

  if (mysqli_num_rows($result) > 0) {
    ?>
    <form action="./updatedata.php" method="post" class="update-form">
      <div class="head">
        <span>Actualizar Datos</span>
      </div>
      <?php
      while ($row = mysqli_fetch_assoc($result)) {

        ?>
        <div class="inputs">
          <div class="form-group">
            <label>Nombre del grupo</label>
            <input type="hidden" name="grupo_id" value="<?php echo $row['grupo_id']; ?>" />
            <input type="text" name="name" value="<?php echo $row['nombre_grupo']; ?>" required />
          </div>
          <input class="submit" type="submit" name="update" value="Actualizar" />
      </form>
      <?php
      }
  } else {
    header("location: {$hostname}/404.php");
  }
  ?>
</div>
</div>
< <script src="./js/index.js">
  </script>
  </body>

  </html>
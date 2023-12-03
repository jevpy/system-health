<?php
include_once "./inc/header.php";
?>

<div id="main-content">

  <?php
  include './php/conexion.php';

  $video_id = $_GET['id'];
  $grupoid = $_GET['grupo'];

  // $sql = "SELECT * FROM usuarios WHERE usuario_id = {$usuario_id}";
  // $sql = "SELECT usuarios.usuario_id, usuarios.nombre, usuarios.apellido, usuarios.username, usuarios.password, roles_x_usuario.rol, usuarios.grupo FROM roles_x_usuario
  // LEFT JOIN usuarios ON roles_x_usuario.usuario = usuarios.usuario_id 
  // LEFT JOIN roles ON roles_x_usuario.rol = roles.rol_id
  // LEFT JOIN grupo ON	usuarios.grupo = grupo.grupo_id  WHERE usuario_id = {$usuario_id}";
  
  $sql = "SELECT video.video_id, video.nombre_video, video.url, video.descripcion_video, grupo.nombre_grupo FROM grupo_x_video
    LEFT JOIN video ON video.video_id = grupo_x_video.video 
    LEFT JOIN grupo ON grupo.grupo_id = grupo_x_video.grupo 
    WHERE Video_id = {$video_id}";
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
            <label>Nombre_video</label>
            <input type="hidden" name="video_id" value="<?php echo $row['video_id']; ?>" />
            <input type="hidden" name="grupoid" value="<?php echo $grupoid; ?>" />
            <input type="text" name="name_video" value="<?php echo $row['nombre_video']; ?>" required />
          </div>
          <div class="form-group">
            <label>Url</label>
            <input type="text" name="url" value="<?php echo $row['url']; ?>" required />
          </div>
          <div class="form-group">
            <label>Descripcion</label>
            <input type="text" name="descripcion_video" value="<?php echo $row['descripcion_video']; ?>" required />
          </div>
          <!-- <div class="form-group">
            <label>Grupo</label>
            <?php
            $sql2 = "SELECT grupo_id, nombre_grupo FROM grupo";
            try {
              $result2 = mysqli_query($conn, $sql2) or die("Query Unsuccessful.");
            } catch (\Throwable $th) {
              header("location: /proyecto3/404.php");
            }

            if (mysqli_num_rows($result2) > 0) {
              echo '<select name="grupo" required>';
              while ($row2 = mysqli_fetch_assoc($result2)) {
                // if($row['grupo'] == $row2['grupo_id']){
                if ($grupoid == $row2['grupo_id']) {
                  $select = "selected";
                } else {
                  $select = "";
                }
                echo "<option {$select} value='{$row2['grupo_id']}'>{$row2['nombre_grupo']}</option>";
              }
              echo "</select>";
            }
            ?>
          </div> -->
        </div>
        <input class="submit" type="submit" name="update" value="Actualizar" />
      </form>
      <?php
      }
  } else {
    header("Location: $hostname/404.php");
  }
  ?>
</div>
</div>
< <script src="./js/index.js">
  </script>
  </body>

  </html>
<?php
include_once "./inc/header.php";
include_once "./encrypt.php";
  ?>

<div id="main-content">

  <?php
  include './php/conexion.php';

  $usuario_id = encryptor('decrypt', $_GET['id']);

  // $sql = "SELECT * FROM usuarios WHERE usuario_id = {$usuario_id}";
  $sql = "SELECT usuarios.usuario_id, usuarios.nombre, usuarios.apellido, usuarios.username, usuarios.correo, roles_x_usuario.rol FROM roles_x_usuario
    LEFT JOIN usuarios ON roles_x_usuario.usuario = usuarios.usuario_id 
    LEFT JOIN roles ON roles_x_usuario.rol = roles.rol_id  WHERE usuario_id = {$usuario_id} AND rol_nombre = 'personal'";
  try {
    $result = mysqli_query($conn, $sql) or die("Query Unsuccessful.");
    //code...
  } catch (\Throwable $th) {
    header("$hostname/404.php
      ");
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
            <label>Nombre</label>
            <input type="hidden" name="usuario_id" value="<?php echo $row['usuario_id']; ?>" />
            <input type="text" name="name" value="<?php echo $row['nombre']; ?>" required />
          </div>
          <div class="form-group">
            <label>Apellido</label>
            <input type="text" name="surname" value="<?php echo $row['apellido']; ?>" required />
          </div>
          <div class="form-group">
            <label>Usuario</label>
            <input type="text" name="username" value="<?php echo $row['username']; ?>" required />
          </div>
          <div class="form-group">
            <label>Correo</label>
            <input type="text" name="correo" value="<?php echo $row['correo']; ?>" required />
          </div>

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
<?php
include_once "./inc/header.php";
// $id = $_GET["id"];
$grupoid = $_GET['grupo'];

?>

<div id="main-content">
  <form class="update-form" action="savedata.php" method="post">
    <div class="head">
      <span>Agregar Video</span>
    </div>
    <div class="inputs">
      <div class="form-group">
        <label>Nombre</label>
        <input type="hidden" name="grupoid" value="<?php echo $grupoid; ?>" />
        <input type="text" name="name_video" required />
      </div>
      <div class="form-group">
        <label>Url</label>
        <input type="text" name="url" required />
      </div>
      <div class="form-group">
        <label>Descripcion</label>
        <input type="text" name="description_video" required />
      </div>
      <div class="form-group">
        <!-- <label>Grupo</label> -->
        <?php
        include './php/conexion.php';

        $sql = "SELECT grupo_id, nombre_grupo FROM grupo WHERE grupo_id = $grupoid";
        try {
          $result = mysqli_query($conn, $sql) or die("Query Unsuccessful.");

        } catch (\Throwable $th) {
          header("location: $hostname/404.php");
        }

        while ($row = mysqli_fetch_assoc($result)) { ?>
          <input type="hidden" name="grupo" value="<?php echo $row['grupo_id']; ?>" required>
        <?php } ?>
        <!-- <select name="grupo" required>
          <option value="" selected disabled>Selecciona Grupo</option>
          <?php
          include './php/conexion.php';

          $sql = "SELECT grupo_id, nombre_grupo FROM grupo";
          try {
            $result = mysqli_query($conn, $sql) or die("Query Unsuccessful.");

          } catch (\Throwable $th) {
            header("location: $hostname/404.php");
          }

          while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <option value="<?php echo $row['grupo_id']; ?>">
              <?php echo $row['nombre_grupo']; ?>
            </option>
          <?php } ?>
        </select> -->
      </div>
    </div>
    <input class="submit" type="submit" name="agregar" value="Agregar" />
  </form>
</div>
</div>
<script src="./js/index.js"></script>
</body>

</html>
<?php
include_once "./inc/header.php";
?>

<div id="main-content">
  <form class="update-form" action="./savedata.php" method="post">
    <div class="inputs">
      <div class="form-group">
        <label>Número</label>
        <input type="text" name="number" required />
      </div>
      <div class="form-group">
        <label>Grupo</label>
        <select name="grupo">
          <option value="" selected disabled>Selecciona Grupo</option>
          <?php
          include './php/conexion.php';

          $sql = "SELECT * FROM grupo
ORDER BY 
CASE 
    WHEN grupo_id = '4' THEN 1
    ELSE 2 
END,
grupo_id;";
          try {
            $result = mysqli_query($conn, $sql) or die("Query Unsuccessful.");
            //code...
          } catch (\Throwable $th) {
            header("location: $hostname/404.php");
          }

          while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <option value="<?php echo $row['grupo_id']; ?>">
              <?php echo $row['nombre_grupo']; ?>
            </option>
          <?php } ?>
        </select>
      </div>

    </div>
    <input class="submit" type="submit" name="agregar" value="Agregar" />
  </form>
</div>

<script src="./js/index.js"></script>
</body>

</html>
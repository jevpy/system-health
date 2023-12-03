<?php
include_once "./inc/header.php";
include_once "./encrypt.php";
?>

<div id="main-content">

  <?php
  include './php/conexion.php';

  $camilla_id = encryptor('decrypt', $_GET['id']);

  // $sql = "SELECT * FROM usuarios WHERE usuario_id = {$usuario_id}";
  
  $sql = "SELECT camillas.camilla_id, grupo.nombre_grupo, camillas.grupo, camillas.numero
      FROM camillas
      LEFT JOIN grupo ON grupo.grupo_id = camillas.grupo WHERE camilla_id = {$camilla_id} ORDER BY camilla_id ";
  try {
    $result = mysqli_query($conn, $sql) or die("Query Unsuccessful.");
  } catch (\Throwable $th) {
    header("location: {$hostname}/404.php");
  }

  if (mysqli_num_rows($result) > 0) {
    ?>
    <form action="./updatedata.php" method="post" class="update-form">
      <?php
      while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <div class="head">
          <span>Actualizar Grupo de la Camilla
            <i>
              <?php echo $row['numero']; ?>

            </i>
          </span>
        </div>
        <div class="inputs">
          <div class="form-group">
            <!-- <label>Nombre</label> -->
            <input type="hidden" name="camilla_id" value="<?php echo $row['camilla_id']; ?>" />
            <!-- <input type="text" name="name" value="<?php echo 'Nombre ' . $row['camilla_id']; ?>" required disabled /> -->
          </div>
          <div class="form-group">
            <label>Grupo</label>
            <?php
            // $sql2 = "SELECT grupo_id, nombre_grupo FROM grupo";
            $sql2 = "SELECT * FROM grupo
ORDER BY 
CASE 
    WHEN grupo_id = '4' THEN 1
    ELSE 2 
END,
grupo_id;";

            try {
              $result2 = mysqli_query($conn, $sql2) or die("Query Unsuccessful.");

            } catch (\Throwable $th) {
              header("location: $hostname/404.php");
            }

            if (mysqli_num_rows($result2) > 0) {
              echo '<select name="grupo">';
              while ($row2 = mysqli_fetch_assoc($result2)) {
                if ($row['grupo'] == $row2['grupo_id']) {
                  $select = "selected";
                } else {
                  $select = "";
                }
                echo "<option {$select} value='{$row2['grupo_id']}'>{$row2['nombre_grupo']}</option>";
              }
              echo "</select>";
            }
            ?>
          </div>
        </div>
        <input class="submit" type="submit" name="update" value="Actualizar" />
      </form>
      <?php
      }
  } else {
    header("Location: {$hostname}/404.php");
  }
  ?>
</div>
</div>
< <script src="./js/index.js">
  </script>
  </body>

  </html>
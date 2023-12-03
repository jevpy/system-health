<?php
include_once "./inc/header.php";
include_once("./encrypt.php");
?>

<main>
  <?php
  include './php/conexion.php';

  $sql = "SELECT camillas.camilla_id, camillas.numero ,grupo.grupo_id, grupo.nombre_grupo
      FROM camillas
      LEFT JOIN grupo ON grupo.grupo_id = camillas.grupo ORDER BY camilla_id";

  try {
    $result = mysqli_query($conn, $sql) or die("Query Unsuccessful.");
  } catch (\Throwable $th) {
    header("location: {$hostname}/404.php");
  }
  
  ?>
  <div style="text-align: center;">
    <form action='./add.php' method="post">
      <!-- <button class="btn_add" type="button" name="agregar">Añadir camilla</button> -->
      <input type="submit" class="btn_add" name="agregar" value="Añadir camilla">
      <!-- <button class="btn_add" type="button" >Añadir camilla</button> -->
    </form>
  </div>
  <?php
  if (mysqli_num_rows($result) > 0) {
    ?>
    <article class=" container">
      <table class="table">
        <thead>
          <tr>
            <th>Número</th>
            <th>Grupo</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php
          while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <tr>

              <td data-label="Numero">
                <?php echo $row['numero'] ?>
              </td>
              <!-- <td data-label="Apellido"><?php echo $row['nombre_grupo']; ?></td> -->
              <td data-label="Grupo" <?php if ($row['nombre_grupo'] == 'Sin Grupo')
                echo "style='--bg-main-color: rgb(249, 16, 16);'" ?>>
                <?php echo $row['nombre_grupo'] ?>
              </td>
              <td data-label="Acciones">
                <div>
                  <?php
                  $camilla = encryptor('encrypt', $row['camilla_id']);
                  ?>
                  <a href='  edit.php?id=<?php echo $camilla; ?>'>
                    <button class="btn-action">Editar
                      <svg class="svg" viewBox="0 0 512 512">
                        <path
                          d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z">
                        </path>
                      </svg>
                    </button>
                  </a>
                  <a href="<?php echo $hostname;?>/vistas/url/index.php?camilla=<?php echo $camilla ?>" target="_blank" rel="noopener">
                    <button class="btn-action"> Ver
                      <svg class="svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <title>eye</title>
                        <path
                          d="M12,9A3,3 0 0,0 9,12A3,3 0 0,0 12,15A3,3 0 0,0 15,12A3,3 0 0,0 12,9M12,17A5,5 0 0,1 7,12A5,5 0 0,1 12,7A5,5 0 0,1 17,12A5,5 0 0,1 12,17M12,4.5C7,4.5 2.73,7.61 1,12C2.73,16.39 7,19.5 12,19.5C17,19.5 21.27,16.39 23,12C21.27,7.61 17,4.5 12,4.5Z" />
                      </svg>
                    </button>
                  </a>
                  <a href='modal.php?id=<?php echo $camilla; ?>'>
                    <button class="btn-action delete">Eliminar
                      <svg class="svg" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path
                          d="M24 20.188l-8.315-8.209 8.2-8.282-3.697-3.697-8.212 8.318-8.31-8.203-3.666 3.666 8.321 8.24-8.206 8.313 3.666 3.666 8.237-8.318 8.285 8.203z">
                        </path>
                      </svg>
                    </button>
                  </a>
                </div>
              </td>

            </tr>
          <?php } ?>
        </tbody>
      </table>
    <?php } else {
    echo "<h1 class='empty' >No se encontraron camillas</h1>";
  }
  mysqli_close($conn);
  ?>
  </article>
</main>

<script src="./js/index.js"></script>
</body>

</html>
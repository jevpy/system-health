<?php
    include_once "./inc/header.php";
  ?>

  
<div id="main-content">
    <form class="update-form" action="savedata.php" method="post">
      <div class="inputs">
        <div class="form-group">
            <label>Nombre</label>
            <input type="text" name="name" required/>
        </div>
        <div class="form-group">
            <label>Apellido</label>
            <input type="text" name="surname" required/>
        </div>
        <div class="form-group">
            <label>Usuario</label>
            <input type="text" name="username" required maxlength="8"/>
        </div>
        <div class="form-group">
            <label>Correo</label>
            <input type="text" name="correo" required/>
        </div>
      </div>
        <input class="submit" type="submit" name="agregar" value="Agregar"  />
    </form>
</div>
 <script src="./js/index.js"></script>
</body>

</html> 

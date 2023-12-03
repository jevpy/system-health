<?php
include_once "./inc/header.php";
?>


<div id="main-content">
    <form class="update-form" action="updatedata.php" method="post">
        <div class="inputs">
            <div class="form-group">
                <label>Contraseña Actual</label>
                <input type="password" name="password" required/>
            </div>
            <div class="form-group">
                <label>Nueva Contraseña</label>
                <input type="password" name="newPassword" required/>
            </div>
            <div class="form-group">
                <label>Repetir Contraseña</label>
                <input type="password" name="newPasswordRepeat" required/>
            </div>
        </div>
        <input class="submit" type="submit" name="cambiar" value="Cambiar"  />
    </form>
</div>
<script src="./js/index.js"></script>
</body>

</html>

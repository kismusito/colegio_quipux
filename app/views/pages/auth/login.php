<?php

include_once URL_RUTE . '/views/components/header.php';

include_once URL_RUTE . '/views/components/navbar.php';

?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h6>Iniciar sesión</h6>
                </div>
                <div class="card-body">
                    <form action="<?php PROJECT_URL . '/Autentication' ?>" method="POST">

                        <div class="form-group">
                            <label for="user">Usuario</label>
                            <input type="text" name="user" id="user" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>

                        <button class="btn btn-success btn-block">Iniciar sesión</button>



                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>



<?php
include_once URL_RUTE . '/views/components/footer.php';
?>


<?php if (isset($_SESSION['error'])) : ?>
    <script>
        mostrarAlerta('error' , 'Algo salio mal' , 'El usuario o la contraseña son incorrectos')
    </script>
    <?php unset($_SESSION['error']);
endif ?>
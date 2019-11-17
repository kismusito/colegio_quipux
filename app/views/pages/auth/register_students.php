<?php

include_once URL_RUTE . '/views/components/header.php';

include_once URL_RUTE . '/views/components/navbar.php';

?>

<div class="container mt-5">

    <h4 class="text-center mb-3">Registro de estudiantes</h4>

    <form action="<?php echo PROJECT_URL . '/Registrar' ?>" method="POST">

        <div class="form-row">

            <div class="form-group col-md-12">
                <select name="rol" id="rol" class="form-control" required>
                    <option value="">Rol del usuario</option>
                    <option value="1">Administrador</option>
                    <option value="2">Estudiante</option>
                </select>
            </div>

            <div class="form-group col-md-6">
                <input type="text" name="username" id="username" placeholder="Nombre de usuario" class="form-control" required>
            </div>

            <div class="form-group col-md-6">
                <input type="password" name="pass" id="pass" placeholder="Contraseña" class="form-control" required>
            </div>

            <div class="form-group col-md-6">
                <select name="type_documento" id="type_documento" class="form-control" required>
                    <option value="">Tipo de documento</option>
                    <option value="ti">Tarjeta de identidad</option>
                    <option value="nuip">NUIP</option>
                    <option value="cc">Cédula de ciudadania</option>
                </select>
            </div>


            <div class="form-group col-md-6">
                <input type="text" name="document" id="document" placeholder="Número de documento" class="form-control" required>
            </div>

            <div class="form-group col-md-6">
                <input type="text" name="name" id="name" placeholder="Nombres" class="form-control" required>
            </div>

            <div class="form-group col-md-6">
                <input type="text" name="lastname" id="lastname" placeholder="Apellidos" class="form-control" required>
            </div>

            <div class="form-group col-md-6">
                <select name="gender" id="gender" class="form-control" required>
                    <option value="">Sexo</option>
                    <option value="femenino">Femenino</option>
                    <option value="masculino">Masculino</option>
                </select>
            </div>

            <div class="form-group col-md-6">
                <input type="date" name="birthday" id="birthday" class="form-control" required>
            </div>

            <div class="form-group col-md-6">
                <input type="text" name="address" id="address" placeholder="Dirección" class="form-control" required>
            </div>

            <div class="form-group col-md-6">
                <select name="city" id="city" class="form-control" required>
                    <option value="">Ciudad</option>
                    <option value="medellin">Medellín</option>
                    <option value="bogota">Bogota</option>
                    <option value="cali">Calí</option>
                </select>
            </div>

            <div class="form-group col-md-6">
                <input type="text" name="phone" id="phone" placeholder="Télefono" class="form-control" required>
            </div>

            <div class="form-group col-md-6">
                <input type="email" name="email" id="email" placeholder="Correo eléctronico" class="form-control" required>
            </div>

            <div class="form-group col-md-12">
                <select name="grado" id="grado" class="form-control" required>
                    <option value="">Grado</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                </select>
            </div>

            <button class="btn btn-success btn-block">Registrar estudiante</button>

        </div>


    </form>


</div>

<?php

include_once URL_RUTE . '/views/components/footer.php';

?>

<?php if (isset($_SESSION['registroCompleto'])) : ?>
    <script>
        mostrarAlerta('success' , 'Buen trabajo' , 'El estudiante ha sido registrado correctamente')
    </script>
    <?php unset($_SESSION['registroCompleto']);
endif ?>

<?php if (isset($_SESSION['error'])) : ?>
    <script>
        mostrarAlerta('error' , 'Oops...' , 'Parece que hubo un error en el registro vuelve a intentarlo nuevamente')
    </script>
    <?php unset($_SESSION['error']);
endif ?>
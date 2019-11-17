<?php

include_once URL_RUTE . '/views/components/header.php';

include_once URL_RUTE . '/views/components/navbar.php';

?>

<div class="container mt-5">

    <div class="row">

        <!-- Fila registrar materias -->
        <div class="col-md-7">
            <div class="alert alert-info">Tienes que insertar las materias en orden área por área, si te saltas alguna te dara error <br>
                Ejemplo: Insertalas en este orden
                NATURALES
                NATURALES
                SOCIALES
                <span class="text-danger">NATURALES -> error</span>

            </div>

            <h4 class="text-center mb-3">Registrar materias</h4>

            <form action="<?php echo PROJECT_URL . '/registrar/materias' ?>" method="POST">


                <div class="form-row">

                    <div class="form-group col-md-6">
                        <select name="area" id="area" class="form-control" required>
                            <option value="">Área</option>
                            <option value="NAT">CIENCIAS NATURALES</option>
                            <option value="SCS">CIENCIAS SOCIALES</option>
                            <option value="ART">EDUCACIÓN ARTÍSTICA</option>
                            <option value="ETC">EDUCACIÓN ÉTICA</option>
                            <option value="REL">EDUCACIÓN RELIGIOSA </option>
                            <option value="EDF">EDUCACIÓN FÍSICA</option>
                            <option value="IDM">HUMANIDADES</option>
                            <option value="MAT">MATEMÁTICAS</option>
                            <option value="TEC">TECNOLOGÍA</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <input type="text" name="asignature" id="asignature" class="form-control" placeholder="Nombre de la materia" required>
                    </div>
                </div>

                <div class="form-group">
                    <input type="text" name="teacher" id="teacher" class="form-control" placeholder="Nombre del profesor" required>
                </div>

                <h4 class="text-center">Materias por grupo</h4>
                <p class="text-center">Elige los grupos en los que estara disponible esta materia</p>

                <div class="form-group d-flex justify-content-center">

                    <?php foreach ($params['grupos'] as $grupos) : ?>
                        <div class="custom-control custom-switch custom-control-inline">
                            <input type="checkbox" class="custom-control-input" id="<?php echo $grupos->codigo_grupo ?>" name="grupo[]" value="<?php echo $grupos->codigo_grupo ?>">
                            <label class="custom-control-label" for="<?php echo $grupos->codigo_grupo ?>"><?php echo substr($grupos->codigo_grupo, 4, -2)  . '-' . substr($grupos->codigo_grupo, 6) ?></label>
                        </div>
                    <?php endforeach ?>



                </div>

                <button class="btn btn-primary btn-block">Registrar materia</button>

            </form>
        </div>
        <!-- final Fila registrar materias -->
        <!-- Materias registradas -->
        <div class="col-md-5">
            <h4 class="text-center">Materias registradas</h4>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Código</th>
                        <th scope="col">Materia</th>
                        <th scope="col">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($params['materias'] as $datosMaterias) : ?>
                        
                        <tr>
                            <td><?php echo $datosMaterias->codigo_materia ?></td>
                            <td><?php echo $datosMaterias->nombre ?></td>
                            <td><a href="<?php echo PROJECT_URL . '/registrar/eliminarMaterias/' . $datosMaterias->codigo_materia ?>" class="btn btn-danger" onclick="return confirm('Estas seguro de eliminar la materia?')">Eliminar</a></td>
                        </tr>
                    <?php endforeach ?>


                </tbody>
            </table>


            <!-- fin Materias registradas -->
        </div>
    </div>



</div>

<?php

include_once URL_RUTE . '/views/components/footer.php';

?>

<?php if (isset($_SESSION['materiaSuccess'])) : ?>
    <script>
        mostrarAlerta('success', 'Buen trabajo', 'La materia ha sido registrado correctamente')
    </script>
    <?php unset($_SESSION['materiaSuccess']);
endif ?>

<?php if (isset($_SESSION['errorMateria'])) : ?>
    <script>
        mostrarAlerta('error', 'Error en la materia', 'Tienes que insertar las materias en orden área por área')
    </script>
    <?php unset($_SESSION['errorMateria']);
endif ?>

<?php if (isset($_SESSION['materiaDeleteSuccess'])) : ?>
    <script>
        mostrarAlerta('success', 'Buen trabajo', 'La materia ha sido eliminada correctamente')
    </script>
    <?php unset($_SESSION['materiaDeleteSuccess']);
endif ?>

<?php if (isset($_SESSION['materiaDeleteError'])) : ?>
    <script>
        mostrarAlerta('error', 'Oops...', 'Parece que hubo un error al eliminar la materia')
    </script>
    <?php unset($_SESSION['materiaDeleteError']);
endif ?>
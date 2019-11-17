<?php

include_once URL_RUTE . '/views/components/header.php';

include_once URL_RUTE . '/views/components/navbar.php';

?>

<div class="container mt-5">

    <a href="<?php echo PROJECT_URL . '/nota/calificaciones/' . $params['maestro']->codigo_grupo ?>" class="btn btn-info float-right">Calificaciones</a>

    <h4 class="mb-3">Datos del grupo</h4>

    <form action="<?php echo PROJECT_URL . '/registrar/actualizarGrupo/' . $params['maestro']->codigo_grupo ?>" method="POST"class="mb-5">
        <input type="hidden" name="codigo" id="codigo" value="<?php echo $params['maestro']->codigo_grupo ?>">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="maestro">Maestro</label>
                <input type="text" class="form-control" name="maestro" id="maestro" value="<?php echo $params['maestro']->nombre_profesor ?>">
            </div>

            <div class="form-group col-md-2">
                <label for="">Jornada Actual</label>
                <input type="text" class="form-control" value="<?php echo $params['maestro']->jornada ?>" disabled>
            </div>


            <div class="form-group col-md-4">
                <label for="">Jornada Nueva</label>
                <select name="jornada" id="jornada" class="form-control" required>
                    <option value="">Jornada</option>
                    <option value="mañana">Mañana</option>
                    <option value="tarde">Tarde</option>
                    <option value="noche">Noche</option>
                </select>
            </div>
        </div>

        <button class="btn btn-info btn-block">Actualizar</button>
        
    </form>


    <h4 class="text-center mb-3">Estudiantes registrados en el grupo</h4>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Código</th>
                    <th scope="col">Nombres</th>
                    <th scope="col">Apellidos</th>
                    <th scope="col">Documento</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Notas</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($params['estudiantes'] as $datosEstudiante) : ?>
                    <tr>
                        <td><?php echo  $datosEstudiante->estudiantes_codigo_estudiante ?></td>
                        <td><?php echo  $datosEstudiante->nombres ?></td>
                        <td><?php echo  $datosEstudiante->apellidos ?></td>
                        <td><?php echo  $datosEstudiante->numero_documento ?></td>
                        <td><?php switch($datosEstudiante->estado){case 1: echo 'En curso';break; case 2: echo 'Aprobado';break; case 3: echo 'Reprobado';break; } ?></td>
                        <td><a href="<?php echo PROJECT_URL . '/nota/' . $params['maestro']->codigo_grupo . '/' . $datosEstudiante->estudiantes_codigo_estudiante ?>" class="btn btn-info">Agregar notas</a></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>

</div>

<?php

include_once URL_RUTE . '/views/components/footer.php';

?>

<?php if (isset($_SESSION['accionCompleta'])) : ?>
    <script>
        mostrarAlerta('success', 'Buen trabajo', 'La accion se completo correctamente')
    </script>
    <?php unset($_SESSION['accionCompleta']);
endif ?>

<?php if (isset($_SESSION['accionFallida'])) : ?>
    <script>
        mostrarAlerta('success', 'Oops..', 'Parece que algo ha fallado en la operación anterior')
    </script>
    <?php unset($_SESSION['accionFallida']);
endif ?>